<?php

namespace App\Livewire\Posts;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryPosts extends Component
{
    use WithPagination;

    public $slug;
    public $category;

    public function render()
    {
        $this->category = Category::where('slug', $this->slug)
            ->firstOrFail();

        $posts = Post::where('category_id', $this->category->id)
            ->where('published', true)
            ->latest('date_published')
            ->paginate(6);

        return view('livewire.posts.category-posts', ['category' => $this->category, 'posts' => $posts])
            ->layout('layouts.app')
            ->title($this->category->name.' - DLL-CRDS');
    }
}
