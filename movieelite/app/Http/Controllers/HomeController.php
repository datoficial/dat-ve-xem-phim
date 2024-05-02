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
use Socialite;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void

     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPhimTheoRap($tenrap_slug = '')
    {
  
            $rapchieu = RapChieu::where('tenrap_slug', $tenrap_slug)->first();
    
                $phim = Phim::whereHas('SuatChieu', function ($query) use ($rapchieu) {
                    $query->whereHas('phongchieu', function ($subQuery) use ($rapchieu) {
                        $subQuery->where('rapchieu_id', $rapchieu->id);
                    });
                })->with('TheLoaiPhim', 'BaiViet')->get();
    
                return view('frontend.phimtheorap', compact('phim', 'rapchieu'));

    }
    public function getPhimTheoLoai($tenloai_slug = '')
    {
  
        if (empty($tenloai_slug)) 
        {
            $phim = Phim::all()
                ->paginate(20);
        } 
        else {
            $theloaiphim = TheLoaiPhim::where('tenloai_slug', $tenloai_slug)->first();          
            $phim = Phim::where('theloaiphim_id', $theloaiphim->id) ->paginate(12);
        }
        return view('frontend.phimtheoloai', compact('phim', 'theloaiphim'));

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
    public function getGoogleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
    public function getGoogleCallback()
    {
        try
        {
            $user = Socialite::driver('google')
            ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
            ->stateless()
            ->user();
        }
        catch(Exception $e)
        {
            return redirect()->route('user.dangnhap')->with('warning', 'Lỗi xác thực. Xin vui lòng thử lại!');
        }
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser)
        {
        // Nếu người dùng đã tồn tại thì đăng nhập
            Auth::login($existingUser, true);
            return redirect()->route('user.home');
        }
        else
        {
        // Nếu chưa tồn tại người dùng thì thêm mới
            $newUser = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'username' => Str::before($user->email, '@'),
            'password' => Hash::make('larashop@2023'),
            'gioitinh' => "Nam",
            'namsinh' => "2000-01-01",
            'sodienthoai' => "0000000000",
            'diachi' => "a",
            'hinhanh' => "a.jpg",
            ]);
            Auth::login($newUser, true);
            return redirect()->route('user.home');
        }
    }

}
