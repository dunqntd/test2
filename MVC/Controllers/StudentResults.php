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
        $results = $this->resultsModel->get_student_results($studentId);
        $resultsArray = [];
        while ($row = mysqli_fetch_assoc($results)) {
            $resultsArray[] = $row;
        }

        // Tính điểm trung bình
        $totalScore = 0;
        $totalCredits = 0;
        foreach ($resultsArray as $result) {
            $totalScore += $result['Diem'] * $result['SoTinChi'];
            $totalCredits += $result['SoTinChi'];
        }

        $averageScore = $totalCredits > 0 ? $totalScore / $totalCredits : 0;

        // Hiển thị kết quả trong view
        $this->view('Masterlayout_student', [
            'page' => 'student_results_v',
            'results' => $results,
            'average_score' => number_format($averageScore, 2)
        ]);
    }
    function view_tuition_fee()
    {
        $student = isset($_SESSION['student']) ? $_SESSION['student'] : null;

        $studentId = $student['MaSoSV'];
        $tuitionSummary = $this->resultsModel->get_tuition_summary_by_student($studentId);
        // Gửi dữ liệu tới View
        $this->view('Masterlayout_student', [
            'page' => 'view_tuition_fee_v',
            'tuition_summary' => $tuitionSummary,
        ]);
    }
}
