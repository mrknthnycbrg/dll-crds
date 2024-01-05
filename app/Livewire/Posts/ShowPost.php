<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class ShowPost extends Component
{
    public $post;

    public function mount($slug)
    {
        $this->post = Post::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $relatedPosts = Post::where([
            ['id', '!=', $this->post->id],
            ['category_id', '=', $this->post->category_id],
            ['published', '=', true],
        ])
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('livewire.posts.show-post', compact('relatedPosts'))
            ->layout('layouts.app')
            ->title($this->post->title.' - DLL-CRDS');
    }
}
