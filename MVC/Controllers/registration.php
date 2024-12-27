<?php
class registration extends Controller
{
    private $reg;
    public function __construct()
    {
        $this->reg = $this->model('registration_m');
    }
    public function Get_data()
    {

        $students = $this->reg->getAllStudents();
        $courses = $this->reg->getAllCourses();
        $this->view('Masterlayout', [
            'page' => 'courses_registration_v',
            'students' => $students,
            'courses' => $courses
        ]);
    }


    // Đăng ký môn học cho sinh viên
    public function registerCoursesForStudent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $studentId = $_POST['student_id'];
            $semester = $_POST['semester'];
            $academicYear = $_POST['academic_year'];
            $selectedCourses = $_POST['courses'];

            if (empty($selectedCourses)) {
                echo '<script>alert("Hãy chọn ít nhất một môn học.");</script>';
                return;
            }

            $successCourses = [];
            $failedCourses = [];

            foreach ($selectedCourses as $courseId) {
                $result = $this->reg->registerCourseForStudent($studentId, $courseId, $semester, $academicYear);
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

            echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/registration/Get_data";</script>';
            exit();
        }
    }
    public function viewRegisteredCourses($studentId)
    {
        $registeredCourses = $this->reg->getRegisteredCourses($studentId);

        $this->view('Masterlayout', [
            'page' => 'registered_courses_v',
            'studentId' => $studentId,
            'registeredCourses' => $registeredCourses,
        ]);
    }
    public function updateCourse()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $studentId = $_POST['student_id'];
            $courseId = $_POST['course_id'];
            $semester = $_POST['semester'];
            $academicYear = $_POST['academic_year'];

            // Cập nhật môn học
            $updateResult = $this->reg->updateCourse($courseId, $semester, $academicYear);

            if ($updateResult) {
                echo '<script>alert("Sửa môn học thành công!");</script>';
                echo '<script>alert("Sửa môn học thành công!");</script>';
                echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/registration/viewRegisteredCourses/" + "' . $studentId . '";</script>';
            } else {
                echo '<script>alert("Có lỗi xảy ra khi sửa môn học. Vui lòng thử lại.");</script>';
            }
        }
    }

    // Hàm xóa môn học
    public function deleteCourse($courseId, $studentId)
    {
        // Gọi phương thức xóa trong model
        $result = $this->reg->deleteCourseForStudent($courseId, $studentId);

        if ($result) {
            echo '<script>alert("Xóa môn học thành công!");</script>';
            echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/registration/viewRegisteredCourses/' . $studentId . '";</script>';
        } else {
            echo '<script>alert("Có lỗi xảy ra khi xóa môn học.");</script>';
        }
    }
}
