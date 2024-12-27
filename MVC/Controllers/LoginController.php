<?php
class LoginController extends Controller
{
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = $this->model('Login_m');
    }

    public function Get_data()
    {
        $this->view('Login_v');
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->loginModel->checkLogin($email, $password);

            if ($user) {
                $_SESSION['user'] = $user;

                // Phân quyền
                if ($user['role'] == 0) {
                    // Admin
                    header('Location: http://localhost/project_quanlisinhvien/admin_dashboard');
                } elseif ($user['role'] == 1) {
                    // Sinh viên
                    $student = $this->loginModel->getStudentByEmail($email);

                    if ($student) {
                        $_SESSION['student'] = $student;
                        header('Location: http://localhost/project_quanlisinhvien/Home/student_dashboard');
                    } else {
                        $error = "Không tìm thấy thông tin sinh viên!";
                        $this->view('Login_v', ['error' => $error]);
                    }
                } else {
                    $error = "Vai trò không hợp lệ!";
                    $this->view('Login_v', ['error' => $error]);
                }
            } else {
                $error = "Email hoặc mật khẩu không chính xác!";
                $this->view('Login_v', ['error' => $error]);
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: http://localhost/project_quanlisinhvien/LoginController');
    }
}
