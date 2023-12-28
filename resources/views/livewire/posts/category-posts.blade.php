<div>
    <x-slot name="header">
        <h1 class="text-4xl font-black text-gray-900">
            News
        </h1>
        <p
            class="inline-flex items-center gap-x-1.5 rounded-md border border-blue-900 px-3 py-1.5 text-xs font-medium text-blue-900">
            {{ $category->name }}
        </p>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-x-8 md:grid-cols-3">
            <div class="mb-8">
                <x-label for="year" value="Filter by Year" />
                <x-select class="mt-1 block w-full" id="year" wire:model.live.debounce="selectedYear">
                    <option value="0">All Years</option>
                    @for ($year = today()->year; $year >= 2001; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </x-select>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @forelse ($posts as $post)
                <x-card href="{{ route('show-post', ['slug' => $post->slug]) }}" wire:navigate
                    wire:key="{{ $post->id }}">
                    @if ($post->image_path)
                        <img class="mx-auto aspect-video w-full rounded-md object-cover"
                            src="{{ $post->formattedImage() }}" alt="{{ $post->title }}">
                    @endif
                    <p
                        class="inline-flex items-center gap-x-1.5 rounded-md border border-blue-900 px-3 py-1.5 text-xs font-medium text-blue-900">
                        {{ $post->category->name }}
                    </p>
                    <h2 class="text-xl font-bold text-blue-900 group-hover:underline">
                        {{ $post->title }}
                    </h2>
                    <p class="text-xs font-thin text-gray-700">
                        {{ $post->formattedDate() }}
                    </p>
                    <p class="text-sm font-light text-gray-700">
                        {{ $post->formattedContent() }}
                    </p>
                </x-card>
            @empty
                <p class="text-xl font-bold text-gray-700">
                    No related posts.
                </p>
            @endforelse
        </div>

        <div class="space-y-2 pt-8">
            {{ $posts->links() }}
        </div>
    </div>
</div>
