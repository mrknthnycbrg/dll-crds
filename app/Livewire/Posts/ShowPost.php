<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class ShowPost extends Component
{
    public $post;
    public $relatedPosts;

    public function mount($slug)
    {
        $this->post = Post::where('slug', $slug)
            ->firstOrFail();
    }

    public function render()
    {
        $this->relatedPosts = Post::where([
            ['id', '!=', $this->post->id],
            ['category_id', '=', $this->post->category_id],
            ['published', '=', true],
        ])
            ->latest('date_published')
            ->take(3)
            ->get();

        return view('livewire.posts.show-post')
            ->layout('layouts.app')
            ->title($this->post->title.' - DLL-CRDS');
    }
}
