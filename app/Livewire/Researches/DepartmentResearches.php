<?php

namespace App\Livewire\Researches;

use App\Models\Department;
use App\Models\Research;
use Livewire\Attributes\Layout;
use Livewire\Component;

class DepartmentResearches extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $department = Department::where('slug', $this->slug)
            ->firstOrFail();

        $researches = Research::with('department')
            ->where('department_id', $department->id)
            ->where('published', true)
            ->latest('date_submitted')
            ->paginate(6);

        return view('livewire.researches.department-researches', compact('department', 'researches'));
    }
}
