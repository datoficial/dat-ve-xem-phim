<?php

namespace App\Http\Controllers;

use App\Models\Ve;
use App\Models\User;
use App\Models\SuatChieu;
use App\Models\PhongChieu;
use App\Models\Phim;
use App\Models\RapChieu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VeController extends Controller
{
    public function getDanhSach(Request $request)
    {
        $ve = Ve::join('suatchieu', 've.suatchieu_id', '=', 'suatchieu.id')
        ->join('phongchieu', 'suatchieu.phongchieu_id', '=', 'phongchieu.id')
        ->join('rapchieu', 'phongchieu.rapchieu_id', '=', 'rapchieu.id')
        ->orderBy('ngayban') 
        ->paginate(20);
    
        $ngay_a = Carbon::parse($request->input('ngay_a'))->toDateString();
        $ngay_b = Carbon::parse($request->input('ngay_b'))->toDateString();
        $thongkerapchieu = RapChieu::all()->map(function ($rapchieu) use ($ngay_a, $ngay_b) {
            $so_luong_ve = 0;
            $doanh_thu = 0;
            $so_luong_ghe = 0;
        
            foreach ($rapchieu->phongchieu as $phongchieu) {
                foreach ($phongchieu->suatchieu as $suatchieu) {
                    foreach ($suatchieu->ve as $ve) {
                        $ngay_ban = Carbon::parse($ve->ngayban);
                        if ($ngay_ban->greaterThanOrEqualTo($ngay_a) && $ngay_ban->lessThanOrEqualTo($ngay_b)) {
                            $so_luong_ve++;
                            $so_luong_ghe += $ve->soluong;
                            $doanh_thu += $ve->giave;
                        }
                    }
                }
            }
        
            $rapchieu->so_luong_ve = $so_luong_ve;
            $rapchieu->doanh_thu = $doanh_thu;
            $rapchieu->so_luong_ghe = $so_luong_ghe;
            return $rapchieu;
        });
                return view('nhanvien.ve.danhsach', compact('ve', 'thongkerapchieu','ngay_a','ngay_b'));    
    }
    
    public function getSua($id)
    {
        $ve = Ve::find($id);
        $user = User::all();
        $suatchieu = SuatChieu::all();
        $phim = Phim::all();
        $phongchieu = PhongChieu::all();
        $rapchieu = RapChieu::all();
        return view('nhanvien.ve.sua', compact('ve', 'user','suatchieu','phim','phongchieu','rapchieu'));
    }
    public function postSua(Request $request, $id)
    {
        $orm = Ve::find($id);
        $orm->user_id = $request->user_id;
        $orm->suatchieu_id = $request->suatchieu_id;
        $orm->ngayban = $request->ngayban;
        $orm->tenghe = $request->tenghe;
        $orm->soluong = $request->soluong;
        $orm->giave = $request->soluong*85000;
        $orm->qrcode = $orm->qrcode;
        $orm->save();
        return redirect()->route('nhanvien.ve');
    }
    public function getXoa($id)
    {
        $orm = Ve::find($id);
        $orm->delete();
        return redirect()->route('nhanvien.ve');
    }
}
