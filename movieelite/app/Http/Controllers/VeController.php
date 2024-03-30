<?php

namespace App\Http\Controllers;

use App\Models\Ve;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VeController extends Controller
{
    public function getDanhSach()
    {
        $ve = Ve::paginate(25);
        return view('admin.ve.danhsach', compact('ve'));
    }
    public function getThem()
    {
        $ve = User::all();
        $ve = SuatChieu::all();
        return view('admin.ve.them', compact('ve'));
    }
    public function postThem(Request $request)
    {
        $orm = new Ve();
        $orm->user_id = $request->user_id;
        $orm->suatchieu_id = $request->suatchieu_id;
        $orm->save();
        return redirect()->route('admin.ve');
    }
    public function getSua($id)
    {
        $ve = Ve::find($id);
        $ve = User::all();
        $ve = SuatChieu::all();
        return view('admin.ve.sua', compact('ve', 'nguoidung','suatchieu'));
    }
    public function postSua(Request $request, $id)
    {
        $orm = Ve::find($id);
        $orm->user_id = $request->user_id;
        $orm->suatchieu_id = $request->suatchieu_id;
        $orm->save();
        return redirect()->route('admin.ve');
    }
    public function getXoa($id)
    {
        $orm = Ve::find($id);
        $orm->delete();
        return redirect()->route('admin.ve');
    }
}
