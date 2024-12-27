<?php
class StudentResults_m extends connectDB
{
    public function getStudentResults($studentId)
    {

        $query = "SELECT * FROM ketquahoctap WHERE MaSoSV = '$studentId'";
        $result = mysqli_query($this->con, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
