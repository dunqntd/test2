<?php
class Home extends controller
{


    function  Get_data()
    {
        $this->view('Masterlayout', [
            'page' => 'Home_v',

        ]);
    }
    function student_dashboard()
    {
        $this->view('Masterlayout_student', [
            'page' => 'Home_student_v',

        ]);
    }
}
