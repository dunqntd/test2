<?php
class manage_Tuition extends Controller
{
    private $tuitionModel;

    public function __construct()
    {
        $this->tuitionModel = $this->model('manage_Tuition_m');  // Sử dụng model
    }


    public function Get_data()
    {

        $tuitionData = $this->tuitionModel->getTuitionInformation();

        // Kiểm tra nếu dữ liệu không trống
        if (!$tuitionData) {
            $_SESSION['message'] = "Không có thông tin học phí!";
        }

        // Gửi dữ liệu học phí tới view
        $this->view('Masterlayout', [
            'page' => 'Tuition_Management_v',
            'tuitionData' => $tuitionData, // Truyền dữ liệu học phí vào view
        ]);
    }
    public function view_createTuition()
    {
        $this->view('Masterlayout', [
            'page' => 'create_tuition_v',

        ]);
    }
    public function insert_Tuition()
    {
        $HocKy = $_POST['HocKy'];
        $NamHoc = $_POST['NamHoc'];
        $GiaHocPhiMoiTinChi = $_POST['GiaHocPhiMoiTinChi'];
        $result = $this->tuitionModel->insert_Tuition($HocKy, $NamHoc, $GiaHocPhiMoiTinChi);
        if ($result) {
            echo '<script>alert("Thêm mới thành công!");</script>';
        } else {
            echo '<script>alert("Thêm thất bại!");</script>';
        }

        header("Location: http://localhost/project_quanlisinhvien/manage_tuition/");
        exit;
    }


    public function update_Tuition()
    {
        // Kiểm tra dữ liệu từ form
        $HocKy = $_POST['HocKy'];
        $NamHoc = $_POST['NamHoc'];
        $GiaHocPhiMoiTinChi = $_POST['GiaHocPhiMoiTinChi'];

        // Kiểm tra dữ liệu nhập vào


        // Gọi phương thức model để cập nhật học phí
        $message = $this->tuitionModel->updateTuition($HocKy, $NamHoc, $GiaHocPhiMoiTinChi);



        // Chuyển hướng lại trang tạo học phí
        header("Location: http://localhost/project_quanlisinhvien/manage_tuition/");
        exit;
    }

    // Xóa học phí
    public function delete_Tuition($HocKy, $NamHoc)
    {
        // Gọi phương thức model để xóa học phí
        $message = $this->tuitionModel->deleteTuition($HocKy, $NamHoc);

        // Lưu thông báo vào session
        $_SESSION['message'] = $message;

        // Chuyển hướng lại trang danh sách học phí
        header("Location: http://localhost/project_quanlisinhvien/manage_tuition/");
        exit;
    }
}
