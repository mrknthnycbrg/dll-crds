<?php

namespace App\Livewire\Researches;

use App\Models\Research;
use Livewire\Component;

class ShowResearch extends Component
{
    public $research;

    public function mount($slug)
    {
        $this->research = Research::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $relatedResearches = Research::where([
            ['id', '!=', $this->research->id],
            ['department_id', '=', $this->research->department_id],
            ['published', '=', true],
        ])
            ->latest('date_submitted')
            ->take(3)
            ->get();

        return view('livewire.researches.show-research', compact('relatedResearches'))
            ->layout('layouts.app')
            ->title($this->research->title.' - DLL-CRDS');
    }

    public function view()
    {
        $this->redirectRoute('view-file', ['slug' => $this->research->slug]);
    }
}
