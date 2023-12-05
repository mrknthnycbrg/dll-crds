<?php

namespace App\Livewire\Posts;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CategoryPosts extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $category = Category::where('slug', $this->slug)
            ->firstOrFail();

        $posts = Post::with('category')
            ->where('category_id', $category->id)
            ->where('published', true)
            ->latest('date_published')
            ->paginate(6);

        return view('livewire.posts.category-posts', compact('category', 'posts'));
    }
}
