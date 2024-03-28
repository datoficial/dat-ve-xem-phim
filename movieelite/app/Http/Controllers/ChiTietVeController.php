<?php

namespace App\Http\Controllers;

use App\Models\ChiTietVe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ChiTietVeController extends Controller
{
    public function getDanhSach()
    {
        $chitietve = ChiTietVe::paginate(25);
        return view('chitietve.danhsach', compact('chitietve'));
    }
    public function getThem()
    {
        $ve = Ve::all();
        return view('chitietve.them', compact('ve'));
    }
    public function postThem(Request $request)
    {
        $orm = new ChiTietVe();
        $orm->ve_id = $request->ve_id;
        $orm->ngayban = $request->tenphim;
        $orm->tenghe = $request->gioihantuoi;
        $orm->soluong = $request->quocgia;
        $orm->giave = $request->mota;
        $orm->save();
        return redirect()->route('chitietve');
    }
    public function getSua($id)
    {
        $chitietve = ChiTietVe::find($id);
        $ve = Ve::all();
        return view('chitietve.sua', compact('chitietve', 've'));
    }
    public function postSua(Request $request, $id)
    {
        $orm = ChiTietVe::find($id);
        $orm->ve_id = $request->ve_id;
        $orm->ngayban = $request->tenphim;
        $orm->tenghe = $request->gioihantuoi;
        $orm->soluong = $request->quocgia;
        $orm->giave = $request->mota;
        $orm->save();
        return redirect()->route('chitietve');
    }
    public function getXoa($id)
    {
        $orm = ChiTietVe::find($id);
        $orm->delete();
        return redirect()->route('chitietve');
    }
}
