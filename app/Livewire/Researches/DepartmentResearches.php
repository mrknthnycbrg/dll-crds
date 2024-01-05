<?php

namespace App\Livewire\Researches;

use App\Models\Department;
use App\Models\Research;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentResearches extends Component
{
    use WithPagination;

    public $department;

    public $selectedYear;

    public function mount($slug)
    {
        $this->department = Department::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $researches = Research::where('department_id', $this->department->id)
            ->where('published', true)
            ->when($this->selectedYear, function ($query) {
                $query->whereYear('date_submitted', $this->selectedYear);
            })
            ->latest('date_submitted')
            ->paginate(6);

        return view('livewire.researches.department-researches', compact('researches'))
            ->layout('layouts.app')
            ->title($this->department->name.' - DLL-CRDS');
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
    }
}
