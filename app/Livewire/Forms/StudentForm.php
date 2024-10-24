<?php

namespace App\Livewire\Forms;

use App\Models\Student;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StudentForm extends Form
{

    public ?Student $student;

    #[Validate]
    public $name;

    #[Validate]
    public $email;

    #[Validate]
    public $class_id;

    #[Validate]
    public $section_id;

    public function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'class_id' => 'required',
            'section_id' => 'required'
        ];

        if(isset($this->student)){
            $rules['email'] = 'required|email|unique:students,email,'. $this->student->id;
        }

        return $rules;

    }

    public function messages()
    {
        return [
            'class_id.required' => 'The class field is required',
            'section_id.required' => 'A section field is required',
        ];
    }

    public function setStudent(Student $student)
    {
        $this->student = $student;

        $this->name = $student->name;

        $this->email = $student->email;

        $this->class_id = $student->class_id;

        $this->section_id = $student->section_id;
    }

}
