<?php
class manage_Tuition_m extends connectDB
{
    // Lấy danh sách học phí
    public function insert_Tuition()
    {
        // Lấy dữ liệu từ form
        $HocKy = $_POST['HocKy'];
        $NamHoc = $_POST['NamHoc'];
        $GiaHocPhiMoiTinChi = $_POST['GiaHocPhiMoiTinChi'];

        // Câu lệnh SQL để chèn dữ liệu vào bảng hocphitc
        $sql = "INSERT INTO hocphitc (HocKy, NamHoc, GiaHocPhiMoiTinChi) 
            VALUES ('$HocKy', '$NamHoc', '$GiaHocPhiMoiTinChi')";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }



    public function getTuitionInformation()
    {
        $sql = "SELECT * FROM hocphitc";  // Lấy dữ liệu học phí từ bảng hocphitc
        $result = mysqli_query($this->con, $sql);

        if (!$result) {
            die("Error executing query: " . $this->con->error);
        }

        // Trả về kết quả query trực tiếp mà không cần gói trong mảng
        return $result;
    }

    // Lấy học phí theo học kỳ và năm học
    public function getTuitionBySemesterAndYear($HocKy, $NamHoc)
    {
        $sql = "SELECT * FROM hocphitc WHERE HocKy = ? AND NamHoc = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ss", $HocKy, $NamHoc);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc(); // Trả về thông tin học phí cho học kỳ và năm học
    }

    // Cập nhật học phí
    public function updateTuition($HocKy, $NamHoc, $GiaHocPhiMoiTinChi)
    {
        // Cập nhật giá học phí mỗi tín chỉ trong bảng hocphitc
        $sql = "UPDATE hocphitc SET GiaHocPhiMoiTinChi = ? WHERE HocKy = ? AND NamHoc = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("dss", $GiaHocPhiMoiTinChi, $HocKy, $NamHoc);
        $result = $stmt->execute();

        // Nếu việc cập nhật giá học phí thành công, tiếp tục cập nhật học phí cho sinh viên
        if ($result) {
            // Lấy danh sách sinh viên đã đăng ký môn học trong học kỳ và năm học đó
            $sql_students = "SELECT DISTINCT MaSoSV FROM dangkymonhoc WHERE HocKy = ? AND NamHoc = ?";
            $stmt = $this->con->prepare($sql_students);
            $stmt->bind_param("ss", $HocKy, $NamHoc);
            $stmt->execute();
            $studentsResult = $stmt->get_result();

            // Lặp qua các sinh viên đã đăng ký và tính toán lại học phí
            while ($student = $studentsResult->fetch_assoc()) {
                // Lấy tổng số tín chỉ mà sinh viên đã đăng ký trong học kỳ và năm học đó
                $sql = "SELECT SUM(m.SoTinChi) AS TotalCredits FROM dangkymonhoc d 
                    JOIN monhoc m ON d.MaMon = m.MaMon 
                    WHERE d.MaSoSV = ? AND d.HocKy = ? AND d.NamHoc = ?";
                $stmt = $this->con->prepare($sql);
                $stmt->bind_param("sss", $student['MaSoSV'], $HocKy, $NamHoc);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();

                // Tính lại học phí cho sinh viên
                $totalCredits = $data['TotalCredits'] ?? 0;
                $newTuitionFee = $totalCredits * $GiaHocPhiMoiTinChi;

                // Cập nhật học phí cho sinh viên trong bảng hocphi
                $sql_update_fee = "UPDATE hocphi SET SoTien = ? WHERE MaSoSV = ? AND HocKy = ? AND NamHoc = ?";
                $stmt = $this->con->prepare($sql_update_fee);
                $stmt->bind_param("dsss", $newTuitionFee, $student['MaSoSV'], $HocKy, $NamHoc);
                $stmt->execute();
            }

            return "Cập nhật học phí thành công!";
        } else {
            return "Cập nhật học phí thất bại!";
        }
    }



    // Xóa học phí
    public function deleteTuition($HocKy, $NamHoc)
    {
        $sql = "DELETE FROM hocphitc WHERE HocKy = ? AND NamHoc = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ss", $HocKy, $NamHoc);

        if ($stmt->execute()) {
            return "Xóa học phí thành công!";
        } else {
            return "Lỗi khi xóa học phí!";
        }
    }
}
