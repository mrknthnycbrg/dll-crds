<?php

namespace App\Livewire\Researches;

use App\Models\Research;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class AllResearches extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]
    public function render()
    {
        $researches = Research::with('department')
            ->where('published', true)
            ->orderBy('date_submitted', 'desc')
            ->simplePaginate(6);

        return view('livewire.researches.all-researches', compact('researches'));
    }
}
