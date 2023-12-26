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
            <p class="inline-flex items-center gap-x-1.5 rounded-md border border-blue-900 px-3 py-1.5 text-xs font-medium text-blue-900 hover:bg-blue-900 hover:text-gray-100"
                href="{{ route('category-posts', ['slug' => $post->category->slug]) }}" role="button" wire:navigate>
                {{ $post->category->name }}
            </p>
        </div>

        <div class="grid gap-8 md:col-span-1 md:grid-cols-1">
            <div class="flex items-center justify-between">
                <h1 class="text-4xl font-black text-gray-900">
                    {{ 'Related News' }}
                </h1>
            </div>

            @forelse ($relatedPosts as $post)
                <a class="group block aspect-auto w-full space-y-2 rounded-md bg-gray-50 p-4 shadow-lg hover:bg-blue-50"
                    href="{{ route('show-post', ['slug' => $post->slug]) }}" wire:navigate
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
                </a>
            @empty
                <p class="text-xl font-bold text-gray-700">
                    {{ 'No related posts.' }}
                </p>
            @endforelse
        </div>
    </div>
</div>
