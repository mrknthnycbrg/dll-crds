<?php

namespace App\Livewire\Posts;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryPosts extends Component
{
    use WithPagination;

    public $category;

    public $selectedYear;

    public function mount($slug)
    {
        $this->category = Category::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $latestPublished = Post::where('published', true)->max('date_published');

        $earliestPublished = Post::where('published', true)->min('date_published');

        if ($latestPublished && $earliestPublished) {
            $latestYear = Carbon::parse($latestPublished)->year;
            $earliestYear = Carbon::parse($earliestPublished)->year;

            $yearRange = range($latestYear, $earliestYear);
            $years = array_combine($yearRange, $yearRange);
        } else {
            $years = null;
        }

        $posts = Post::where('category_id', $this->category->id)
            ->where('published', true)
            ->when($this->selectedYear, function ($query) {
                $query->whereYear('date_published', $this->selectedYear);
            })
            ->latest('date_published')
            ->paginate(6);

        return view('livewire.posts.category-posts', compact('posts', 'years'))
            ->layout('layouts.app')
            ->title($this->category->name.' - DLL-CRDS');
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
    }
}
