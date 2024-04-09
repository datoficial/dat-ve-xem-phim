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

class VeController extends Controller
{
    public function getDanhSach()
    {
        $ve = Ve::paginate(25);
        
            $users = User::all(); 
            $suatchieu = SuatChieu::all();
            $phongchieu = PhongChieu::all();
            $phim = Phim::all();
        return view('nhanvien.ve.danhsach',compact('ve','users', 'suatchieu','phim','phongchieu'));
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
