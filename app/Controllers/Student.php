<?php

namespace App\Controllers;

class Student extends BaseController
{
    public function index()
    {
        $data['title'] = 'Estudiantes';
        echo view('layout/top.php', $data);
        echo view('student/index');
        echo view('layout/bottom.php');
    }

    public function add($id = 0)
    {

        $data['title'] = 'Estudiantes';
        echo view('layout/top.php', $data);
        echo view('student/add');
        echo view('layout/bottom');
    }
}
