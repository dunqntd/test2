<?php
class payment_tuition  extends Controller
{
    private $payment_tuition;

    public function __construct()
    {
        $this->payment_tuition = $this->model('payment_tuition_m');  // Sử dụng model
    }

    // Lấy dữ liệu học phí
    function Get_data()
    {
        $tuitionInfo = $this->payment_tuition->getTuitionInfo();
        $this->view('Masterlayout', [
            'page' => 'tuition_information_v',
            'danhsachhocphi' => $tuitionInfo
        ]);
    }


    // Xử lý thanh toán học phí
    public function submitPayment()
    {
        // Kiểm tra nếu các thông tin cần thiết đã được gửi
        if (isset($_POST['MaSoSV']) && isset($_POST['HocKy']) && isset($_POST['NamHoc']) && isset($_POST['SoTienThanhToan'])) {
            $MaSoSV = $_POST['MaSoSV'];
            $HocKy = $_POST['HocKy'];
            $NamHoc = $_POST['NamHoc'];
            $SoTienThanhToan = $_POST['SoTienThanhToan'];

            // Gọi phương thức thanh toán trong model
            $this->payment_tuition->submitPayment($MaSoSV, $HocKy, $NamHoc, $SoTienThanhToan);


            header("Location: http://websinhvien.local/payment_tuition/");
            exit;
        }
    }
}
