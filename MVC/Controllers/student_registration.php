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

            $successCourses = [];
            $failedCourses = [];
            foreach ($courses as $courseId) {
                $result = $this->registrationModel->registerCourseForStudent($studentId, $courseId, $semester, $academicYear);
                if ($result) {
                    $successCourses[] = $courseId;
                } else {
                    $failedCourses[] = $courseId;
                }
            }

            // Thông báo kết quả
            if (!empty($successCourses)) {
                echo '<script>alert("Đăng ký thành công các môn học: ' . implode(', ', $successCourses) . '");</script>';
            }

            if (!empty($failedCourses)) {
                echo '<script>alert("Môn học đã đăng ký trước đó: ' . implode(', ', $failedCourses) . '");</script>';
            }


            if ($result) {
                echo '<script>alert("Đăng ký môn học thành công!");</script>';
                echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/student_registration";</script>';
            }
            echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/student_registration";</script>';
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
