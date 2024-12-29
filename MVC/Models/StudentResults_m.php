<?php
class StudentResults_m extends connectDB
{
    public function get_student_results($id)
    {
        $sql = "SELECT * FROM ketquahoctap a
        join monhoc b on b.MaMon=a.MaMon
         WHERE a.MaSoSV LIKE '%$id%'";
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
                    WHEN SUM(h.SoTienDaThanhToan) >= SUM(h.SoTien) THEN 'Đã Thanh Toán'
                    ELSE 'Chưa Thanh Toán'
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
