<?php
class registration_m extends connectDB
{
    // Lấy danh sách sinh viên
    public function getAllStudents()
    {
        $sql = "SELECT * FROM sinhvien";
        $result = mysqli_query($this->con, $sql);

        if (!$result) {
            die("Error executing query: " . $this->con->error);
        }

        $students = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = $row;
        }

        return $students; // Trả về mảng sinh viên
    }

    // Lấy danh sách môn học
    public function getAllCourses()
    {
        $sql = "SELECT * FROM monhoc";
        $result = mysqli_query($this->con, $sql);

        if (!$result) {
            die("Error executing query: " . $this->con->error);
        }

        $courses = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $courses[] = $row;
        }

        return $courses; // Trả về mảng môn học
    }

    // Đăng ký môn học cho sinh viên
    public function registerCourseForStudent($studentId, $courseId, $semester, $academicYear)
    {
        // Kiểm tra trùng lặp
        if ($this->isCourseAlreadyRegistered($studentId, $courseId, $semester, $academicYear)) {
            return false; // Đã đăng ký trước đó
        }

        $sql = "INSERT INTO dangkymonhoc (MaSoSV, MaMon, HocKy, NamHoc) VALUES (?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->con->error);
        }

        $stmt->bind_param("ssss", $studentId, $courseId, $semester, $academicYear);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
        $this->registerCourseAndUpdateTuition($studentId, $courseId, $semester, $academicYear);
        $stmt->close();

        return true; // Đăng ký thành công
    }


    // Kiểm tra xem sinh viên đã đăng ký môn học chưa (tránh trùng lặp)
    public function isCourseAlreadyRegistered($studentId, $courseId)
    {
        $sql = "SELECT * FROM dangkymonhoc WHERE MaSoSV = ? AND MaMon = ?";
        $stmt = $this->con->prepare($sql);

        if (!$stmt) {
            die("Prepare statement failed: " . $this->con->error);
        }

        $stmt->bind_param("ss", $studentId, $courseId);
        $stmt->execute();
        $result = $stmt->get_result();

        $isRegistered = $result->num_rows > 0;

        $stmt->close();

        return $isRegistered;
    }


    public function getRegisteredCourses($studentId)
    {
        $sql = "SELECT mh.MaMon, mh.TenMon, dk.HocKy, dk.NamHoc 
            FROM dangkymonhoc dk 
            JOIN monhoc mh ON dk.MaMon = mh.MaMon 
            WHERE dk.MaSoSV = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();

        $courses = [];
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }

        $stmt->close();

        return $courses;
    }


    public function registerCourseAndUpdateTuition($studentId, $courseId, $semester, $academicYear)
    {
        // Bước 2: Lấy số tín chỉ của môn học từ bảng `monhoc`
        $queryMonHoc = "SELECT SoTinChi FROM monhoc WHERE MaMon = ?";
        $stmt = $this->con->prepare($queryMonHoc);
        $stmt->bind_param("s", $courseId);
        $stmt->execute();
        $result = $stmt->get_result();
        $monHoc = $result->fetch_assoc();

        if (!$monHoc) {
            die("Môn học không tồn tại!");
        }

        var_dump($monHoc);  // Debug: Kiểm tra dữ liệu môn học

        $SoTinChi = $monHoc['SoTinChi'];

        // Bước 3: Lấy giá học phí mỗi tín chỉ từ bảng `hocphitc`
        $queryHocPhi = "SELECT GiaHocPhiMoiTinChi FROM hocphitc WHERE HocKy = ? AND NamHoc = ?";
        $stmt = $this->con->prepare($queryHocPhi);
        $stmt->bind_param("ss", $semester, $academicYear);
        $stmt->execute();
        $result = $stmt->get_result();
        $hocPhi = $result->fetch_assoc();

        if (!$hocPhi) {
            die("Không có thông tin học phí cho học kỳ và năm học này!");
        }

        var_dump($hocPhi);  // Debug: Kiểm tra dữ liệu học phí

        $GiaHocPhiMoiTinChi = $hocPhi['GiaHocPhiMoiTinChi'];

        // Bước 4: Tính học phí cho môn học
        $SoTien = $SoTinChi * $GiaHocPhiMoiTinChi;

        // Bước 5: Thêm thông tin học phí vào bảng `hocphi`
        $queryHocPhiInsert = "INSERT INTO hocphi (MaSoSV, MaMon, HocKy, NamHoc, SoTien, SoTienDaThanhToan, TrangThai) 
                              VALUES (?, ?, ?, ?, ?, 0.00, 'Chua thanh toan')";
        $stmt = $this->con->prepare($queryHocPhiInsert);
        $stmt->bind_param("sssss", $studentId, $courseId, $semester, $academicYear, $SoTien);

        if (!$stmt->execute()) {
            die("Lỗi khi cập nhật học phí! " . $stmt->error);
        }

        return "Đăng ký môn học và cập nhật học phí thành công!";
    }
}
