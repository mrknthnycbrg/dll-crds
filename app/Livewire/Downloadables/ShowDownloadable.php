<?php

namespace App\Livewire\Downloadables;

use App\Models\Downloadable;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ShowDownloadable extends Component
{
    public $downloadable;

    public function mount($slug)
    {
        $this->downloadable = Downloadable::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.downloadables.show-downloadable')
            ->layout('layouts.app')
            ->title($this->downloadable->name . ' - DLL-CRDS');
    }

    public function download()
    {
        return response()->download(Storage::path('public/' . $this->downloadable->downloadable_path));
    }
}
