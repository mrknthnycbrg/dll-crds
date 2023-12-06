<?php

namespace App\Livewire\Home;

use App\Models\Post;
use App\Models\Research;
use Livewire\Component;

class HomePage extends Component
{
    public $latestPost;
    public $otherPosts;
    public $latestResearches;

    public function render()
    {
        $this->latestPost = Post::where('published', true)
            ->latest('date_published')
            ->first();

        $this->otherPosts = Post::where('published', true)
            ->latest('date_published')
            ->skip(1)
            ->take(2)
            ->get();

        $this->latestResearches = Research::where('published', true)
            ->latest('date_submitted')
            ->take(3)
            ->get();

        return view('livewire.home.home-page')
            ->layout('layouts.app')
            ->title('Home - DLL-CRDS');
    }
}
