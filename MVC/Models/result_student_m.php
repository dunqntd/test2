<?php
class result_student_m extends connectDB
{
    public function get_student_infor()
    {
        $sql = "SELECT * FROM sinhvien";
        $result = mysqli_query($this->con, $sql);


        return $result; // Trả về tất cả kết quả dưới dạng mảng
    }
    public function get_student_by_id($id)
    {
        $sql = "SELECT * FROM sinhvien WHERE MaSoSV LIKE '%$id%'";
        $result = mysqli_query($this->con, $sql);


        return $result; // Trả về tất cả kết quả dưới dạng mảng
    }

    public function get_student_results($id)
    {
        $sql = "SELECT * FROM ketquahoctap a
        join monhoc b on b.MaMon=a.MaMon
         WHERE a.MaSoSV LIKE '%$id%'";
        $result = mysqli_query($this->con, $sql);


        return $result;
    }
    public function get_registered_courses($student_id)
    {
        $sql = "SELECT m.MaMon, m.TenMon, m.SoTinChi 
                FROM monhoc m
                JOIN dangkymonhoc dk ON dk.MaMon = m.MaMon
                LEFT JOIN ketquahoctap kq ON kq.MaMon = m.MaMon AND kq.MaSoSV = dk.MaSoSV
                WHERE dk.MaSoSV = '$student_id' AND kq.MaMon IS NULL";

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



    public function insert_student_result($student_id, $course_id, $score, $semester, $academic_year)
    {
        // Xác định trạng thái tự động
        $status = $score >= 5 ? 'Đạt' : 'Không đạt';

        // Thêm trạng thái vào cơ sở dữ liệu
        $sql = "INSERT INTO ketquahoctap (MaSoSV, MaMon, Diem, HocKy, NamHoc, TrangThai) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssdiss", $student_id, $course_id, $score, $semester, $academic_year, $status);
        return $stmt->execute();  // Trả về true nếu lưu thành công
    }
}
