<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ShowPost extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $post = Post::where('slug', $this->slug)
            ->with('category')
            ->firstOrFail();

        $relatedPosts = Post::with('category')
            ->where([
                ['id', '!=', $post->id],
                ['category_id', '=', $post->category_id],
                ['published', '=', true],
            ])
            ->latest('date_published')
            ->take(3)
            ->get();


        return view('livewire.posts.show-post', compact('post', 'relatedPosts'));
    }
}
