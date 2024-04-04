<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\BinhLuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BinhLuanController extends Controller
{
    public function getDanhSach()
    {
        $binhluan = BinhLuan::orderBy('created_at', 'desc')->get();
        return view('admin.binhluan.danhsach', compact('binhluan'));
    }
    public function getThem()
    {
        $baiviet = BaiViet::orderBy('created_at', 'desc')->get();
        return view('admin.binhluan.them', compact('baiviet'));
    }
    public function postThem(Request $request)
    {// Kiểm tra
        $request->validate([
        'baiviet_id' => ['required', 'integer'],
        'noidungbinhluan' => ['required', 'string', 'min:20'],
    ]);
        $orm = new BinhLuan();
        $orm->baiviet_id = $request->baiviet_id;
        $orm->user_id = Auth::user()->id;
        $orm->noidungbinhluan = $request->noidungbinhluan;
        $orm->save();
        // Sau khi thêm thành công thì tự động chuyển về trang danh sách
        return redirect()->route('admin.binhluan');
    }
    public function getSua($id)
    {
        $baiviet = BaiViet::orderBy('created_at', 'desc')->get();
        $binhluan = BinhLuan::find($id);
        return view('admin.binhluan.sua', compact('baiviet', 'binhluan'));
    }
    public function postSua(Request $request, $id)
    {
    // Kiểm tra
        $request->validate([
        'baiviet_id' => ['required', 'integer'],
        'noidungbinhluan' => ['required', 'string', 'min:20'],
        ]);
        $orm = BinhLuan::find($id);
        $orm->baiviet_id = $request->baiviet_id;
        $orm->noidungbinhluan = $request->noidungbinhluan;
        $orm->save();
        // Sau khi sửa thành công thì tự động chuyển về trang danh sách
        return redirect()->route('admin.binhluan');
    }
    public function getXoa($id)
    {
        $orm = BinhLuan::find($id);
        $orm->delete();
        // Sau khi xóa thành công thì tự động chuyển về trang danh sách
        return redirect()->route('admin.binhluan');
    }
    public function getKiemDuyet($id)
    {
        $orm = BinhLuan::find($id);
        $orm->kiemduyet = 1 - $orm->kiemduyet;
        $orm->save();
        return redirect()->route('admin.binhluan');
    }
    public function getKichHoat($id)
    {
        $orm = BinhLuan::find($id);
        $orm->kichhoat = 1 - $orm->kichhoat;
        $orm->save();
        return redirect()->route('admin.binhluan');
    }

}
