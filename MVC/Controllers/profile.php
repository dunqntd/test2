<?php
class profile extends Controller
{
    private $profile;

    public function __construct()
    {
        $this->profile = $this->model('profile_m');
    }

    public function Get_data()
    {

        $student = isset($_SESSION['student']) ? $_SESSION['student'] : null;

        $maSoSV = $student['MaSoSV'];
        $studentInfo = $this->profile->getStudentInfo($maSoSV);

        // Truyền dữ liệu vào view
        $this->view('Masterlayout_student', [
            'page' => 'profile_v',
            'studentInfo' => $studentInfo,

        ]);
    }
    public function UploadAvatar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
            $student = isset($_SESSION['student']) ? $_SESSION['student'] : null;
            $maSoSV = $student['MaSoSV'];

            $fileTmpPath = $_FILES['avatar']['tmp_name'];
            $fileName = $_FILES['avatar']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $allowedFileExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($fileExtension, $allowedFileExtensions)) {
                $newFileName = uniqid('avatar_', true) . '.' . $fileExtension;
                $uploadFileDir = 'D:/xampp/htdocs/project_quanlisinhvien/Public/uploads/'; // Đảm bảo sử dụng đường dẫn đúng
                $dest_path = $uploadFileDir . $newFileName;


                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $this->profile->updateAvatar($maSoSV, $newFileName);
                    $_SESSION['message'] = 'Cập nhật ảnh đại diện thành công!';
                    header('Location: http://websinhvien.local/profile');
                    exit;
                } else {
                    $_SESSION['error'] = 'Không thể tải ảnh lên.';
                }
            } else {
                $_SESSION['error'] = 'Định dạng file không hợp lệ.';
            }
            header('Location: http://websinhvien.local/profile');
        }
    }
}
