<?php

namespace App\Livewire\Posts;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryPosts extends Component
{
    use WithPagination;

    public $category;

    public function mount($slug)
    {
        $this->category = Category::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $posts = Post::where('category_id', $this->category->id)
            ->where('published', true)
            ->latest('date_published')
            ->paginate(6);

        return view('livewire.posts.category-posts', compact('posts'))
            ->layout('layouts.app')
            ->title($this->category->name.' - DLL-CRDS');
    }
}
