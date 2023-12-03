<?php

namespace App\Livewire\Researches;

use App\Models\Research;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ShowResearch extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $research = Research::where('slug', $this->slug)
            ->with('department')
            ->firstOrFail();

        $relatedResearches = Research::with('department')
            ->where([
                ['id', '!=', $research->id],
                ['department_id', '=', $research->department_id],
                ['published', '=', true],
            ])
            ->latest('date_submitted')
            ->take(3)
            ->get();

        return view('livewire.researches.show-research', compact('research', 'relatedResearches'));
    }

    public function view()
    {
        $this->redirect((route('view-file', ['slug' => $this->slug])));
    }
}
