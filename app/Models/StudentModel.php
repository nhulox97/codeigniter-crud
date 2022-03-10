<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'estudiantes';
    protected $allowedFields = ['first_name', 'last_name', 'birthdate', 'dui', 'code_id'];
    protected $returnType = \App\Entities\Student::class;
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $validationRules = [
        'first_name' => 'required|min_length[2]',
        'last_name' => 'required|min_length[2]',
        'dui' => 'required|min_length[10]|max_length[10]|is_unique[estudiantes.dui]',
        'code_id' => 'required|min_length[9]|max_length[9]|is_unique[estudiantes.code_id]',
    ];
    protected $validationMessages = [
        'first_name' => [
            'required' => 'First name is required',
            'min_length' => 'First name must have at least 2 characters'
        ],
        'last_name' => [
            'required' => 'Last name is required',
            'min_length' => 'Last name must have at least 2 characters'
        ],
        'dui' => [
            'is_unique' => 'Sorry. That DUI number already exists',
            'required' => 'DUI is required',
            'min_length' => 'DUI must have only 9 characters length',
            'max_length' => 'DUI must have only 9 characters length',
        ],
        'code_id' => [
            'is_unique' => 'Sorry. That student code number already exists',
            'required' => 'Student code is required',
            'min_length' => 'DUI must have only 9 characters length',
            'max_length' => 'DUI must have only 9 characters length',
        ]
    ];
}
