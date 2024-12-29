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

        $courses = $this->registrationModel->getAllCourses();

        // Kiểm tra xem sinh viên đã đăng nhập chưa
        $student = isset($_SESSION['student']) ? $_SESSION['student'] : null;

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
    public function view_registered_courses()
    {
        // Lấy thông tin sinh viên
        $student = isset($_SESSION['student']) ? $_SESSION['student'] : null;
        $studentId = $student['MaSoSV'];
        $studentInfo = $this->registrationModel->get_student_by_id($studentId);

        // Kiểm tra nếu sinh viên không tồn tại
        if (!$studentInfo) {
            echo "Không tìm thấy thông tin sinh viên.";
            return;
        }


        $registeredCourses = $this->registrationModel->get_registered_courses_by_student($studentId);

        // Gửi dữ liệu tới View
        $this->view('Masterlayout_student', [
            'page' => 'view_registered_courses_v',
            'student_info' => $studentInfo,
            'registered_courses' => $registeredCourses
        ]);
    }
}
