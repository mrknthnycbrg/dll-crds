<?php

namespace App\Livewire\Downloadables;

use App\Models\Downloadable;
use Livewire\Component;
use Livewire\WithPagination;

class AllDownloadables extends Component
{
    use WithPagination;

    public function render()
    {
        $downloadables = Downloadable::where('published', true)
            ->latest('date_published')
            ->paginate(6);

        return view('livewire.downloadables.all-downloadables', compact('downloadables'))
            ->layout('layouts.app')
            ->title('Resources - DLL-CRDS');
    }
}
