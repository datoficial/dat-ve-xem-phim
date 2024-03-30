<?php

namespace App\Http\Controllers;

use App\Models\SuatChieu;
use App\Models\PhongChieu;
use App\Models\Phim;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class SuatChieuController extends Controller
{
    public function getDanhSach()
    {
        $suatchieu = SuatChieu::paginate(25);
        return view('admin.suatchieu.danhsach', compact('suatchieu'));
    }
    public function getThem()
    {
        $phongchieu = PhongChieu::all();
        $phim = Phim::all();
        return view('admin.suatchieu.them', compact('phongchieu','phim'));
    }
    public function postThem(Request $request)
    {
        $orm = new SuatChieu();
        $orm->phongchieu_id = $request->phongchieu_id;
        $orm->phim_id = $request->phim_id;
        $orm->ngaychieu = $request->ngaychieu;
        $orm->giobatdau = $request->giobatdau;
        $orm->gioketthuc = $request->gioketthuc;
        $orm->save();
        return redirect()->route('admin.suatchieu');
    }
    public function getSua($id)
    {
        $suatchieu = SuatChieu::find($id);
        $phongchieu = PhongChieu::all();
        $phim = Phim::all();
        return view('admin.suatchieu.sua', compact('suatchieu', 'phongchieu','phim'));
    }
    public function postSua(Request $request, $id)
    {
        $orm = SuatChieu::find($id);
        $orm->phongchieu_id = $request->phongchieu_id;
        $orm->phim_id = $request->phim_id;
        $orm->ngaychieu = $request->ngaychieu;
        $orm->giobatdau = $request->giobatdau;
        $orm->gioketthuc = $request->gioketthuc;
        $orm->save();
        return redirect()->route('admin.suatchieu');
    }
    public function getXoa($id)
    {
        $orm = SuatChieu::find($id);
        $orm->delete();
        return redirect()->route('admin.suatchieu');
    }
}
