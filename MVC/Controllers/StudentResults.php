<?php
class StudentResults extends Controller
{
    private $resultsModel;

    public function __construct()
    {
        $this->resultsModel = $this->model('StudentResults_m');
    }

    public function Get_data()
    {


        // Kiểm tra xem sinh viên đã đăng nhập chưa
        $student = isset($_SESSION['student']) ? $_SESSION['student'] : null;
        if (!$student) {
            echo '<script>alert("Vui lòng đăng nhập trước khi xem kết quả học tập!");</script>';
            echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/login";</script>';
            return;
        }

        $studentId = $student['MaSoSV'];
        // Lấy kết quả học tập của sinh viên
        $results = $this->resultsModel->getStudentResults($studentId);

        // Hiển thị kết quả trong view
        $this->view('Masterlayout_student', [
            'page' => 'student_results_v',
            'results' => $results
        ]);
    }
}
