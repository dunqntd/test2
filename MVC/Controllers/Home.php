<?php
class Home extends controller
{


    function  Get_data()
    {
        $this->view('Masterlayout', [
            'page' => 'Home_v',

        ]);
    }
    function hh()
    {
        $this->view('Masterlayout_student', [
            'page' => 'Home_v',

        ]);
    }
}
