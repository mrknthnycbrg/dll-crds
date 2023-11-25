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
        $post = Post::where('slug', $this->slug)->firstOrFail();

        return view('livewire.posts.show-post', compact('post'));
    }
}
