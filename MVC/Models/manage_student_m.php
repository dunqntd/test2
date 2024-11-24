<?php
// Model: manage_student_m.php

class manage_student_m extends connectDB
{

    public function get_student_infor()
    {
        $sql = "SELECT * FROM sinhvien";
        $result = mysqli_query($this->con, $sql);


        return $result;
    }

    function sinhvien_ins($masv, $ht, $ns, $dc, $dt, $email, $gt)
    {
        $sql_check = "SELECT * FROM sinhvien WHERE MaSoSv = '$masv'";
        $result = mysqli_query($this->con, $sql_check);

        if (mysqli_num_rows($result) == 0) {
            $sql = "INSERT INTO sinhvien VALUES('$masv','$ht','$ns','$gt','$dc','$email','$dt')";
            return mysqli_query($this->con, $sql);
        } else {
            echo '<script>alert("mã học sinh đã tồn tại. Vui lòng nhập mã khác.")</script>';
        }
    }
}
