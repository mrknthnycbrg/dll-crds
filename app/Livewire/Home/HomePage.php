<?php

namespace App\Livewire\Home;

use App\Models\Post;
use App\Models\Research;
use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        $latestPosts = Post::where('published', true)
            ->latest('date_published')
            ->take(3)
            ->get();

        $latestResearches = Research::where('published', true)
            ->latest('date_submitted')
            ->take(3)
            ->get();

        return view('livewire.home.home-page', compact('latestPosts', 'latestResearches'))
            ->layout('layouts.app')
            ->title('Home - DLL-CRDS');
    }
}
