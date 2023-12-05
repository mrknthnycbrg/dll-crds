@section('title')
    {{ $post->title }}
@endsection

<div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-5 space-y-5 rounded-md bg-white p-5 shadow-lg">
        <h1 class="text-3xl font-black text-gray-900">
            {{ $post->title }}
        </h1>
        <p class="text-gray-900">
            <span class="font-extrabold">{{ $post->author }}</span>
            <span class="font-extralight">{{ $post->formattedDate() }}</span>
        </p>
        @if ($post->image_path)
            <img class="mx-auto h-auto w-full max-w-4xl rounded-md object-contain"
                src="{{ $post->formattedImage() }}">
        @endif
        <div class="prose max-w-none">
            {!! $post->content !!}
        </div>
        <span
            class="my-2 inline-flex items-center gap-x-1.5 rounded-full border border-blue-900 px-3 py-1.5 text-xs font-medium text-blue-900"
            href="/news/category/{{ $post->category->slug }}" role="button"
            wire:navigate>
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
            <a class="group my-2 block p-4 hover:rounded-md hover:bg-white hover:shadow-lg"
                href="/news/{{ $post->slug }}" wire:navigate
                wire:key="{{ $post->id }}">
                <span
                    class="my-2 inline-flex items-center gap-x-1.5 rounded-full border border-blue-900 px-3 py-1.5 text-xs font-medium text-blue-900">
                    {{ $post->category->name }}
                </span>
                @if ($post->image_path)
                    <img class="mx-auto h-auto w-full rounded-md object-contain"
                        src="{{ $post->formattedImage() }}">
                @endif
                <h2
                    class="my-2 text-lg font-extrabold text-gray-900 group-hover:text-blue-900 group-hover:underline">
                    {{ $post->title }}</h2>
                <p class="my-2 text-sm font-bold text-gray-900">
                    {{ $post->author }}</p>
                <p class="my-2 text-sm font-light text-gray-900">
                    {{ $post->formattedContent() }}
                </p>
                <p class="my-2 text-sm font-extralight text-gray-900">
                    {{ $post->formattedDate() }}</p>
            </a>
        @endforeach
    </div>
</div>
