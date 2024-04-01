<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\PhongChieu;
use App\Models\RapChieu;
use App\Models\SuatChieu;
use App\Models\Ve;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DatVeController extends Controller
{

    public function getDatVe(Request $request, $phim_id)
    {
        if(Auth::check()) {
            $phim = Phim::find($phim_id);
            
            $suatchieu = SuatChieu::with('phongchieu')->where('phim_id', $phim_id)->get();
        
            return view('booking.datve', compact('suatchieu', 'phim'));
        } else {
            return redirect()->route('user.dangnhap');
        }
    }
// Trong hàm getChonGhe của bạn
public function getChonGhe(Request $request)
{
    $ve = Ve::all();
    $ve_data = $ve->pluck('tenghe')->toArray();

    // Lấy danh sách các ghế đã chọn từ cơ sở dữ liệu
    $ghes_da_chon = Ve::pluck('tenghe')->toArray();

    return view("booking.chonghe", compact('ve', 've_data', 'ghes_da_chon'));
}

    public function postDatVe(Request $request)
    {
        // Tạo một đối tượng vé mới
        $ve = new Ve();
        $ve->user_id = Auth::id(); 
        $ve->suatchieu_id = $request->suatchieu_id; 
        $ve->ngayban = now();
        $ve->tenghe = $request->tenghe; 
        $ve->soluong = $request->soluong; 
        $ve->giave = $request->giave; 
        $ve->save();

        return redirect()->route('booking.datvethanhcong');
    }
    public function getDatVeThanhCong()
    {   
        return view('booking.datvethanhcong');
    }
}
