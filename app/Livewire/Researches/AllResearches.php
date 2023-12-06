<?php

namespace App\Livewire\Researches;

use App\Models\Research;
use Livewire\Component;
use Livewire\WithPagination;

class AllResearches extends Component
{
    use WithPagination;

    public function render()
    {
        $researches = Research::where('published', true)
            ->latest('date_submitted')
            ->paginate(6);

        return view('livewire.researches.all-researches', compact('researches'))
            ->layout('layouts.app')
            ->title('Researches - DLL-CRDS');
    }
}
