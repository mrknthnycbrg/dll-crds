<?php

namespace App\Livewire\Posts;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class AllPosts extends Component
{
    use WithPagination;

    public $selectedCategory;

    public $selectedYear;

    public function render()
    {
        $categories = Category::all();

        $posts = Post::where('published', true)
            ->when($this->selectedCategory, function ($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->when($this->selectedYear, function ($query) {
                $query->whereYear('date_published', $this->selectedYear);
            })
            ->latest('date_published')
            ->paginate(6);

        return view('livewire.posts.all-posts', compact('posts', 'categories'))
            ->layout('layouts.app')
            ->title('News - DLL-CRDS');
    }

    public function selectedCategory()
    {
        $this->resetPage();
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
    }
}
