<?php

namespace App\Livewire\Home;

use App\Models\Post;
use App\Models\Research;
use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        $latestPost = Post::where('published', true)
            ->latest('date_published')
            ->first();

        $otherPosts = Post::where('published', true)
            ->latest('date_published')
            ->skip(1)
            ->take(2)
            ->get();

        $latestResearches = Research::where('published', true)
            ->latest('date_submitted')
            ->take(3)
            ->get();

        return view('livewire.home.home-page', compact('latestPost', 'otherPosts', 'latestResearches'))
            ->layout('layouts.app')
            ->title('Home - DLL-CRDS');
    }
}
