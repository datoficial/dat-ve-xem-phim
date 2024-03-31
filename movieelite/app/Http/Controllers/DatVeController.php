<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\PhongChieu;
use App\Models\RapChieu;
use App\Models\SuatChieu;
use App\Models\Ve;
use App\Models\ChiTietVe;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DatVeController extends Controller
{

    public function getDatVe(Request $request, $phim_id)
    {
        // Không cần gán lại giá trị cho biến $phim_id ở đây
        $phim = Phim::find($phim_id);
        
        $suatchieu = SuatChieu::where('phim_id', $phim_id)->get();
    
        foreach ($suatchieu as $suat) {
            $phongchieu = PhongChieu::find($suat->phongchieu_id);
            $suat->phongchieu = $phongchieu;
        }
    
        return view('booking.datve', compact('suatchieu', 'phim'));
    }
    
    
    
    public function postDatVe(Request $request)
    {
        // Lưu thông tin vé
        $ve = new Ve();
        $ve->user_id = $request->user_id;
        $ve->suatchieu_id = $request->suatchieu_id;
        $ve->save();

        // Lưu thông tin chi tiết vé
        foreach ($request->chitietve as $ctv) {
            $chitietve = new ChiTietVe();
            $chitietve->ve_id = $ve->id;
            $chitietve->ngayban = $ctv['ngayban'];
            $chitietve->tenghe = $ctv['tenghe'];
            $chitietve->soluong = $ctv['soluong'];
            $chitietve->giave = $ctv['giave'];
            $chitietve->save();
        }

        return response()->json(['message' => 'Đặt vé thành công']);
    }
}
