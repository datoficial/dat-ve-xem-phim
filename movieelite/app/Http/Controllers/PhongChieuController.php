<?php

namespace App\Http\Controllers;

use App\Models\PhongChieu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PhongChieuController extends Controller
{
    public function getDanhSach()
    {
        $phongchieu = PhongChieu::paginate(25);
        return view('phongchieu.danhsach', compact('phongchieu'));
    }
    public function getThem()
    {
        $phongchieu = RapChieu::all();
        return view('phongchieu.them', compact('phongchieu'));
    }
    public function postThem(Request $request)
    {
        $request->validate([
            'tenphong' => ['required', 'max:255', 'unique:phongchieu'],
            ]);

        $orm = new PhongChieu();
        $orm->rapchieu_id = $request->rapchieu_id;
        $orm->tenphong = $request->tenphong;
        $orm->tenphong_slug = Str::slug($request->tenphong, '-');
        $orm->save();
        return redirect()->route('phongchieu');
    }
    public function getSua($id)
    {
        $phongchieu = PhongChieu::find($id);
        $phongchieu = RapChieu::all();
        return view('phongchieu.sua', compact('phongchieu', 'rapchieu'));
    }
    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tenphong' => ['required', 'max:255', 'unique:phongchieu,tenphong,'. $id],
            ]);

        $orm = PhongChieu::find($id);
        $orm->rapchieu_id = $request->rapchieu_id;
        $orm->tenphong = $request->tenphong;
        $orm->tenphong_slug = Str::slug($request->tenphong, '-');
        $orm->save();
        return redirect()->route('phongchieu');
    }
    public function getXoa($id)
    {
        $orm = PhongChieu::find($id);
        $orm->delete();
        return redirect()->route('phongchieu');
    }
}
