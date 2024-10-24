<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{

    public string $search = '';

    public string $sortColumn = 'created_at', $sortDirection = 'desc';

    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        $query = Student::query();

        $query = $this->applySearch($query);

        $query = $this->applySort($query);

        return view('livewire.students.index', [
            'students' => $query->paginate(10)
        ]);
    }

    protected function applySort(Builder $query)
    {
        return $query->orderBy($this->sortColumn, $this->sortDirection);
    }

    public function sortBy(string $column)
    {
        if($this->sortColumn == $column){
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumn = $column;
    }

    public function applySearch(Builder $query)
    {
        return $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhereHas('class', fn($query) => $query->where('name', 'like', '%' . $this->search . '%'));
    }

    public function delete(Student $student)
    {
        $student->delete();
    }



}
