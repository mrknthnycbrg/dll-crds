<div class="mx-auto max-w-full bg-white px-4 py-8 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
        <div class="max-w-full space-y-4 md:col-span-2">
            <h1 class="text-4xl font-black text-gray-900">
                {{ $post->title }}
            </h1>
            <p class="text-sm font-medium text-gray-700">
                {{ $post->formattedDate() }}
            </p>
            @if ($post->image_path)
                <img class="mx-auto aspect-video w-full rounded-md object-cover" src="{{ $post->formattedImage() }}"
                    alt="{{ $post->title }}">
            @endif
            <div class="prose max-w-none">
                {!! $post->content !!}
            </div>
            <x-badge class="hover:bg-blue-800 hover:text-white"
                href="{{ route('category-posts', ['slug' => $post->category->slug]) }}" role="button" wire:navigate>
                {{ $post->category->name }}
            </x-badge>
        </div>

        <div class="grid gap-8 md:col-span-1 md:grid-cols-1">
            <div class="flex items-center justify-between">
                <h1 class="text-4xl font-black text-gray-900">
                    Related News
                </h1>
            </div>

            @forelse ($relatedPosts as $post)
                <x-card href="{{ route('show-post', ['slug' => $post->slug]) }}" wire:navigate
                    wire:key="{{ $post->id }}">
                    @if ($post->image_path)
                        <img class="mx-auto aspect-video w-full rounded-md object-cover"
                            src="{{ $post->formattedImage() }}" alt="{{ $post->title }}">
                    @endif
                    <x-badge>
                        {{ $post->category->name }}
                    </x-badge>
                    <h2 class="text-xl font-bold text-blue-800 group-hover:underline">
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
    </div>
</div>
