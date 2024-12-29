<?php
class student_registration_m extends connectDB
{
    public function getAllCourses()
    {
        $query = "SELECT * FROM monhoc";
        $result = mysqli_query($this->con, $query);

        if (!$result) {
            die("Error fetching courses: " . mysqli_error($this->con));
        }

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function registerCourses($studentId, $semester, $academicYear, $courses)
    {
        // Chuẩn bị câu lệnh INSERT
        $query = "INSERT INTO dangkymonhoc (MaSoSV, MaMon, HocKy, NamHoc) 
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->con->prepare($query);

        if (!$stmt) {
            die("Error preparing statement: " . $this->con->error);
        }

        // Gắn tham số và thực thi cho từng môn học
        foreach ($courses as $course) {
            $stmt->bind_param("ssss", $studentId, $course, $semester, $academicYear);
            $result = $stmt->execute();

            if (!$result) {
                return false;
            }
        }

        return true;
    }
    public function get_student_by_id($student)
    {
        $sql = "SELECT * FROM sinhvien WHERE MaSoSV=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $student);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function get_registered_courses_by_student($student_id)
    {
        $sql = "SELECT mh.MaMon, mh.TenMon, mh.SoTinChi, dk.HocKy, dk.NamHoc
            FROM dangkymonhoc dk
            JOIN monhoc mh ON dk.MaMon = mh.MaMon
            WHERE dk.MaSoSV = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}
