<div>
    <x-slot name="header">
        <h1 class="text-3xl font-black text-gray-900">
            {{ 'News' }}
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @foreach ($posts as $post)
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

        <div class="space-y-2 py-8">
            {{ $posts->links() }}
        </div>
    </div>
</div>
