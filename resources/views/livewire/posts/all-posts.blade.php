<div>
    <x-slot name="header">
        <h1 class="text-4xl font-black text-gray-900">
            News
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">

        @if (count($posts) > 0)
            <div class="grid grid-cols-1 gap-x-8 lg:grid-cols-3">
                <div class="mb-4">
                    <x-label for="category" value="Category" />
                    <x-select class="mt-1 block w-full" id="category" wire:model.live.debounce="selectedCategory"
                        :default="'All Categories'" :options="$categories->pluck('name', 'id')" />
                </div>

                <div class="mb-8">
                    <x-label for="year" value="Year" />
                    <x-select class="mt-1 block w-full" id="year" wire:model.live.debounce="selectedYear"
                        :default="'All Years'" :options="range(today()->year, 2001)" />
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            @forelse ($posts as $post)
                <x-card href="{{ route('show-post', ['slug' => $post->slug]) }}" wire:navigate
                    wire:key="{{ $post->id }}">
                    <x-badge>
                        {{ $post->category->name }}
                    </x-badge>
                    <h2 class="text-xl font-bold text-gray-700 group-hover:text-blue-800">
                        {{ $post->title }}
                    </h2>
                    <p class="text-xs font-thin text-gray-700">
                        {{ $post->formattedDate() }}
                    </p>
                    <p class="text-sm font-light text-gray-700">
                        {{ $post->formattedContent() }}
                    </p>
                    @if ($post->image_path)
                        <img class="mx-auto aspect-video w-full rounded-md object-cover"
                            src="{{ $post->formattedImage() }}" alt="{{ $post->title }}">
                    @endif
                </x-card>
            @empty
                <p class="text-xl font-bold text-gray-700">
                    No posts yet.
                </p>
            @endforelse
        </div>

        <div class="space-y-2 pt-8">
            {{ $posts->links() }}
        </div>
    </div>
</div>
