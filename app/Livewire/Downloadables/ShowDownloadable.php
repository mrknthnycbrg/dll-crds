<?php

namespace App\Livewire\Downloadables;

use App\Models\Downloadable;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ShowDownloadable extends Component
{
    public $slug;
    public $downloadable;

    public function render()
    {
        $this->downloadable = Downloadable::where('slug', $this->slug)
            ->firstOrFail();

        return view('livewire.downloadables.show-downloadable')
            ->layout('layouts.app')
            ->title($this->downloadable->name.' - DLL-CRDS');
    }

    public function download()
    {
        $downloadableFilePath = Storage::path('public/'.$this->downloadable->downloadable_path);

        return response()->download($downloadableFilePath);
    }
}
