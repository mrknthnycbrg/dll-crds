<?php

namespace App\Livewire\Researches;

use App\Models\Department;
use App\Models\Research;
use Illuminate\Support\Carbon;
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
        $latestPublished = Research::where('published', true)->max('date_submitted');

        $earliestPublished = Research::where('published', true)->min('date_submitted');

        if ($latestPublished && $earliestPublished) {
            $latestYear = Carbon::parse($latestPublished)->year;
            $earliestYear = Carbon::parse($earliestPublished)->year;

            $yearRange = range($latestYear, $earliestYear);
            $years = array_combine($yearRange, $yearRange);
        } else {
            $years = null;
        }

        $researches = Research::where('department_id', $this->department->id)
            ->where('published', true)
            ->when($this->selectedYear, function ($query) {
                $query->whereYear('date_submitted', $this->selectedYear);
            })
            ->latest('date_submitted')
            ->paginate(6);

        return view('livewire.researches.department-researches', compact('researches', 'years'))
            ->layout('layouts.app')
            ->title($this->department->name.' - DLL-CRDS');
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
    }
}
