<?php

namespace App\Livewire\Researches;

use App\Models\Department;
use App\Models\Research;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentResearches extends Component
{
    use WithPagination;

    public $slug;
    public $department;

    public function render()
    {
        $this->department = Department::where('slug', $this->slug)
            ->firstOrFail();

        $researches = Research::where('department_id', $this->department->id)
            ->where('published', true)
            ->latest('date_submitted')
            ->paginate(6);

        return view('livewire.researches.department-researches', ['department' => $this->department, 'researches' => $researches])
            ->layout('layouts.app')
            ->title($this->department->name.' - DLL-CRDS');
    }
}
