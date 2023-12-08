<div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
    <div
        class="mx-auto mb-5 max-w-4xl space-y-4 rounded-md bg-white p-5 shadow-lg">
        <h1 class="text-3xl font-black text-gray-900">
            {{ $post->title }}
        </h1>
        <p class="text-sm font-medium text-gray-700">
            {{ $post->formattedDate() }}</p>
        @if ($post->image_path)
            <img class="mx-auto aspect-video w-full rounded-md object-cover"
                src="{{ $post->formattedImage() }}">
        @endif
        <div class="prose max-w-none">
            {!! $post->content !!}
        </div>
        <span
            class="inline-flex items-center gap-x-1.5 rounded-full border border-blue-900 px-3 py-1.5 text-xs font-medium text-blue-900 hover:bg-blue-900 hover:text-gray-100"
            href="{{ route('category-posts', ['slug' => $post->category->slug]) }}"
            role="button" wire:navigate>
            {{ $post->category->name }}
        </span>
    </div>

    <div class="flex items-center justify-between py-8">
        <h1 class="text-3xl font-black text-gray-900">
            {{ 'Related News' }}
        </h1>
    </div>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
        @foreach ($relatedPosts as $post)
            <a class="group block aspect-auto w-full space-y-2 rounded-md bg-gray-50 p-4 shadow-lg hover:bg-white"
                href="{{ route('show-post', ['slug' => $post->slug]) }}"
                wire:navigate wire:key="{{ $post->id }}">
                @if ($post->image_path)
                    <img class="mx-auto aspect-video w-full rounded-md object-cover"
                        src="{{ $post->formattedImage() }}">
                @endif
                <span
                    class="inline-flex items-center gap-x-1.5 rounded-full border border-blue-900 px-3 py-1.5 text-xs font-medium text-blue-900">
                    {{ $post->category->name }}
                </span>
                <h2
                    class="text-xl font-bold text-blue-900 group-hover:underline">
                    {{ $post->title }}</h2>
                <p class="text-xs font-thin text-gray-700">
                    {{ $post->formattedDate() }}</p>
                <p class="text-sm font-light text-gray-700">
                    {{ $post->formattedContent() }}
                </p>
            </a>
        @endforeach
    </div>
</div>
