@section('title')
    {{ 'News' }}
@endsection

<div>
    <x-slot name="header">
        <h1 class="text-3xl font-black text-gray-900">
            {{ 'News' }}
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @foreach ($posts as $post)
                <a class="group mb-2 block p-4 hover:rounded-md hover:bg-white hover:shadow-lg"
                    href="/news/{{ $post->slug }}" wire:navigate
                    wire:key="{{ $post->id }}">
                    @if ($post->image_path)
                        <img class="mx-auto h-auto w-full rounded-md object-contain"
                            src="{{ $post->formattedImage() }}">
                    @endif
                    <h2
                        class="mb-2 text-lg font-extrabold text-gray-900 group-hover:text-blue-900 group-hover:underline">
                        {{ $post->title }}</h2>
                    <p class="mb-2 text-sm font-bold text-gray-900">
                        {{ $post->author }}</p>
                    <p class="mb-2 text-sm font-light text-gray-900">
                        {{ $post->formattedContent() }}
                    </p>
                    <p class="mb-2 text-sm font-extralight text-gray-900">
                        {{ $post->formattedDate() }}</p>
                </a>
            @endforeach
        </div>

        <div class="py-8">
            {{ $posts->links() }}
        </div>
    </div>
</div>
