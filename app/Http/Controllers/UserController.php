<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserController extends Controller
{
    public function getDanhSach()
    {
        $nguoidung = User::all();
        return view('admin.nguoidung.danhsach', ['nguoidung' => $nguoidung]);
    }
    public function getThem()
    {
        return view('admin.nguoidung.them');
    }
    public function postThem(Request $request)
    {
        $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'role' => ['required'],
        'password' => ['required', 'min:4', 'confirmed'],
        ]);
        $orm = new User();
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        $orm->password = Hash::make($request->password);
        $orm->gioitinh = $request->gioitinh;
        $orm->namsinh = $request->namsinh;
        $orm->sodienthoai = $request->sodienthoai;
        $orm->diachi = $request->diachi;
        $orm->role = $request->role;
        $orm->save();
        return redirect()->route('admin.nguoidung');
    }
    public function getSua($id)
    {
        $nguoidung = User::find($id);
        return view('admin.nguoidung.sua', ['nguoidung' => $nguoidung]);
    }
    public function postSua(Request $request)
    {
        $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->id],
        'role' => ['required'],
        'password' => ['confirmed'],
        ]);
        $orm = User::find($request->id);
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        $orm->gioitinh = $request->gioitinh;
        $orm->namsinh = $request->namsinh;
        $orm->sodienthoai = $request->sodienthoai;
        $orm->diachi = $request->diachi;
        if(!empty($path)) $orm->hinhanh = $path;
        $orm->role = $request->role;
        if(!empty($request->password)) $orm->password = Hash::make($request->password);
        $orm->save();
        return redirect()->route('admin.nguoidung');
    }
    public function getXoa($id)
    {
        $orm = User::find($id);
        $orm->delete();
        return redirect()->route('admin.nguoidung');
    }
}