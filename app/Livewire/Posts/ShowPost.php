<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class ShowPost extends Component
{
    public $slug;
    public $post;
    public $relatedPosts;

    public function render()
    {
        $this->post = Post::where('slug', $this->slug)
            ->firstOrFail();

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
            ->title($this->post->title.' - DLL-CRDS');;
    }
}
