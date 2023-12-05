<?php

namespace App\Livewire\Downloadables;

use App\Models\Downloadable;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class AllDownloadables extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]
    public function render()
    {
        $downloadables = Downloadable::where('published', true)
            ->latest('date_published')
            ->paginate(6);

        return view('livewire.downloadables.all-downloadables', compact('downloadables'));
    }
}
