<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{

    public $search;

    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        $query = Student::query();

        $query = $this->applySearch($query);

        return view('livewire.students.index', [
            'students' => $query->paginate(10)
        ]);
    }

    public function delete(Student $student)
    {
        $student->delete();
    }

    public function applySearch(Builder $query)
    {
        return $query->where('name', 'like', '%' . $this->search . '%');
    }

}
