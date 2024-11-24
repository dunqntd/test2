<?php
// Controller: manage_students.php

class Manage_students extends Controller
{
    private $manage_student_model;

    public function __construct()
    {
        $this->manage_student_model = $this->model('manage_student_m');
    }

    public function Get_data()
    {
        $danhSachSinhVien = $this->manage_student_model->get_student_infor();

        $this->view('Masterlayout', [
            'page' => 'manage_students_v',
            'danhsachhocsinh' => $danhSachSinhVien
        ]);
    }
    public function addstudent()
    {

        $this->view('Masterlayout', [
            'page' => 'add_student_v',

        ]);
    }
    public function themmoi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnthem'])) {
            $insertResult = $this->themmoisinhvien(); // Gọi hàm thêm mới
            if ($insertResult) {
                echo '<script>alert("Thêm mới thành công!");</script>';
            } else {
                echo '<script>alert("Thêm mới thất bại!");</script>';
            }
            echo '<script>window.location.href = "http://localhost/project_quanlisinhvien/manage_students/addstudent";</script>';
            exit;
        }
    }

    private function themMoisinhvien()
    {

        $mahs = $_POST['student_id'];
        $ht = $_POST['name'];
        $ns = $_POST['dob'];
        $dc = $_POST['address'];
        $dt = $_POST['phone'];
        $email = $_POST['email'];
        $gt = $_POST['gender'];



        $insertResult = $this->manage_student_model->sinhvien_ins($mahs, $ht, $ns, $dc, $dt, $email, $gt);
        if ($insertResult) {
            echo '<script>alert("Thêm mới thành công")</script>';
        } else {
            echo '<script>alert("Thêm mới thất bại")</script>';
        }
    }
}
