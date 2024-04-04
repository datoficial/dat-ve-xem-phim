<?php

namespace App\Http\Controllers;

use App\Models\PhongChieu;
use App\Models\RapChieu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PhongChieuController extends Controller
{
    public function getDanhSach()
    {
        $phongchieu = PhongChieu::paginate(25);
        return view('admin.phongchieu.danhsach', compact('phongchieu'));
    }
    public function getThem()
    {
        $rapchieu = RapChieu::all();
        return view('admin.phongchieu.them', compact('rapchieu'));
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
        return redirect()->route('admin.phongchieu');
    }
    public function getSua($id)
    {
        $phongchieu = PhongChieu::find($id);
        $rapchieu = RapChieu::all();
        return view('admin.phongchieu.sua', compact('phongchieu', 'rapchieu'));
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
        return redirect()->route('admin.phongchieu');
    }
    public function getXoa($id)
    {
        $orm = PhongChieu::find($id);
        $orm->delete();
        return redirect()->route('admin.phongchieu');
    }
}
