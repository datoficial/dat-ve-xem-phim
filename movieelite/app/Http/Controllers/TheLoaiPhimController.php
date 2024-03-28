<?php

namespace App\Http\Controllers;

use App\Models\TheLoaiPhim;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TheLoaiPhimController extends Controller
{
    public function getDanhSach()
    {
        $theloaiphim = TheLoaiPhim::all();
        return view('theloaiphim.danhsach', compact('theloaiphim'));
    }
    public function getThem()
    {
        return view('theloaiphim.them');
    }
    public function postThem(Request $request)
    {
        $request->validate([
            'tenloai' => ['required', 'max:255', 'unique:theloaiphim'],
            ]);

        $orm = new TheLoaiPhim();
        $orm->tenloai = $request->tenloai;
        $orm->tenloai_slug = Str::slug($request->tenloai, '-');
        $orm->save();
        return redirect()->route('theloaiphim');
    }
    public function getSua($id)
    {
        $theloaiphim = TheLoaiPhim::find($id);
        return view('theloaiphim.sua', compact('theloaiphim'));
    }
    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tenloai' => ['required', 'max:255', 'unique:theloaiphim,tenloai,'. $id],
            ]);

        $orm = TheLoaiPhim::find($id);
        $orm->tenloai = $request->tenloai;
        $orm->tenloai_slug = Str::slug($request->tenloai, '-');
        $orm->save();
        return redirect()->route('theloaiphim');
    }
    public function getXoa($id)
    {
        $orm = TheLoaiPhim::find($id);$orm->delete();
        return redirect()->route('theloaiphim');
    }
}
