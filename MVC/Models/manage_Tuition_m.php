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
        $sql = "UPDATE hocphitc SET GiaHocPhiMoiTinChi = ? WHERE HocKy = ? AND NamHoc = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("dss", $GiaHocPhiMoiTinChi, $HocKy, $NamHoc);

        // Thực thi câu lệnh
        $result = $stmt->execute();

        return $result ? "Cập nhật học phí thành công!" : "Cập nhật học phí thất bại!";
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
