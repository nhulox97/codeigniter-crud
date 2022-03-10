<?php

namespace App\Controllers;

use App\Entities\Student;
use App\Models\StudentModel;
use \Config\Services;

class StudentController extends BaseController
{
    protected StudentModel $model;
    protected $session;

    public function __construct()
    {
        $this->model = new StudentModel();
        $this->session = Services::session();
    }
    public function index()
    {
        $pgSize = $this->request->getVar('pgSize') ?? 5;
        $pg = $this->request->getVar('page') ?? 1;

        $students = $this->model->paginate($pgSize, 'default', $pg);

        $data['students'] = $students;
        $data['pager'] = $this->model->pager;
        $data['currPg'] = $pgSize;
        $data['title'] = 'Estudiantes';
        $data['result'] = $this->session->getFlashdata('result') ?? false;

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
            $student->first_name = $this->request->getPost('first_name');
            $student->last_name = $this->request->getPost('last_name');
            $student->dui = $this->request->getPost('dui');
            $student->code_id = $this->request->getPost('code_id');
            if ($this->model->save($student) === true) {
                $action_msg = $id == 0 ? ['type' => 'success', 'msg' => 'Student successfully created'] : ['type' => 'primary', 'msg' => 'Student successfully updated'];
                $_SESSION['result'] = $action_msg;
                $this->session->markAsFlashdata('result');
                return redirect()->to(site_url('student'));
            }

            $data['student'] = $student;
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

    public function delete($id = 0)
    {
        $student = $this->model->find($id);
        $result = ['type' => 'danger', 'msg' => 'Nothing deleted'];

        if (!is_null($student)) {
            $result = $this->model->delete($student->id) === true ? ['type' => 'danger', 'msg' => 'User deleted'] : ['type' => 'danger', 'msg' => 'Error on deletion'];
        }

        $_SESSION['result'] = $result;
        $this->session->markAsFlashdata('result');
        return redirect()->to(site_url('student'));
    }
}
