<?php

namespace App\Http\Controllers;

use App\Models\TheLoaiPhim;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TheLoaiPhimController extends Controller
{
    public function getDanhSach()
    {
        $theloaiphim = TheLoaiPhim::all();
        return view('admin.theloaiphim.danhsach', compact('theloaiphim'));
    }
    public function getThem()
    {
        return view('admin.theloaiphim.them');
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
        return redirect()->route('admin.theloaiphim');
    }
    public function getSua($id)
    {
        $theloaiphim = TheLoaiPhim::find($id);
        return view('admin.theloaiphim.sua', compact('theloaiphim'));
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
        return redirect()->route('admin.theloaiphim');
    }
    public function getXoa($id)
    {
        $orm = TheLoaiPhim::find($id);$orm->delete();
        return redirect()->route('admin.theloaiphim');
    }
}
