<?php
class profile_m extends connectDB
{
    // Lấy thông tin sinh viên theo mã số sinh viên
    public function getStudentInfo($maSoSV)
    {
        $query = "SELECT * FROM sinhvien WHERE MaSoSV = ?";
        $stmt = $this->con->prepare($query);

        // Gắn giá trị vào tham số truy vấn
        $stmt->bind_param("s", $maSoSV);

        // Thực thi câu truy vấn
        $stmt->execute();

        // Lấy kết quả
        $result = $stmt->get_result();

        // Trả về một sinh viên duy nhất (lấy 1 dòng kết quả)
        return $result->fetch_assoc();
    }
    public function updateAvatar($maSoSV, $avatarFileName)
    {
        $sql = "UPDATE sinhvien SET Avatar = ? WHERE MaSoSV = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$avatarFileName, $maSoSV]);
    }
}
