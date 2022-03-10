<?php

namespace App\Controllers;

use App\Entities\Student;
use App\Models\StudentModel;

class StudentController extends BaseController
{
    protected StudentModel $model;
    public function __construct()
    {
        $this->model = new StudentModel();
    }
    public function index()
    {
        $students = $this->model->findAll();
        $data['students'] = $students;
        $data['title'] = 'Estudiantes';

        echo view('layout/top.php', $data);
        echo view('student/index', $data);
        echo view('layout/bottom.php');
    }

    public function add($id = 0)
    {
        $student = new Student();
        $data['errors'] = false;
        if ($this->request->getMethod() === 'post') {
            $student = $this->model->find($id) ?? new Student();
            $og_student = $student;
            $student->first_name = $this->request->getPost('first_name');
            $student->last_name = $this->request->getPost('last_name');
            $student->dui = $this->request->getPost('dui');
            $student->code_id = $this->request->getPost('code_id');
            if ($this->model->save($student) === true) return redirect()->to(site_url('student'));
            $data['title'] = 'Actualizar estudiante';
            $data['errors'] = $this->model->errors();
        } else {
            if ($id == 0) {
                $student->first_name = '';
                $student->last_name = '';
                $student->dui = '00000000-0';
                $student->code_id = 'U00000000';
                $data['title'] = 'Crear estudiante';
            } else {
                $student = $this->model->find($id);
                $data['title'] = 'Actualizar estudiante';
            }
        }
        $data['student'] = $student;
        echo view('layout/top.php', $data);
        echo view('student/add', $data);
        echo view('layout/bottom');
    }
}
