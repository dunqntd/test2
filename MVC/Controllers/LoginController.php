<?php
class LoginController extends Controller
{
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = $this->model('Login_m');
    }

    function Get_data()
    {
        $this->view('Login_v');
    }

    public function authenticate()
    {
        // Kiểm tra xem người dùng đã nhập thông tin chưa
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu người dùng
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Kiểm tra thông tin đăng nhập
            $user = $this->loginModel->checkLogin($email, $password);

            if ($user) {
                // Đăng nhập thành công
                $_SESSION['user'] = $user;

                // Phân quyền theo role
                if ($user['role'] == 0) {
                    // Quản trị viên
                    header('Location: http://localhost/project_quanlisinhvien/admin_dashboard');
                } elseif ($user['role'] == 1) {
                    // Sinh viên
                    header('Location: http://localhost/project_quanlisinhvien/Home/student_dashboard');
                } else {
                    // Vai trò không hợp lệ
                    $error = "Tài khoản có vai trò không hợp lệ!";
                    $this->view('login_v', ['error' => $error]);
                }
            } else {
                // Đăng nhập thất bại, hiển thị thông báo lỗi
                $error = "Email hoặc mật khẩu không chính xác!";

                $this->view('login_v', ['error' => $error]);
            }
        }
    }

    public function logout()
    {
        // Xóa session và chuyển hướng về trang đăng nhập
        session_destroy();
        header('Location: http://localhost/project_quanlisinhvien/LoginController');
    }
}
