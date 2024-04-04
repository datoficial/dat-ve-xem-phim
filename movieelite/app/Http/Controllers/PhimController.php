<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use App\Models\TheLoaiPhim;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class PhimController extends Controller
{
    public function getDanhSach()
    {
        $phim = Phim::paginate(25);
        return view('admin.phim.danhsach', compact('phim'));
    }
    public function getThem()
    {
        $theloaiphim = TheLoaiPhim::all();
        return view('admin.phim.them', compact('theloaiphim'));
    }
    public function postThem(Request $request)
    {
        $request->validate([
            'tenphim' => ['required', 'max:255', 'unique:phim'],
            'hinhanh' => ['nullable', 'max:2048'],
            ]);
        $path = '';
            if($request->hasFile('hinhanh'))
            {
                // Tạo thư mục nếu chưa có
                $tlp = TheLoaiPhim::find($request->theloaiphim_id);
                File::isDirectory($tlp->tenloai_slug) or Storage::makeDirectory($tlp->tenloai_slug, 0775);// Xác định tên tập tin
                $extension = $request->file('hinhanh')->extension();
                $filename = Str::slug($request->tenphim, '-') . '.' . $extension;
                // Upload vào thư mục và trả về đường dẫn
                $path = Storage::putFileAs($tlp->tenloai_slug, $request->file('hinhanh'), $filename);
            }
        $orm = new Phim();
        $orm->theloaiphim_id = $request->theloaiphim_id;
        $orm->tenphim = $request->tenphim;
        $orm->tenphim_slug = Str::slug($request->tenphim, '-');
        $orm->gioihantuoi = $request->gioihantuoi;
        $orm->quocgia = $request->quocgia;
        $orm->mota = $request->mota;
        $orm->trailler = $request->trailler;
        $orm->trangthai = $request->trangthai;
        if(!empty($path)) $orm->hinhanh = $path;
        $orm->save();
        return redirect()->route('admin.phim');
    }
    public function getSua($id)
    {
        $phim = Phim::find($id);
        $theloaiphim = TheLoaiPhim::all();
        return view('admin.phim.sua', compact('phim', 'theloaiphim'));
    }
    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tenphim' => ['required', 'max:255', 'unique:phim,tenphim,'. $id],
            ]);
            $path = '';
        if($request->hasFile('hinhanh'))
            {
                // Xóa tập tin cũ
                $p = Phim::find($id);
                if(!empty($p->hinhanh)) Storage::delete($p->hinhanh);
                // Xác định tên tập tin mới
                $extension = $request->file('hinhanh')->extension();
                $filename = Str::slug($request->tenphim, '-') . '.' . $extension;
                // Upload vào thư mục và trả về đường dẫn
                $tlp = TheLoaiPhim::find($request->theloaiphim_id);$path = Storage::putFileAs($tlp->tenloai_slug, $request->file('hinhanh'), $filename);
            }
        $orm = Phim::find($id);
        $orm->theloaiphim_id = $request->theloaiphim_id;
        $orm->tenphim = $request->tenphim;
        $orm->tenphim_slug = Str::slug($request->tenphim, '-');
        $orm->gioihantuoi = $request->gioihantuoi;
        $orm->quocgia = $request->quocgia;
        $orm->mota = $request->mota;
        $orm->trailler = $request->trailler;
        $orm->trangthai = $request->trangthai;
        if(!empty($path)) $orm->hinhanh = $path;
        $orm->save();
        return redirect()->route('admin.phim');
    }
    public function getXoa($id)
    {
        $orm = Phim::find($id);
        $orm->delete();
        return redirect()->route('admin.phim');
    }
}
