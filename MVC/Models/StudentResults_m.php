<?php
class StudentResults_m extends connectDB
{
    public function get_student_results_by_semester_and_year($studentId, $hocKy, $namHoc)
    {
        // Xây dựng câu truy vấn với các điều kiện lọc
        $sql = "SELECT * FROM ketquahoctap 
            JOIN monhoc ON monhoc.MaMon = ketquahoctap.MaMon
            WHERE ketquahoctap.MaSoSV = '$studentId'";

        // Thêm điều kiện cho học kỳ và năm học nếu có
        if ($hocKy) {
            $sql .= " AND ketquahoctap.HocKy = '$hocKy'";
        }
        if ($namHoc) {
            $sql .= " AND ketquahoctap.NamHoc = '$namHoc'";
        }

        $result = mysqli_query($this->con, $sql);
        return $result;
    }


    public function get_tuition_summary_by_student($student_id)
    {
        $sql = "SELECT 
                h.MaSoSV,
                SUM(m.SoTinChi) AS TongSoTinChi,
                SUM(h.SoTien) AS TongHocPhi,
                SUM(h.SoTienDaThanhToan) AS TongTienDaNop,
                h.HocKy,
                h.NamHoc,
                CASE 
                     WHEN SUM(CASE WHEN h.TrangThai = 'Chua thanh toan' THEN 1 ELSE 0 END) > 0 THEN 'Chua thanh toan'
                WHEN SUM(CASE WHEN h.SoTienDaThanhToan < h.SoTien THEN 1 ELSE 0 END) > 0 THEN 'Mot phan thanh toan'
                ELSE 'Da thanh toan'
                END AS TrangThai
            FROM hocphi h
            JOIN monhoc m ON h.MaMon = m.MaMon
            WHERE h.MaSoSV = ?
            GROUP BY h.HocKy, h.NamHoc";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
}
