<?php
class profile extends Controller
{
    private $profile;

    public function __construct()
    {
        $this->profile = $this->model('profile_m');
    }

    public function Get_data()
    {

        $student = isset($_SESSION['student']) ? $_SESSION['student'] : null;

        $maSoSV = $student['MaSoSV'];
        $studentInfo = $this->profile->getStudentInfo($maSoSV);





        // Truyền dữ liệu vào view
        $this->view('Masterlayout_student', [
            'page' => 'profile_v',
            'studentInfo' => $studentInfo,

        ]);
    }
}
