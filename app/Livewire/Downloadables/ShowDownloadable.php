<?php

namespace App\Livewire\Downloadables;

use App\Models\Downloadable;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ShowDownloadable extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $downloadable = Downloadable::where('slug', $this->slug)
            ->firstOrFail();

        return view('livewire.downloadables.show-downloadable', compact('downloadable'));
    }

    public function download()
    {
        $downloadable = Downloadable::where('slug', $this->slug)
            ->firstOrFail();

        $downloadableFilePath = Storage::path('public/'.$downloadable->downloadable_path);

        return response()->download($downloadableFilePath);
    }
}
