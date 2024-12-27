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
}
