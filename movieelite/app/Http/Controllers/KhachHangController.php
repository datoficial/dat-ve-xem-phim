<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Ve;
use App\Models\ChiTietVe;
use App\Models\Phim;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class KhachHangController extends Controller
{
    public function getHome()
    {
        if(Auth::check())
        {
        $nguoidung = User::find(Auth::user()->id);
        return view('user.home', compact('nguoidung'));
        }
        else
        return redirect()->route('user.dangnhap');
    }

    public function getVe($id)
    {
            $user = User::findOrFail($id);
            $ve = $user->ve;
            $qrCodeFileName = session('qrCodeFileName');
            return view('user.ve', compact('ve', 'qrCodeFileName'));
        
    }
    
    public function postVe(Request $request, $id)
    {
    // Bổ sung code tại đây
    }
    public function getHoSoCaNhan()
    {
    // Bổ sung code tại đây
        return redirect()->route('user.home');
    }
    public function postHoSoCaNhan(Request $request)
    {
        $id = Auth::user()->id;
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password' => ['confirmed'],
        ]);

        $orm = User::find($id);
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        $orm->gioitinh = $request->gioitinh;
        $orm->namsinh = $request->namsinh;
        $orm->sodienthoai = $request->sodienthoai;
        $orm->diachi = $request->diachi;
        if(!empty($request->password)) $orm->password = Hash::make($request->password);
        $orm->save();
        return redirect()->route('user.home')->with('success', 'Đã cập nhật thông tin thành công.');
    }
    public function postDangXuat(Request $request)
    {
    // Bổ sung code tại đây
        return redirect()->route('frontend.home');
    }
}
