<div>
    <x-slot name="header">
        <livewire:components.search />
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between space-y-2 py-8">
            <h1 class="text-3xl font-black text-gray-900">
                {{ 'Latest News' }}
            </h1>
            <a class="text-xl font-bold text-blue-900 hover:underline"
                href="{{ route('all-posts') }}" wire:navigate>
                {{ 'View all' }}
                <x-arrow-icon class="ml-1 inline-block h-6 w-6" />
            </a>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @if ($latestPost)
                <a class="group block space-y-2 rounded-md bg-gray-50 p-4 shadow-lg hover:bg-white md:col-span-2"
                    href="{{ route('show-post', ['slug' => $latestPost->slug]) }}"
                    wire:navigate wire:key="{{ $latestPost->id }}">
                    <span
                        class="inline-flex items-center gap-x-1.5 rounded-full border border-blue-900 px-3 py-1.5 text-xs font-medium text-blue-900">
                        {{ $latestPost->category->name }}
                    </span>
                    @if ($latestPost->image_path)
                        <img class="mx-auto h-auto w-full rounded-md object-contain"
                            src="{{ $latestPost->formattedImage() }}">
                    @endif
                    <h2
                        class="text-xl font-bold text-blue-900 group-hover:underline">
                        {{ $latestPost->title }}
                    </h2>
                    <p class="text-xs font-thin text-gray-700">
                        {{ $latestPost->formattedDate() }}
                    </p>
                    <p class="text-sm font-light text-gray-700">
                        {{ $latestPost->formattedContent() }}
                    </p>
                </a>
            @endif

            <div class="grid gap-8 md:col-span-1 md:grid-cols-1">
                @foreach ($otherPosts as $post)
                    <a class="group block space-y-2 rounded-md bg-gray-50 p-4 shadow-lg hover:bg-white"
                        href="{{ route('show-post', ['slug' => $post->slug]) }}"
                        wire:navigate wire:key="{{ $post->id }}">
                        <span
                            class="inline-flex items-center gap-x-1.5 rounded-full border border-blue-900 px-3 py-1.5 text-xs font-medium text-blue-900">
                            {{ $post->category->name }}
                        </span>
                        @if ($post->image_path)
                            <img class="mx-auto h-auto w-full rounded-md object-cover"
                                src="{{ $post->formattedImage() }}">
                        @endif
                        <h2
                            class="text-xl font-bold text-blue-900 group-hover:underline">
                            {{ $post->title }}
                        </h2>
                        <p class="text-xs font-thin text-gray-700">
                            {{ $post->formattedDate() }}
                        </p>
                        <p class="text-sm font-light text-gray-700">
                            {{ $post->formattedContent() }}
                        </p>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="flex items-center justify-between space-y-2 py-8">
            <h1 class="text-3xl font-black text-gray-900">
                {{ 'Latest Researches' }}
            </h1>
            <a class="text-xl font-bold text-blue-900 hover:underline"
                href="{{ route('all-researches') }}" wire:navigate>
                {{ 'View all' }}
                <x-arrow-icon class="ml-1 inline-block h-6 w-6" />
            </a>
        </div>

        <div class="grid grid-cols-1 gap-8">
            @foreach ($latestResearches as $research)
                <a class="group block space-y-2 rounded-md bg-gray-50 p-4 shadow-lg hover:bg-white"
                    href="{{ route('show-research', ['slug' => $research->slug]) }}"
                    wire:navigate wire:key="{{ $research->id }}">
                    <span
                        class="inline-flex items-center gap-x-1.5 rounded-full border border-blue-900 px-3 py-1.5 text-xs font-medium text-blue-900">
                        {{ $research->department->name }}
                    </span>
                    <h2
                        class="text-xl font-bold text-blue-900 group-hover:underline">
                        {{ $research->title }}</h2>
                    <p class="text-xs font-thin text-gray-700">
                        {{ $research->formattedDate() }}</p>
                    <p class="text-sm font-light text-gray-700">
                        {{ $research->formattedAbstract() }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</div>
