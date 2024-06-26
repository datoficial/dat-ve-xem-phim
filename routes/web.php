<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TheLoaiPhimController;
use App\Http\Controllers\PhimController;
use App\Http\Controllers\RapChieuController;
use App\Http\Controllers\PhongChieuController;
use App\Http\Controllers\SuatChieuController;
use App\Http\Controllers\VeController;
use App\Http\Controllers\ChuDeController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\BinhLuanController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DatVeController;
use App\Http\Controllers\UserController;

Auth::routes();
// Google OAuth
Route::get('/login/google', [HomeController::class, 'getGoogleLogin'])->name('google.login');
Route::get('/login/google/callback', [HomeController::class, 'getGoogleCallback'])->name('google.callback');

Route::name('frontend.')->group(function() {
        // Trang chủ
        Route::get('/', [HomeController::class, 'getHome'])->name('home');
        Route::get('/home', [HomeController::class, 'getHome'])->name('home');
        Route::get('/cap-nhat', [HomeController::class, 'getCapNhat'])->name('capnhat');
        Route::get('/phim-cua-rap/{tenrap_slug}', [HomeController::class, 'getPhimTheoRap'])->name('phim.theorap');
        Route::get('/phim-theo-loai/{tenloai_slug}', [HomeController::class, 'getPhimTheoLoai'])->name('phim.theoloai');

        Route::get('/lien-he', [HomeController::class, 'getLienHe'])->name('lienhe');

        Route::get('/tim-kiem', [HomeController::class, 'getTimKiem'])->name('timkiem');


        
        // Trang sản phẩm
        Route::get('/phim', [HomeController::class, 'getPhim'])->name('phim');
        Route::get('/phim/{tenloai_slug}', [HomeController::class, 'getPhim'])->name('phim.phanloai');
        Route::get('/phim/{tenloai_slug}/{tenphim_slug}', [HomeController::class, 'getPhim_ChiTiet'])->name('phim.chitiet');
        // Tin tức
        Route::get('/bai-viet', [HomeController::class, 'getBaiViet'])->name('baiviet');
        Route::get('/bai-viet/{phim_id}', [HomeController::class, 'getBaiViet'])->name('baiviet.phim');
        
        Route::get('/bai-viet/{tenchude_slug}', [HomeController::class, 'getBaiViet'])->name('baiviet.chude');
        Route::get('/bai-viet/{tenchude_slug}/{tieude_slug}', [HomeController::class, 'getBaiViet_ChiTiet'])->name('baiviet.chitiet');
        // Liên hệ
        Route::get('/lien-he', [HomeController::class, 'getLienHe'])->name('lienhe');

    });

    // Trang khách hàng
    Route::get('/khach-hang/dang-ky', [HomeController::class, 'getDangKy'])->name('user.dangky');
    Route::get('/khach-hang/dang-nhap', [HomeController::class, 'getDangNhap'])->name('user.dangnhap');
 
    Route::prefix('khach-hang')->name('booking.')->group(function() {
        // routes/web.php
        Route::get('/dat-ve/{phim_id}', [DatVeController::class, 'getDatVe'])->name('datve');
        Route::get('/dat-ve', [DatVeController::class, 'getChonGhe'])->name('chonghe');
        Route::post('/dat-ve/{phim_id}', [DatVeController::class, 'postDatVe'])->name('datve');
        Route::post('/vnpay_payment', [DatVeController::class, 'postVNPay'])->name('vnpay');
        Route::get('/dat-ve-thanh-cong', [DatVeController::class, 'getDatVeThanhCong'])->name('datvethanhcong');
        Route::post('/vnpay_payment', [DatVeController::class, 'postVNPay'])->name('vnpay');
    });
    
    // Trang tài khoản khách hàng
    Route::prefix('khach-hang')->name('user.')->middleware(['auth','user'])->group(function() {
        // Trang chủ
        Route::get('/', [KhachHangController::class, 'getHome'])->name('home');
        Route::get('/home', [KhachHangController::class, 'getHome'])->name('home');
        // Xem và cập nhật trạng thái đơn hàng
        Route::get('/ve-cua-toi/{id}', [KhachHangController::class, 'getVe'])->name('ve');
        // Cập nhật thông tin tài khoản
        Route::get('/ho-so-ca-nhan', [KhachHangController::class, 'getHoSoCaNhan'])->name('hosocanhan');
        Route::post('/ho-so-ca-nhan', [KhachHangController::class, 'postHoSoCaNhan'])->name('hosocanhan');
        Route::post('/binh-luan', [KhachHangController::class, 'postBinhLuan'])->name('binhluan');
        // Đăng xuất
        Route::post('/dang-xuat', [KhachHangController::class, 'postDangXuat'])->name('dangxuat');
    });
    
    Route::prefix('admin')->name('admin.')->middleware(['auth','manager'])->group(function() {
    Route::get('/', [AdminController::class, 'getHome'])->name('home');
    Route::get('/home', [AdminController::class, 'getHome'])->name('home');

    Route::get('/theloaiphim', [TheLoaiPhimController::class, 'getDanhSach'])->name('theloaiphim');
    Route::get('/theloaiphim/them', [TheLoaiPhimController::class, 'getThem'])->name('theloaiphim.them');
    Route::post('/theloaiphim/them', [TheLoaiPhimController::class, 'postThem'])->name('theloaiphim.them');
    Route::get('/theloaiphim/sua/{id}', [TheLoaiPhimController::class, 'getSua'])->name('theloaiphim.sua');
    Route::post('/theloaiphim/sua/{id}', [TheLoaiPhimController::class, 'postSua'])->name('theloaiphim.sua');
    Route::get('/theloaiphim/xoa/{id}', [TheLoaiPhimController::class, 'getXoa'])->name('theloaiphim.xoa');

    Route::get('/phim', [PhimController::class, 'getDanhSach'])->name('phim');
    Route::get('/phim/them', [PhimController::class, 'getThem'])->name('phim.them');
    Route::post('/phim/them', [PhimController::class, 'postThem'])->name('phim.them');
    Route::get('/phim/sua/{id}', [PhimController::class, 'getSua'])->name('phim.sua');
    Route::post('/phim/sua/{id}', [PhimController::class, 'postSua'])->name('phim.sua');
    Route::get('/phim/xoa/{id}', [PhimController::class, 'getXoa'])->name('phim.xoa');

    Route::get('/rapchieu', [RapChieuController::class, 'getDanhSach'])->name('rapchieu');
    Route::get('/rapchieu/them', [RapChieuController::class, 'getThem'])->name('rapchieu.them');
    Route::post('/rapchieu/them', [RapChieuController::class, 'postThem'])->name('rapchieu.them');
    Route::get('/rapchieu/sua/{id}', [RapChieuController::class, 'getSua'])->name('rapchieu.sua');
    Route::post('/rapchieu/sua/{id}', [RapChieuController::class, 'postSua'])->name('rapchieu.sua');
    Route::get('/rapchieu/xoa/{id}', [RapChieuController::class, 'getXoa'])->name('rapchieu.xoa');

    Route::get('/phongchieu', [PhongChieuController::class, 'getDanhSach'])->name('phongchieu');
    Route::get('/phongchieu/them', [PhongChieuController::class, 'getThem'])->name('phongchieu.them');
    Route::post('/phongchieu/them', [PhongChieuController::class, 'postThem'])->name('phongchieu.them');
    Route::get('/phongchieu/sua/{id}', [PhongChieuController::class, 'getSua'])->name('phongchieu.sua');
    Route::post('/phongchieu/sua/{id}', [PhongChieuController::class, 'postSua'])->name('phongchieu.sua');
    Route::get('/phongchieu/xoa/{id}', [PhongChieuController::class, 'getXoa'])->name('phongchieu.xoa');


    Route::get('/suatchieu', [SuatChieuController::class, 'getDanhSach'])->name('suatchieu');
    Route::get('/suatchieu/them', [SuatChieuController::class, 'getThem'])->name('suatchieu.them');
    Route::post('/suatchieu/them', [SuatChieuController::class, 'postThem'])->name('suatchieu.them');
    Route::get('/suatchieu/sua/{id}', [SuatChieuController::class, 'getSua'])->name('suatchieu.sua');
    Route::post('/suatchieu/sua/{id}', [SuatChieuController::class, 'postSua'])->name('suatchieu.sua');
    Route::get('/suatchieu/xoa/{id}', [SuatChieuController::class, 'getXoa'])->name('suatchieu.xoa');

    Route::get('/nguoidung', [UserController::class, 'getDanhSach'])->name('nguoidung');
    Route::get('/nguoidung/them', [UserController::class, 'getThem'])->name('nguoidung.them');
    Route::post('/nguoidung/them', [UserController::class, 'postThem'])->name('nguoidung.them');
    Route::get('/nguoidung/sua/{id}', [UserController::class, 'getSua'])->name('nguoidung.sua');
    Route::post('/nguoidung/sua/{id}', [UserController::class, 'postSua'])->name('nguoidung.sua');
    Route::get('/nguoidung/xoa/{id}', [UserController::class, 'getXoa'])->name('nguoidung.xoa');
    });

    Route::prefix('nhanvien')->name('nhanvien.')->middleware(['auth','nhanvien'])->group(function() {
    Route::get('/', [AdminController::class, 'getHome'])->name('home');
    Route::get('/home', [AdminController::class, 'getHome'])->name('home');
    
    Route::get('/ve', [VeController::class, 'getDanhSach'])->name('ve');
    Route::get('/ve/them', [VeController::class, 'getThem'])->name('ve.them');
    Route::post('/ve/them', [VeController::class, 'postThem'])->name('ve.them');
    Route::get('/ve/sua/{id}', [VeController::class, 'getSua'])->name('ve.sua');
    Route::post('/ve/sua/{id}', [VeController::class, 'postSua'])->name('ve.sua');
    Route::get('/ve/xoa/{id}', [VeController::class, 'getXoa'])->name('ve.xoa');



    Route::get('/chude', [ChuDeController::class, 'getDanhSach'])->name('chude');
    Route::get('/chude/them', [ChuDeController::class, 'getThem'])->name('chude.them');
    Route::post('/chude/them', [ChuDeController::class, 'postThem'])->name('chude.them');
    Route::get('/chude/sua/{id}', [ChuDeController::class, 'getSua'])->name('chude.sua');
    Route::post('/chude/sua/{id}', [ChuDeController::class, 'postSua'])->name('chude.sua');
    Route::get('/chude/xoa/{id}', [ChuDeController::class, 'getXoa'])->name('chude.xoa');
    // Quản lý Bài viết
    Route::get('/baiviet', [BaiVietController::class, 'getDanhSach'])->name('baiviet');
    Route::get('/baiviet/them', [BaiVietController::class, 'getThem'])->name('baiviet.them');
    Route::post('/baiviet/them', [BaiVietController::class, 'postThem'])->name('baiviet.them');
    Route::get('/baiviet/sua/{id}', [BaiVietController::class, 'getSua'])->name('baiviet.sua');
    Route::post('/baiviet/sua/{id}', [BaiVietController::class, 'postSua'])->name('baiviet.sua');
    Route::get('/baiviet/xoa/{id}', [BaiVietController::class, 'getXoa'])->name('baiviet.xoa');
    Route::get('/baiviet/kiemduyet/{id}', [BaiVietController::class, 'getKiemDuyet'])->name('baiviet.kiemduyet');
    Route::get('/baiviet/kichhoat/{id}', [BaiVietController::class, 'getKichHoat'])->name('baiviet.kichhoat');
    // Quản lý Bình luận bài viết
    Route::get('/binhluan', [BinhLuanController::class, 'getDanhSach'])->name('binhluan');
    Route::get('/binhluan/them', [BinhLuanController::class, 'getThem'])->name('binhluan.them');
    Route::post('/binhluan/them', [BinhLuanController::class, 'postThem'])->name('binhluan.them');
    Route::get('/binhluan/sua/{id}', [BinhLuanController::class, 'getSua'])->name('binhluan.sua');
    Route::post('/binhluan/sua/{id}', [BinhLuanController::class, 'postSua'])->name('binhluan.sua');
    Route::get('/binhluan/xoa/{id}', [BinhLuanController::class, 'getXoa'])->name('binhluan.xoa');
    Route::get('/binhluan/kiemduyet/{id}', [BinhLuanController::class, 'getKiemDuyet'])->name('binhluan.kiemduyet');
    Route::get('/binhluan/kichhoat/{id}', [BinhLuanController::class, 'getKichHoat'])->name('binhluan.kichhoat');
    });
