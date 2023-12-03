@section('title')
    {{ 'Home' }}
@endsection

<div>
    <x-slot name="header">
        <livewire:components.search />
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between py-8">
            <h1 class="text-3xl font-black text-gray-900">
                {{ 'Latest News' }}
            </h1>

            <a class="mb-2 text-lg font-extrabold text-blue-900 hover:underline"
                href="{{ route('all-posts') }}" wire:navigate>
                {{ 'View all' }}
                <x-arrow-icon class="ml-1 inline-block h-6 w-6" />
            </a>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @foreach ($latestPosts as $post)
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
                    <p class="mb-2 text-sm font-medium text-gray-900">
                        {{ $post->category->name }}</p>
                    <p class="mb-2 text-sm font-light text-gray-900">
                        {{ $post->formattedContent() }}
                    </p>
                    <p class="mb-2 text-sm font-extralight text-gray-900">
                        {{ $post->formattedDate() }}</p>
                </a>
            @endforeach
        </div>

        <div class="flex items-center justify-between py-8">
            <h1 class="text-3xl font-black text-gray-900">
                {{ 'Latest Researches' }}
            </h1>

            <a class="mb-2 text-lg font-extrabold text-blue-900 hover:underline"
                href="{{ route('all-researches') }}" wire:navigate>
                {{ 'View all' }}
                <x-arrow-icon class="ml-1 inline-block h-6 w-6" />
            </a>
        </div>

        @foreach ($latestResearches as $research)
            <a class="group mb-2 block p-4 hover:rounded-md hover:bg-white hover:shadow-lg"
                href="/researches/{{ $research->slug }}" wire:navigate
                wire:key="{{ $research->id }}">
                <h2
                    class="mb-2 text-lg font-extrabold text-gray-900 group-hover:text-blue-900 group-hover:underline">
                    {{ $research->title }}</h2>
                <p class="mb-2 text-sm font-bold text-gray-900">
                    {{ $research->author }}</p>
                <p class="mb-2 text-sm font-medium text-gray-900">
                    {{ $research->department->name }}</p>
                <p class="mb-2 text-sm font-light text-gray-900">
                    {{ $research->formattedDate() }}</p>
                <p class="mb-2 text-sm font-extralight text-gray-900">
                    {{ $research->formattedAbstract() }}
                </p>
            </a>
        @endforeach
    </div>
</div>
