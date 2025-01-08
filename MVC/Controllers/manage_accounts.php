<?php
class manage_accounts extends Controller
{
    private $manage_accounts;

    public function __construct()
    {
        $this->manage_accounts = $this->model('manage_accounts_m');
    }

    public function Get_data()
    {
        $accounts = $this->manage_accounts->get_all_accounts();

        $this->view('Masterlayout', [
            'page' => 'manage_accounts_v',
            'accounts' => $accounts,
        ]);
    }
    public function timkiem()
    {
        if (isset($_POST['btnTimkiem'])) {
            $email = $_POST['txtemail'];

            $name = $_POST['txtname'];
            $accounts = $this->manage_accounts->timkiem_find($email, $name);

            // Gọi lại giao diện và truyền $dl ra
            $this->view('Masterlayout', [
                'page' => 'manage_accounts_v',
                'accounts' => $accounts,
                'email' => $email,

                'name' => $name
            ]);
            exit;
        }
        if (isset($_POST['btndkmon'])) {
        }
    }
    public function update_account()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $name = $_POST['name'];

            $updateResult = $this->manage_accounts->update_account($id, $email, $password, $role, $name);

            if ($updateResult) {
                echo '<script>alert("Cập nhật thành công!");</script>';
                echo '<script>window.location.href = "Get_data";</script>';
            } else {
                echo '<script>alert("Cập nhật thất bại!");</script>';
            }
        }
    }
    public function delete($accountId)
    {
        // Gọi model để xóa tài khoản
        $deleteResult = $this->manage_accounts->deleteAccount($accountId);

        // Kiểm tra kết quả và điều hướng
        if ($deleteResult) {
            echo '<script>alert("Xóa tài khoản thành công!");</script>';
        } else {
            echo '<script>alert("Không thể xóa tài khoản! Vui lòng thử lại.");</script>';
        }
        echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/manage_accounts/Get_data";</script>';
        exit;
    }
    public function view_addAccount()
    {
        $this->view('Masterlayout', [
            'page' => 'addAccount_v',

        ]);
    }
    public function addAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $role = $_POST['role'];

            // Gọi model để thêm tài khoản
            $insertResult = $this->manage_accounts->addAccount($email, $password, $name, $role);

            if ($insertResult) {
                echo '<script>alert("Thêm tài khoản thành công!");</script>';
            } else {
                echo '<script>alert("Thêm tài khoản thất bại. Vui lòng thử lại.");</script>';
            }

            echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/manage_accounts/Get_data";</script>';
            exit;
        }
    }
}
