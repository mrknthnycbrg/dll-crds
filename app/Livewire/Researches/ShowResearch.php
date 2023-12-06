<?php

namespace App\Livewire\Researches;

use App\Models\Research;
use Livewire\Component;

class ShowResearch extends Component
{
    public $slug;
    public $research;
    public $relatedResearches;

    public function render()
    {
        $this->research = Research::where('slug', $this->slug)
            ->firstOrFail();

        $this->relatedResearches = Research::where([
            ['id', '!=', $this->research->id],
            ['department_id', '=', $this->research->department_id],
            ['published', '=', true],
        ])
            ->latest('date_submitted')
            ->take(3)
            ->get();

        return view('livewire.researches.show-research')
            ->layout('layouts.app')
            ->title($this->research->title.' - DLL-CRDS');
    }

    public function view()
    {
        $this->redirect((route('view-file', ['slug' => $this->slug])));
    }
}
