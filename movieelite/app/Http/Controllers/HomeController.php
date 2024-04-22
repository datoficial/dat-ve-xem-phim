<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TheLoaiPhim;
use App\Models\Phim;
use App\Models\PhongChieu;
use App\Models\RapChieu;
use App\Models\SuatChieu;
use App\Models\Ve;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\ChuDe;
use App\Models\BaiViet;
use App\Models\BinhLuan;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPhimTheoRap($tenrap_slug = '')
    {
            // Lấy thông tin rạp chiếu tương ứng với slug
            $rapchieu = RapChieu::where('tenrap_slug', $tenrap_slug)->first();
    
            // Kiểm tra xem rạp chiếu có tồn tại không. Nếu không tồn tại, điều hướng hoặc xử lý tùy thuộc vào yêu cầu của bạn

                // Lấy danh sách phim tương ứng với rạp chiếu
                $phim = Phim::whereHas('SuatChieu', function ($query) use ($rapchieu) {
                    $query->whereHas('phongchieu', function ($subQuery) use ($rapchieu) {
                        $subQuery->where('rapchieu_id', $rapchieu->id);
                    });
                })->with('TheLoaiPhim', 'BaiViet')->get();
    
                return view('frontend.phimtheorap', compact('phim', 'rapchieu'));

    }
    
    public function getTimKiem(Request $request)
    {
        $searchTerm = $request->input('search');
        $phim = Phim::where('tenphim', 'like', "%$searchTerm%")
                       ->get();

        return view('frontend.timkiemphim', compact('phim','searchTerm'));
       
    }
    public function getCapNhat()
    {
    
        return view('frontend.capnhat');
       
    }
    public function getHome()
    {
    $theloaiphim = TheLoaiPhim::all();
    return view('frontend.home', compact('theloaiphim'));
       
    }
    public function getPhim($tenphim_slug = '')
    {
        if (empty($tenphim_slug)) 
        {
            $phim = Phim::where('kichhoat', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        } 
        else {
            $phim = TheLoaiPhim::where('tenloai_slug', $tenloai_slug)->first();          
            $phim = Phim::where('theloaiphim_id', $phim->id) ->paginate(20);
        }
        return view('frontend.phim', compact('phim', 'theloaiphim'));
    }    
    public function getPhim_ChiTiet($tenloai_slug = '', $tenphim_slug = '')
    {
        $phim = Phim::where('tenphim_slug', $tenphim_slug)->first();
        return view('frontend.phim_chitiet',compact('phim'));
    }
    public function getBaiViet($phim_id=null)
    {
        if(is_null($phim_id))
        {
            $title = 'Tin tức';
            $baiviet = BaiViet::where('kichhoat', 1)
                ->where('kiemduyet', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }
        else
        {
            $phim = Phim::findOrFail($phim_id);
            $title = $phim->tenphim;
            $baiviet = BaiViet::where('kichhoat', 1)
                ->where('kiemduyet', 1)
                ->where('phim_id', $phim_id)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }
        return view('frontend.baiviet', compact('title', 'baiviet'));
    }
    
    public function getBaiViet_ChiTiet($tenchude_slug = '', $tieude_slug = ''){
        $tieude_id = explode('.', $tieude_slug);
        $tieude = explode('-', $tieude_id[0]);
        $baiviet_id = $tieude[count($tieude) - 1];
        $baiviet = BaiViet::where('kichhoat', 1)
        ->where('kiemduyet', 1)
        ->where('id', $baiviet_id)
        ->firstOrFail();
        if(!$baiviet) abort(404);// Cập nhật lượt xem
            $daxem = 'BV' . $baiviet_id;
        if(!session()->has($daxem))
        {
        $orm = BaiViet::find($baiviet_id);
        $orm->luotxem = $baiviet->luotxem + 1;
        $orm->save();
        session()->put($daxem, 1);
        }
        $baivietcungchuyenmuc = BaiViet::where('kichhoat', 1)
        ->where('kiemduyet', 1)
        ->where('chude_id', $baiviet->chude_id)
        ->where('id', '!=', $baiviet_id)
        ->orderBy('created_at', 'desc')
        ->take(4)->get();
        return view('frontend.baiviet_chitiet', compact('baiviet', 'baivietcungchuyenmuc'));
    }
    public function getGioHang()
    {
        if(Cart::count() > 0)
            return view('frontend.giohang');
        else
            return view('frontend.giohangrong');
    }

    public function getLienHe()
    {
        return view('frontend.lienhe');
    }
   
    // Trang đăng ký dành cho khách hàng
    public function getDangKy()
    {
        return view('user.dangky');
    }
    // Trang đăng nhập dành cho khách hàng
    public function getDangNhap()
    {
        return view('user.dangnhap');
    }
}
