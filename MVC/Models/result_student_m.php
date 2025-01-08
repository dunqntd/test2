<?php
class result_student_m extends connectDB
{
    // Lấy thông tin sinh viên
    public function get_student_infor()
    {
        $sql = "SELECT * FROM sinhvien";
        $result = mysqli_query($this->con, $sql);

        return $result;
    }

    // Tìm kiếm sinh viên theo mã số và tên
    public function ketqua_find($masv, $name)
    {
        $sql = "SELECT * FROM sinhvien WHERE MaSoSV LIKE '%$masv%' AND HoTen LIKE '%$name%'";
        $result = mysqli_query($this->con, $sql);

        return $result;
    }

    // Lấy thông tin sinh viên theo ID
    public function get_student_by_id($id)
    {
        $sql = "SELECT * FROM sinhvien WHERE MaSoSV = '$id'";
        $result = mysqli_query($this->con, $sql);

        return $result;
    }

    public function get_student_results_by_semester_year($id, $hocKy, $namHoc)
    {
        $sql = "SELECT * FROM ketquahoctap a
            JOIN monhoc b ON b.MaMon = a.MaMon
            WHERE a.MaSoSV = '$id' AND a.HocKy = '$hocKy' AND a.NamHoc = '$namHoc'";

        $result = mysqli_query($this->con, $sql);

        return $result; // Trả về kết quả
    }


    // Lấy danh sách môn học mà sinh viên đã đăng ký (theo học kỳ và năm học)
    public function get_registered_courses($student_id, $semester)
    {
        $sql = "SELECT m.MaMon, m.TenMon, m.SoTinChi 
                FROM monhoc m
                JOIN dangkymonhoc dk ON dk.MaMon = m.MaMon
                LEFT JOIN ketquahoctap kq ON kq.MaMon = m.MaMon AND kq.MaSoSV = dk.MaSoSV
                WHERE dk.MaSoSV = '$student_id' AND dk.HocKy = '$semester' AND kq.MaMon IS NULL";

        $result = mysqli_query($this->con, $sql);

        if ($result) {
            $courses = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $courses[] = $row;
            }
            return $courses;
        }
        return [];
    }
    public function get_academic_year_by_course($id, $course_id)
    {

        $sql = "SELECT NamHoc FROM dangkymonhoc WHERE MaMon = '$course_id'AND MaSoSV='$id'";
        $result = mysqli_query($this->con, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['NamHoc']; // Trả về năm học của môn học
        }
        return null;
    }


    // Lưu kết quả học tập của sinh viên
    public function insert_student_result($student_id, $course_id, $score, $semester, $academic_year)
    {
        // Xác định trạng thái tự động
        $status = $score >= 5 ? 'Đạt' : 'Không đạt';

        // Thêm kết quả vào cơ sở dữ liệu
        $sql = "INSERT INTO ketquahoctap (MaSoSV, MaMon, Diem, HocKy, NamHoc, TrangThai) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssdiss", $student_id, $course_id, $score, $semester, $academic_year, $status);
        return $stmt->execute();  // Trả về true nếu lưu thành công
    }
}
