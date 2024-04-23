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

public function postVNPay(Request $request)
{
    $cartValue = $request->giave;
    $cartValue = str_replace(['.', 'đ'], '', $cartValue);
    $cartValue = intval($cartValue); 
    $data = $request->all();
    $code_cart = rand(00,9999);
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://127.0.0.1:81/movieelite/khach-hang/dat-ve-thanh-cong";
    $vnp_TmnCode = "1F37RGP9";
    $vnp_HashSecret = "QEMJNIXIKUQXHJOQHYCVGNLVVUDXUCKQ"; 

    $vnp_TxnRef = $code_cart; 
    $vnp_OrderInfo = 'Test VN Pay';
    $vnp_OrderType = 'billpayment';
    $vnp_Amount = $cartValue * 100;
    $vnp_Locale = 'vn';
    $vnp_BankCode = 'NCB';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    }
    
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array('code' => '00', 'message' => 'success', 'data' => $vnp_Url);

    

    // Tạo và lưu vé vào cơ sở dữ liệu
    $ve = new Ve();
    $ve->user_id = Auth::id(); 
    $ve->suatchieu_id = $request->suatchieu_id; 
    $ve->ngayban = now();
    $ve->tenghe = $request->tenghe; 
    $ve->soluong = $request->soluong; 
    $ve->giave = $request->giave; 

    // Kiểm tra xem các giá trị từ request có hợp lệ không
    if ($ve->suatchieu_id && $ve->tenghe && $ve->soluong && $ve->giave) {
        try {
            $ve->save();
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra, trả về một phản hồi JSON với thông báo lỗi
            return response()->json(['error' => 'Không thể lưu vé vào cơ sở dữ liệu: ' . $e->getMessage()], 500);
        }

        $barcode = new DNS1D();
        $barcodeData = strval($ve->id); 
        $barcodeFilename = $ve->id . '.png'; 

        // Lưu mã vạch vào thư mục qrcodes
        $barcode->setStorPath(public_path('qrcodes')); 
        $barcode->getBarcodePNGPath($barcodeData, 'C128', 3, 33, array(1,1,1), true); 
        $ve->qrcode = 'qrcodes/' . $barcodeFilename; 
        $ve->save();

        session(['qrCodeFileName' => 'qrcodes/' . $barcodeFilename]);

        // Redirect đến trang "datvethanhcong"
        // return redirect()->route('booking.datvethanhcong');
    } else {
        // Xử lý lỗi khi dữ liệu không hợp lệ
        return response()->json(['error' => 'Dữ liệu không hợp lệ'], 400);
    }
    
    if (isset($_POST['redirect'])) {
        header('Location: ' . $vnp_Url);
        exit(); // Thêm exit() để dừng thực thi ngay sau khi chuyển hướng
    }
}


    
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
