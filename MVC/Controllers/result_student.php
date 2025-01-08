<?php
class result_student extends Controller
{
    private $rs;

    public function __construct()
    {
        $this->rs = $this->model('result_student_m');
    }

    // Lấy danh sách sinh viên
    function Get_data()
    {
        $danhSachSinhVien = $this->rs->get_student_infor();
        $this->view('Masterlayout', [
            'page' => 'select_student_v',
            'danhsachsinhvien' => $danhSachSinhVien
        ]);
    }

    public function timkiem()
    {
        if (isset($_POST['btnTimkiem'])) {
            $masv = $_POST['txtMasv'];
            $name = $_POST['txtname'];
            $dl = $this->rs->ketqua_find($masv, $name);

            $this->view('Masterlayout', [
                'page' => 'select_student_v',
                'danhsachsinhvien' => $dl,
                'Masv' => $masv,
                'name' => $name
            ]);
            exit;
        }
    }

    public function view_enter_score()
    {
        $students = $this->rs->get_student_infor();  // Lấy danh sách sinh viên
        $courses = []; // Danh sách môn học sẽ được lấy sau khi chọn sinh viên và học kỳ

        $this->view('Masterlayout', [
            'page' => 'enter_score_v',
            'students' => $students,
            'courses' => $courses
        ]);
    }

    // Lấy danh sách môn học đã đăng ký của sinh viên
    public function get_registered_courses()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $student_id = $_POST['student_id'];
            $semester = $_POST['semester'];

            // Gọi model để lấy danh sách môn học đã đăng ký
            $courses = $this->rs->get_registered_courses($student_id, $semester);

            header('Content-Type: application/json');
            echo json_encode($courses);
            exit;
        }

        header('Content-Type: application/json');
        echo json_encode(['error' => 'Yêu cầu không hợp lệ']);
        exit;
    }


    public function save_result()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maSoSV = $_POST['student_id'];
            $maMon = $_POST['courses_id'];
            $diem = $_POST['Diem'];
            $hocKy = $_POST['HocKy'];

            // Lấy năm học từ môn học đã đăng ký
            $namHoc = $this->rs->get_academic_year_by_course($maSoSV, $maMon);

            // Gọi model để lưu kết quả
            $result = $this->rs->insert_student_result($maSoSV, $maMon, $diem, $hocKy, $namHoc);

            if ($result) {
                echo '<script>alert("Thêm kết quả học tập thành công!");</script>';
            } else {
                echo '<script>alert("Thêm kết quả học tập thất bại!");</script>';
            }

            // Quay lại trang nhập kết quả
            echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/result_student/view_enter_score";</script>';
        }
    }
    function uploadfile()
    {
        if (isset($_POST['btnUpload'])) {
            try {
                $file = $_FILES['txtFile']['tmp_name'];
                $objReader = PHPExcel_IOFactory::createReaderForFile($file);
                $objExcel = $objReader->load($file);
                $sheet = $objExcel->getSheet(0);
                $sheetData = $sheet->toArray(null, true, true, true);

                for ($i = 2; $i <= count($sheetData); $i++) {
                    $maSoSV = $sheetData[$i]["A"];
                    $maMon = $sheetData[$i]["B"];
                    $diem = $sheetData[$i]["E"];
                    $hocKy = $sheetData[$i]["C"];
                    $namHoc = $sheetData[$i]["D"];

                    // Kiểm tra dữ liệu hợp lệ
                    if (empty($maSoSV) || empty($maMon) || !is_numeric($diem) || empty($hocKy) || empty($namHoc)) {
                        echo "<script>alert('Dữ liệu dòng $i trong file Excel không hợp lệ. Vui lòng kiểm tra lại!');</script>";
                        continue;
                    }

                    // Kiểm tra môn học có hợp lệ không
                    $registeredCourses = $this->rs->get_registered_courses($maSoSV, $hocKy);
                    $isValidCourse = false;

                    foreach ($registeredCourses as $course) {
                        if ($course['MaMon'] === $maMon) {
                            $isValidCourse = true;
                            break;
                        }
                    }

                    if (!$isValidCourse) {
                        error_log("Môn học $maMon không hợp lệ cho sinh viên $maSoSV trong học kỳ $hocKy.");
                        echo "<script>alert('Môn học \"$maMon\" không hợp lệ cho sinh viên \"$maSoSV\".');</script>";
                        continue;
                    }

                    // Lưu điểm
                    $kq = $this->rs->insert_student_result($maSoSV, $maMon, $diem, $hocKy, $namHoc);
                    if (!$kq) {
                        echo "<script>alert('Lỗi khi lưu điểm cho sinh viên \"$maSoSV\", môn \"$maMon\".');</script>";
                    } else {
                        echo "<script>alert('Thêm kết quả thành công!')</script>";
                    }
                }
            } catch (Exception $e) {
                echo "<script>alert('Lỗi xử lý file Excel: {$e->getMessage()}');</script>";
            }

            $danhSachSinhVien = $this->rs->get_student_infor();
            $this->view('Masterlayout', [
                'page' => 'select_student_v',
                'danhsachsinhvien' => $danhSachSinhVien
            ]);
            exit;
        }
    }



    public function view_result($id)
    {
        // Lấy thông tin sinh viên
        $studentInfo = $this->rs->get_student_by_id($id);

        // Kiểm tra xem sinh viên có tồn tại không
        if (!$studentInfo) {
            echo "Không tìm thấy thông tin sinh viên.";
            return;
        }

        // Kiểm tra xem học kỳ và năm học có được gửi không
        $hocKy = isset($_POST['HocKy']) ? $_POST['HocKy'] : null;
        $namHoc = isset($_POST['NamHoc']) ? $_POST['NamHoc'] : null;




        $studentResults = $this->rs->get_student_results_by_semester_year($id, $hocKy, $namHoc);

        // Chuyển kết quả thành mảng
        $resultsArray = [];
        while ($row = mysqli_fetch_assoc($studentResults)) {
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

        // Trả về view với dữ liệu cần thiết
        $this->view('Masterlayout', [
            'page' => 'view_result_student_v',
            'student_results' => $resultsArray,
            'student_info' => $studentInfo,
            'average_score' => number_format($averageScore, 2)
        ]);
    }
}
