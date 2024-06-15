<?php

namespace App\Http\Controllers;

use App\Models\RapChieu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RapChieuController extends Controller
{
    public function getDanhSach()
    {
        $rapchieu = RapChieu::all();
        return view('admin.rapchieu.danhsach', compact('rapchieu'));
    }
    public function getThem()
    {
        return view('admin.rapchieu.them');
    }
    public function postThem(Request $request)
    {
        $request->validate([
            'tenrap' => ['required', 'max:255', 'unique:rapchieu'],
            ]);

        $orm = new RapChieu();
        $orm->tenrap = $request->tenrap;
        $orm->tenrap_slug = Str::slug($request->tenrap, '-');
        $orm->diachi = $request->diachi;
        $orm->save();
        return redirect()->route('admin.rapchieu');
    }
    public function getSua($id)
    {
        $rapchieu = RapChieu::find($id);
        return view('admin.rapchieu.sua', compact('rapchieu'));
    }
    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tenrap' => ['required', 'max:255', 'unique:rapchieu,tenrap,'. $id],
            ]);

        $orm = RapChieu::find($id);
        $orm->tenrap = $request->tenrap;
        $orm->tenrap_slug = Str::slug($request->tenrap, '-');
        $orm->diachi = $request->diachi;
        $orm->save();
        return redirect()->route('admin.rapchieu');
    }
    public function getXoa($id)
    {
        $orm = RapChieu::find($id);$orm->delete();
        return redirect()->route('admin.rapchieu');
    }
}
