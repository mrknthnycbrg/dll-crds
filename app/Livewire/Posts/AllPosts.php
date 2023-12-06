<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class AllPosts extends Component
{
    use WithPagination;

    public function render()
    {
        $posts = Post::where('published', true)
            ->latest('date_published')
            ->paginate(6);

        return view('livewire.posts.all-posts', compact('posts'))
            ->layout('layouts.app')
            ->title('News - DLL-CRDS');
    }
}
