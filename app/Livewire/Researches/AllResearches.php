<?php

namespace App\Livewire\Researches;

use App\Models\Department;
use App\Models\Research;
use Livewire\Component;
use Livewire\WithPagination;

class AllResearches extends Component
{
    use WithPagination;

    public $selectedDepartment;

    public $selectedYear;

    public function render()
    {
        $departments = Department::all();

        $researches = Research::where('published', true)
            ->when($this->selectedDepartment, function ($query) {
                $query->where('department_id', $this->selectedDepartment);
            })
            ->when($this->selectedYear, function ($query) {
                $query->whereYear('date_submitted', $this->selectedYear);
            })
            ->latest('date_submitted')
            ->paginate(6);

        return view('livewire.researches.all-researches', compact('researches', 'departments'))
            ->layout('layouts.app')
            ->title('Researches - DLL-CRDS');
    }

    public function updatedSelectedDepartment()
    {
        $this->resetPage();
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
    }
}
