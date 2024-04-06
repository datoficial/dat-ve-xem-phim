<?php

namespace App\Http\Controllers;

use App\Models\Ve;
use App\Models\User;
use App\Models\SuatChieu;
use App\Models\PhongChieu;
use App\Models\Phim;

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
        return view('admin.ve.danhsach',compact('ve','users', 'suatchieu','phim','phongchieu'));
    }


    public function getSua($id)
    {
        $ve = Ve::find($id);
        $user = User::all();
        $suatchieu = SuatChieu::all();
        return view('admin.ve.sua', compact('ve', 'user','suatchieu'));
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
