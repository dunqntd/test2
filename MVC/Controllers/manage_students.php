<?php
// Controller: manage_students.php

class Manage_students extends Controller
{
    private $manage_student_model;

    public function __construct()
    {
        $this->manage_student_model = $this->model('manage_student_m');
    }

    public function Get_data()
    {
        $danhSachSinhVien = $this->manage_student_model->get_student_infor();

        $this->view('Masterlayout', [
            'page' => 'manage_students_v',
            'danhsachsinhvien' => $danhSachSinhVien
        ]);
    }

    public function addstudent()
    {

        $this->view('Masterlayout', [
            'page' => 'add_student_v',

        ]);
    }

    public function timkiem()
    {
        if (isset($_POST['btnTimkiem'])) {
            $masv = $_POST['txtMasv'];

            $name = $_POST['txtname'];
            $dl = $this->manage_student_model->sinhvien_find($masv, $name);

            // Gọi lại giao diện và truyền $dl ra
            $this->view('Masterlayout', [
                'page' => 'manage_students_v',
                'danhsachsinhvien' => $dl,
                'Masv' => $masv,

                'name' => $name
            ]);
            exit;
        }
        if (isset($_POST['btnXuatExcel'])) {
            // Load PHPExcel library (adjust path as necessary)


            // Create new PHPExcel object
            $objExcel = new PHPExcel();
            $objExcel->setActiveSheetIndex(0);
            $sheet = $objExcel->getActiveSheet()->setTitle('DSnhap');
            $rowCount = 1;

            // Set column headers
            $sheet->setCellValue('A' . $rowCount, 'STT');
            $sheet->setCellValue('B' . $rowCount, 'Mã Học Sinh');
            $sheet->setCellValue('C' . $rowCount, 'Họ Và Tên');
            $sheet->setCellValue('D' . $rowCount, 'Ngày Sinh');
            $sheet->setCellValue('E' . $rowCount, 'Quê Quán');
            $sheet->setCellValue('F' . $rowCount, 'Điện Thoại');
            $sheet->setCellValue('G' . $rowCount, 'Email');
            $sheet->setCellValue('H' . $rowCount, 'Giới Tính');

            // Auto-size columns (not directly supported, set width manually if needed)
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);
            $sheet->getColumnDimension('H')->setAutoSize(true);

            // Set fill color for header row
            $sheet->getStyle('A1:H1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');

            // Center-align header row
            $sheet->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $masv = $_POST['txtMasv'];

            $name = $_POST['txtname'];
            $data = $this->manage_student_model->sinhvien_find($masv, $name);
            // Iterate through data and fill spreadsheet
            $i = 1;
            while ($row = mysqli_fetch_array($data)) {
                $rowCount++;
                $sheet->setCellValue('A' . $rowCount, $i++);
                $sheet->setCellValue('B' . $rowCount, $row['MaSoSV']);
                $sheet->setCellValue('C' . $rowCount, $row['HoTen']);
                $sheet->setCellValue('D' . $rowCount, $row['NgaySinh']);
                $sheet->setCellValue('E' . $rowCount, $row['QueQuan']);
                $sheet->setCellValue('F' . $rowCount, $row['SoDienThoai']);
                $sheet->setCellValue('G' . $rowCount, $row['Email']);
                $sheet->setCellValue('H' . $rowCount, $row['GioiTinh']);
            }

            // Set borders for the entire table
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $sheet->getStyle('A1:I' . $rowCount)->applyFromArray($styleArray);

            // Save Excel 2007 file
            $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
            $fileName = 'DSsinhvienExport.xlsx';
            $objWriter->save($fileName);

            // Download file
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Length: ' . filesize($fileName));
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: no-cache');
            readfile($fileName);
            exit;
        }
    }

    public function themmoi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnthem'])) {
            // Lấy dữ liệu từ form
            $masv = $_POST['student_id'];
            $ht = $_POST['name'];
            $ns = $_POST['dob'];
            $dc = $_POST['address'];
            $dt = $_POST['phone'];
            $email = $_POST['email'];
            $gt = $_POST['gender'];
            $password = $_POST['password'];



            // Gọi hàm thêm mới sinh viên
            $insertResult = $this->manage_student_model->sinhvien_ins($masv, $ht, $ns, $dc, $dt, $email, $gt, $password);

            // Kiểm tra kết quả trả về
            if ($insertResult === true) {
                echo '<script>alert("Thêm mới thành công!");</script>';
                echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/manage_students/Get_data";</script>';
                exit;
            } else {
                // Hiển thị lỗi và giữ lại dữ liệu người dùng
                $this->view('Masterlayout', [
                    'page' => 'add_student_v',
                    'oldData' => [
                        'student_id' => $masv,
                        'name' => $ht,
                        'dob' => $ns,
                        'address' => $dc,
                        'phone' => $dt,
                        'email' => $email,
                        'gender' => $gt,
                    ],
                ]);
                exit;
            }
        }
    }

    function uploadfile()
    {
        if (isset($_POST['btnUpload'])) {
            $file = $_FILES['txtFile']['tmp_name'];
            $objReader = PHPExcel_IOFactory::createReaderForFile($file);
            $objExcel = $objReader->load($file);
            //Lấy sheet hiện tại
            $sheet = $objExcel->getSheet(0);
            $sheetData = $sheet->toArray(null, true, true, true);
            for ($i = 2; $i <= count($sheetData); $i++) {
                $masv = $sheetData[$i]["A"];
                $ht = $sheetData[$i]["B"];
                $ns = $sheetData[$i]["C"];
                $dc = $sheetData[$i]["D"];
                $dt = $sheetData[$i]["E"];
                $email = $sheetData[$i]["F"];
                $gt = $sheetData[$i]["G"];
                $password = $sheetData[$i]["H"];


                $kq = $this->manage_student_model->sinhvien_ins($masv, $ht, $ns, $dc, $dt, $email, $gt, $password);
            }
            echo "<script>alert('Thêm mới thành công!')</script>";
            $danhSachSinhVien = $this->manage_student_model->get_student_infor();

            $this->view('Masterlayout', [
                'page' => 'manage_students_v',
                'danhsachsinhvien' => $danhSachSinhVien
            ]);
            exit;
        }
    }

    public function edit_student()
    {
        $masv = $_POST['studentId'];
        $ht = $_POST['name'];
        $ns = $_POST['dob'];
        $dc = $_POST['address'];
        $dt = $_POST['phone'];
        $email = $_POST['email'];
        $gt = $_POST['gender'];
        $insertResult = $this->manage_student_model->sinhvien_upd($masv, $ht, $ns, $dc, $dt, $email, $gt);
        if ($insertResult) {
            echo '<script>alert("Sửa thành công")</script>';
        } else {
            echo '<script>alert("Sửa thất bại")</script>';
        }
        echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/manage_students/Get_data";</script>';
        exit;
    }
    public function delete_student($masv)
    {
        $result = $this->manage_student_model->sinhvien_del($masv);
        if ($result) {
            echo '<script>alert("Xóa thành công")</script>';
        } else {
            echo '<script>alert("Xóa thất bại")</script>';
        }
        echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/manage_students/Get_data";</script>';
        exit;
    }
}
