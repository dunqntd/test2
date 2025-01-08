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

        $this->view('Masterlayout_student', [
            'page' => 'student_results_v',

        ]);
        exit;
    }
    public function view_result()
    {
        // Kiểm tra xem sinh viên đã đăng nhập chưa
        $student = isset($_SESSION['student']) ? $_SESSION['student'] : null;


        // Lấy mã sinh viên từ session
        $studentId = $student['MaSoSV'];

        // Kiểm tra xem có chọn học kỳ và năm học hay không
        if (isset($_POST['HocKy']) && isset($_POST['NamHoc'])) {
            $hocKy = $_POST['HocKy'];
            $namHoc = $_POST['NamHoc'];

            // Lấy kết quả học tập của sinh viên theo học kỳ và năm học
            $results = $this->resultsModel->get_student_results_by_semester_and_year($studentId, $hocKy, $namHoc);
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

            // Trả kết quả về view
            $this->view('Masterlayout_student', [
                'page' => 'student_results_v',
                'results' => $resultsArray,
                'average_score' => number_format($averageScore, 2)
            ]);
        }
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
