<?php
class connectDB
{
    public $con;
    protected $server = 'localhost';
    protected $user = 'websinhvien';
    protected $pass = '123456';
    protected $db = 'project_management_student';
    function __construct()
    {
        $this->con = mysqli_connect($this->server, $this->user, $this->pass, $this->db);
        mysqli_query($this->con, "SET NAMES 'utf8'");
    }
}
