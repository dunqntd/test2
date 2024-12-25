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
    public function sinhvien_find($masv, $name)
    {
        $sql = "SELECT * FROM sinhvien WHERE MaSoSV LIKE '%$masv%' AND HoTen LIKE '%$name%'";
        $result = mysqli_query($this->con, $sql);


        return $result;
    }


    function sinhvien_ins($masv, $ht, $ns, $dc, $dt, $email, $gt, $password)
    {
        // Kiểm tra mã sinh viên có tồn tại không
        $sql_check_masv = "SELECT * FROM sinhvien WHERE MaSoSv = '$masv'";
        $result_masv = mysqli_query($this->con, $sql_check_masv);

        // Kiểm tra số điện thoại có tồn tại không
        $sql_check_dt = "SELECT * FROM sinhvien WHERE SoDienThoai = '$dt'";
        $result_dt = mysqli_query($this->con, $sql_check_dt);

        // Kiểm tra email có tồn tại không
        $sql_check_email = "SELECT * FROM sinhvien WHERE Email = '$email'";
        $result_email = mysqli_query($this->con, $sql_check_email);

        if (mysqli_num_rows($result_masv) > 0) {
            echo '<script>alert("Mã sinh viên đã tồn tại. Vui lòng nhập mã khác.")</script>';
            return false;
        } elseif (mysqli_num_rows($result_dt) > 0) {
            echo '<script>alert("Số điện thoại đã tồn tại. Vui lòng nhập số khác.")</script>';
            return false;
        } elseif (mysqli_num_rows($result_email) > 0) {
            echo '<script>alert("Email đã tồn tại. Vui lòng nhập email khác.")</script>';
            return false;
        } else {
            // Thêm sinh viên vào bảng sinhvien
            $sql_insert_sinhvien = "INSERT INTO sinhvien (MaSoSv, HoTen, NgaySinh, GioiTinh, QueQuan, Email, SoDienThoai) 
                                    VALUES ('$masv', '$ht', '$ns', '$gt', '$dc', '$email', '$dt')";
            if (mysqli_query($this->con, $sql_insert_sinhvien)) {


                // Thêm tài khoản người dùng vào bảng users
                $sql_insert_user = "INSERT INTO users (email, password, role, name) 
                                    VALUES ('$email', '$password', 1, '$ht')";
                if (mysqli_query($this->con, $sql_insert_user)) {
                    return true;  // Thêm sinh viên và tài khoản thành công
                } else {
                    echo '<script>alert("Thêm tài khoản người dùng không thành công.")</script>';
                    return false;  // Thêm tài khoản không thành công
                }
            } else {
                echo '<script>alert("Thêm sinh viên không thành công.")</script>';
                return false;  // Thêm sinh viên không thành công
            }
        }
    }


    function sinhvien_upd($masv, $ht, $ns, $dc, $dt, $email, $gt)
    {
        $sql = "UPDATE sinhvien SET HoTen='$ht', NgaySinh='$ns', QueQuan='$dc', SoDienThoai='$dt', Email='$email', GioiTinh='$gt'WHERE MaSoSV='$masv'";
        return mysqli_query($this->con, $sql);
    }
    function sinhvien_del($masv)
    {

        $sql_del_user = "DELETE FROM users WHERE email = (SELECT Email FROM sinhvien WHERE MaSoSv = '$masv')";
        if (mysqli_query($this->con, $sql_del_user)) {

            $sql_del_sinhvien = "DELETE FROM sinhvien WHERE MaSoSV = '$masv'";
            return mysqli_query($this->con, $sql_del_sinhvien);
        } else {

            return false;
        }
    }
}
