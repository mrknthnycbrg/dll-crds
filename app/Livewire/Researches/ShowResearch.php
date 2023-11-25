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

        return view('livewire.researches.show-research', compact('research'));
    }

    public function view()
    {
        $this->redirect((route('view-file', ['slug' => $this->slug])));
    }
}
