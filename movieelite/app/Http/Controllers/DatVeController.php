<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\PhongChieu;
use App\Models\RapChieu;
use App\Models\SuatChieu;
use App\Models\Ve;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

class DatVeController extends Controller
{

   
    public function getDatVe(Request $request, $phim_id)
    {
        if(Auth::check()) {
            // Selecting specific columns using the select method
            $phim = Phim::select('id', 'tenphim', 'hinhanh')->find($phim_id);
            
            $suatchieu = SuatChieu::with('phongchieu.rapchieu')->where('phim_id', $phim_id)->get();

        
            return view('booking.datve', compact('suatchieu', 'phim'));
        } else {
            return redirect()->route('user.dangnhap');
        }
    }
    public function getChonGhe(Request $request)
    {

        return view("booking.chonghe");
    }

    public function postDatVe(Request $request)
    {
        // Tạo một đối tượng vé mới
        $ve = new Ve();
        $ve->user_id = Auth::id(); 
        $ve->suatchieu_id = $request->suatchieu_id; 
        $ve->ngayban = now();
        $ve->tenghe = $request->tenghe; 
        $ve->soluong = $request->soluong; 
        $ve->giave = $request->giave; 
    
        // Kiểm tra xem vé có được lưu vào cơ sở dữ liệu thành công không
        if ($ve->save()) {
            // Tạo mã vạch cho vé
            $barcode = new DNS1D();
            $barcodeData = strval($ve->id); // Chuyển đổi số nguyên thành chuỗi
            $barcodeFilename = $ve->id . '.png'; // Giữ nguyên số nguyên
            
            // Lưu mã vạch vào thư mục qrcodes
            $barcode->setStorPath(public_path('qrcodes')); // Đường dẫn lưu mã vạch
    
            $barcode->getBarcodePNGPath($barcodeData, 'C128', 3, 33, array(1,1,1), true); // Tạo mã vạch và lưu vào tệp PNG
    
            $ve->qrcode = 'qrcodes/' . $barcodeFilename; // Lưu đường dẫn tới tệp mã vạch vào cơ sở dữ liệu
    
            $ve->save();
    
            // Lưu đường dẫn của ảnh mã vạch vào session
            // Lưu đường dẫn của ảnh mã vạch vào session
            session(['qrCodeFileName' => 'qrcodes' . $barcodeFilename]);
    
            // Redirect đến trang "datvethanhcong"
            return redirect()->route('booking.datvethanhcong');
        } else {
            // Xử lý lỗi khi không thể lưu vé vào cơ sở dữ liệu
            return response()->json(['error' => 'Không thể lưu vé vào cơ sở dữ liệu'], 500);
        }
    }
    public function getDatVeThanhCong()
    {

        return view('booking.datvethanhcong');
    }

}
