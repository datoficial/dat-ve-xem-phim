<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use App\Models\TheLoaiPhim;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PhimController extends Controller
{
    public function getDanhSach()
    {
        $phim = Phim::paginate(25);
        return view('phim.danhsach', compact('phim'));
    }
    public function getThem()
    {
        $theloaiphim = TheLoaiPhim::all();
        return view('phim.them', compact('theloaiphim'));
    }
    public function postThem(Request $request)
    {
        $request->validate([
            'tenphim' => ['required', 'max:255', 'unique:phim'],
            ]);

        $orm = new Phim();
        $orm->theloaiphim_id = $request->theloaiphim_id;
        $orm->tenphim = $request->tenphim;
        $orm->tenphim_slug = Str::slug($request->tenphim, '-');
        $orm->gioihantuoi = $request->gioihantuoi;
        $orm->quocgia = $request->quocgia;
        $orm->mota = $request->mota;
        $orm->trailler = $request->trailler;
        $orm->trangthai = $request->trangthai;
        $orm->save();
        return redirect()->route('phim');
    }
    public function getSua($id)
    {
        $phim = Phim::find($id);
        $theloaiphim = TheLoaiPhim::all();
        return view('phim.sua', compact('phim', 'theloaiphim'));
    }
    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tenphim' => ['required', 'max:255', 'unique:phim,tenphim,'. $id],
            ]);

        $orm = Phim::find($id);
        $orm->theloaiphim_id = $request->theloaiphim_id;
        $orm->tenphim = $request->tenphim;
        $orm->tenphim_slug = Str::slug($request->tenphim, '-');
        $orm->gioihantuoi = $request->gioihantuoi;
        $orm->quocgia = $request->quocgia;
        $orm->mota = $request->mota;
        $orm->trailler = $request->trailler;
        $orm->trangthai = $request->trangthai;
        $orm->save();
        return redirect()->route('phim');
    }
    public function getXoa($id)
    {
        $orm = Phim::find($id);
        $orm->delete();
        return redirect()->route('phim');
    }
}
