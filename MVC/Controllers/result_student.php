
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

        public function view_enter_score()
        {
            $students = $this->rs->get_student_infor();  // Lấy danh sách sinh viên
            $courses = []; // Ban đầu không có môn học, sẽ lấy sau khi chọn sinh viên

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
                // Kiểm tra xem student_id có được gửi hay không
                if (!isset($_POST['student_id']) || empty($_POST['student_id'])) {
                    header('Content-Type: application/json');
                    echo json_encode(['error' => 'student_id không được gửi hoặc rỗng']);
                    exit;
                }

                $student_id = $_POST['student_id'];

                // Gọi model để lấy danh sách môn học
                $courses = $this->rs->get_registered_courses($student_id);

                // Kiểm tra kết quả từ model
                if (!empty($courses)) {
                    header('Content-Type: application/json');
                    echo json_encode($courses);
                } else {
                    header('Content-Type: application/json');
                    echo json_encode([]);
                }
                exit;
            }

            // Trường hợp request không hợp lệ
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
                $namHoc = $_POST['NamHoc'];


                // Gọi model để lưu kết quả
                $result = $this->rs->insert_student_result($maSoSV, $maMon, $diem, $hocKy, $namHoc);

                if ($result) {
                    echo '<script>alert("Thêm kết quả học tập thành công!");</script>';
                } else {
                    echo '<script>alert("Thêm kết quả học tập thất bại!");</script>';
                }

                // Quay lại trang nhập kết quả
                echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/result_student/view_result/' . $maSoSV . '";</script>';
            }
        }



        function view_result($id)
        {

            $studentInfo = $this->rs->get_student_by_id($id);

            // Kiểm tra nếu sinh viên không tồn tại
            if (!$studentInfo) {
                echo "Không tìm thấy thông tin sinh viên.";
                return;
            }

            // Lấy kết quả học tập của sinh viên
            $studentResults = $this->rs->get_student_results($id);

            // Gửi dữ liệu tới View
            $this->view('Masterlayout', [
                'page' => 'view_result_student_v',
                'student_results' => $studentResults,
                'student_info' => $studentInfo
            ]);
        }
    }
