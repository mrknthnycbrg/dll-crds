<?php

namespace App\Livewire\Home;

use App\Models\Post;
use App\Models\Research;
use Livewire\Attributes\Layout;
use Livewire\Component;

class HomePage extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        $latestPosts = Post::with('category')
            ->where('published', true)
            ->latest('date_published')
            ->take(3)
            ->get();

        $latestResearches = Research::with('department')
            ->where('published', true)
            ->latest('date_submitted')
            ->take(3)
            ->get();

        return view('livewire.home.home-page', compact('latestPosts', 'latestResearches'));
    }
}
