<?php
class student_registration extends Controller
{
    private $registrationModel;

    public function __construct()
    {
        $this->registrationModel = $this->model('student_registration_m');
    }

    public function Get_data()
    {
        // Lấy danh sách các khóa học
        $courses = $this->registrationModel->getAllCourses();

        // Kiểm tra xem sinh viên đã đăng nhập chưa
        $student = isset($_SESSION['student']) ? $_SESSION['student'] : null;

        // Nếu sinh viên chưa đăng nhập, thông báo và chuyển hướng về trang đăng nhập
        if (!$student) {
            echo '<script>alert("Vui lòng đăng nhập trước khi đăng ký môn học!");</script>';
            echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/login";</script>';
            return;
        }

        // Truyền thông tin sinh viên và danh sách môn học vào view
        $this->view('Masterlayout_student', [
            'page' => 'student_courses_registration_v',
            'courses' => $courses,
            'student' => $student, // Truyền thông tin sinh viên vào view
        ]);
    }

    public function registerCoursesForStudent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra xem sinh viên đã đăng nhập chưa
            $student = isset($_SESSION['student']) ? $_SESSION['student'] : null;

            if (!$student) {
                echo '<script>alert("Vui lòng đăng nhập trước khi đăng ký môn học!");</script>';
                echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/login";</script>';
                return;
            }

            $studentId = $student['MaSoSV']; // Lấy mã sinh viên từ session
            $semester = $_POST['semester'];
            $academicYear = $_POST['academic_year'];
            $courses = isset($_POST['courses']) ? $_POST['courses'] : [];

            // Kiểm tra xem sinh viên đã chọn môn học chưa
            if (empty($courses)) {
                echo '<script>alert("Vui lòng chọn ít nhất một môn học!");</script>';
                return;
            }

            // Thực hiện đăng ký môn học
            $registrationResult = $this->registrationModel->registerCourses($studentId, $semester, $academicYear, $courses);

            if ($registrationResult) {
                echo '<script>alert("Đăng ký môn học thành công!");</script>';
                echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/student_registration";</script>';
            } else {
                echo '<script>alert("Đã có lỗi xảy ra trong quá trình đăng ký. Vui lòng thử lại.");</script>';
            }
        }
    }
}
