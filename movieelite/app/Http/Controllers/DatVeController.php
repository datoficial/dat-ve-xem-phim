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

class DatVeController extends Controller
{
    public function getSuatChieu(Request $request, $phim_id)
    {
        $suatchieu = SuatChieu::where('phim_id', $phim_id)->get();

        return view('datve.chonsuatchieu', compact('suatchieu', 'phim_id'));
    }
    
    public function getChonGhe(Request $request, $phim_id)
    {
        $suatchieu = SuatChieu::where('phim_id', $phim_id)->first(); 
        return view('datve.chonghe', compact('suatchieu'));
    }
    public function postSuatChieu(Request $request, $suatchieu_id)
    {
        // Xác thực dữ liệu
        $request->validate([
            'tenghe' => 'required',
        ]);

        // Tạo vé mới
        $ve = new Ve();
        $ve->user_id = auth()->id(); // Đây là user đăng nhập
        $ve->suatchieu_id = $suatchieu_id;
        
        // Lấy thông tin suất chiếu
        $suatchieu = SuatChieu::findOrFail($suatchieu_id);
        $ve->ngaychieu = $suatchieu->ngaychieu;
        $ve->giobatdau = $suatchieu->giobatdau;

        $ve->save();

        // Redirect hoặc hiển thị thông báo thành công
        return redirect()->route('datve.thanhtoan', $ve->id);
    }

    
    public function postChonGhe(Request $request, $suatchieu_id)
    {
    // Lấy thông tin suất chiếu
    $suatChieu = SuatChieu::findOrFail($suatchieu_id);

    // Lấy thông tin về các ghế đã được đặt trong suất chiếu này (nếu có)
    $daDat = $suatChieu->Ve->pluck('tenghe')->toArray();

    // Các ghế có sẵn
    $gheCoSan = ['A1', 'A2', 'A3', 'B1', 'B2', 'B3', 'C1', 'C2', 'C3'];

    // Loại bỏ các ghế đã đặt khỏi danh sách ghế có sẵn
    $gheTrong = array_diff($gheCoSan, $daDat);
        // Tạo chi tiết vé
        $chiTietVe = new ChiTietVe();
        $chiTietVe->ve_id = $ve->id;
        $chiTietVe->ngayban = now();
        $chiTietVe->tenghe = $request->tenghe;
        $chiTietVe->soluong = $request->soluong;
        $chiTietVe->giave = $chiTietVe->giave; 
    
        $chiTietVe->save();
    }

    public function ThanhToan(Request $request, $veId)
    {
        // Lấy thông tin vé
        $ve = Ve::findOrFail($veId);

        // Hiển thị trang thanh toán
        return view('thanh-toan', compact('ve'));
    }

    public function getXemVe(Request $request, $veId)
    {
        // Lấy thông tin vé
        $ve = Ve::findOrFail($veId);

        // Hiển thị vé
        return view('xem-ve', compact('ve'));
    }
}
