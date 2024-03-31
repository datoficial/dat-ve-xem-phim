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
        public function getVe()
        {
            $users = User::all(); // Đổi tên biến để mô tả hơn
            $suatchieu = SuatChieu::all();
            return view('admin.ve.them', compact('users', 'suatchieu')); // Đổi tên biến ở đây
        }

    public function postVe(Request $request)
    {
        // Lấy user_id của người dùng đã xác thực
        $user_id = auth()->id();
    
        // Validate dữ liệu yêu cầu để đảm bảo 'user_id' và 'suatchieu_id' tồn tại
        $request->validate([
            'suatchieu_id' => 'required',
        ]);
    
        $orm = new Ve();
        $orm->user_id = $user_id; // Sử dụng user_id đã lấy
        $orm->suatchieu_id = $request->suatchieu_id;
        $orm->save();
    
        return redirect()->route('admin.ve');
    }
    
    
    public function getSua($id)
    {
        $ve = Ve::find($id);
        $user = User::all();
        $suatchieu = SuatChieu::all();
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
