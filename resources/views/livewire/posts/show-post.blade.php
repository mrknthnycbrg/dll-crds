@section('title')
    {{ $post->title }}
@endsection

<div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
    <article class="mb-5 space-y-5 rounded-md bg-white p-5 shadow-lg">
        <header class="space-y-5">
            <h1 class="text-3xl font-black text-gray-900">
                {{ $post->title }}
            </h1>
            <p class="text-gray-900">
                <span class="font-extrabold">{{ $post->author }}</span>
                <span class="font-extralight">{{ $post->formattedDate() }}</span>
            </p>
        </header>

        @if ($post->image_path)
            <img class="mx-auto h-auto w-full max-w-4xl rounded-md object-contain"
                src="{{ $post->formattedImage() }}">
        @endif

        <div class="prose max-w-none">
            {!! $post->content !!}
        </div>
        <p class="text-gray-900">
            <span class="font-extrabold">{{ 'Topic(s):' }}</span>
            {{ $post->topic }}
        </p>
    </article>
</div>
