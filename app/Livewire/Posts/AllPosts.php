<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class AllPosts extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]
    public function render()
    {
        $posts = Post::where('published', true)
            ->orderBy('date_published', 'desc')
            ->simplePaginate(6);

        return view('livewire.posts.all-posts', compact('posts'));
    }
}
