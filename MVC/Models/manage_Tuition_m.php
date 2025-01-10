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
        // 1. Cập nhật giá học phí mỗi tín chỉ trong bảng hocphitc
        $sql = "UPDATE hocphitc SET GiaHocPhiMoiTinChi = ? WHERE HocKy = ? AND NamHoc = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("dss", $GiaHocPhiMoiTinChi, $HocKy, $NamHoc);
        $result = $stmt->execute();

        if (!$result) {
            return "Lỗi khi cập nhật giá học phí tín chỉ: " . $stmt->error;
        }

        // 2. Lấy danh sách các sinh viên và môn học đã đăng ký trong học kỳ và năm học
        $sql_students = "
            SELECT dk.MaSoSV, dk.MaMon, mh.SoTinChi 
            FROM dangkymonhoc dk 
            JOIN monhoc mh ON dk.MaMon = mh.MaMon 
            WHERE dk.HocKy = ? AND dk.NamHoc = ?";
        $stmt = $this->con->prepare($sql_students);
        $stmt->bind_param("ss", $HocKy, $NamHoc);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            return "Lỗi khi lấy danh sách sinh viên và môn học: " . $this->con->error;
        }

        // 3. Lặp qua từng sinh viên và môn học để tính lại học phí
        while ($row = $result->fetch_assoc()) {
            $MaSoSV = $row['MaSoSV'];
            $MaMon = $row['MaMon'];
            $SoTinChi = $row['SoTinChi'];

            // Tính lại học phí cho môn học
            $SoTien = $SoTinChi * $GiaHocPhiMoiTinChi;

            // 4. Cập nhật học phí cho từng môn học trong bảng hocphi
            $sql_update_fee = "UPDATE hocphi SET SoTien = ? WHERE MaSoSV = ? AND MaMon = ? AND HocKy = ? AND NamHoc = ?";
            $stmt_update = $this->con->prepare($sql_update_fee);
            $stmt_update->bind_param("dssss", $SoTien, $MaSoSV, $MaMon, $HocKy, $NamHoc);

            if (!$stmt_update->execute()) {
                return "Lỗi khi cập nhật học phí cho sinh viên $MaSoSV, môn $MaMon: " . $stmt_update->error;
            }
        }

        return "Cập nhật học phí thành công!";
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
