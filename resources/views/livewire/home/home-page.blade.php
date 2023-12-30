<div>
    <x-slot name="header">
        <livewire:components.search />
    </x-slot>

    <div class="mx-auto max-w-full px-4 pb-8 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between space-y-2 py-8">
            <h1 class="text-4xl font-black text-gray-900">
                Latest News
            </h1>
            <a class="text-xl font-bold text-blue-800 hover:underline" href="{{ route('all-posts') }}" wire:navigate>
                View all
                <x-arrow-icon class="size-6 ml-1 inline-block" />
            </a>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @forelse ($latestPosts as $post)
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
                    No posts yet.
                </p>
            @endforelse
        </div>

        <div class="flex items-center justify-between space-y-2 py-8">
            <h1 class="text-4xl font-black text-gray-900">
                Latest Researches
            </h1>
            <a class="text-xl font-bold text-blue-800 hover:underline" href="{{ route('all-researches') }}"
                wire:navigate>
                View all
                <x-arrow-icon class="size-6 ml-1 inline-block" />
            </a>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @forelse ($latestResearches as $research)
                <x-card href="{{ route('show-research', ['slug' => $research->slug]) }}" wire:navigate
                    wire:key="{{ $research->id }}">
                    <x-badge>
                        {{ $research->department->name }}
                    </x-badge>
                    <h2 class="text-xl font-bold text-blue-800 group-hover:underline">
                        {{ $research->title }}
                    </h2>
                    <p class="text-base font-medium text-gray-700">
                        {{ $research->author }}
                    </p>
                    <p class="text-xs font-thin text-gray-700">
                        {{ $research->formattedDate() }}
                    </p>
                    <p class="text-sm font-light text-gray-700">
                        {{ $research->formattedAbstract() }}
                    </p>
                </x-card>
            @empty
                <p class="text-xl font-bold text-gray-700">
                    No researches yet.
                </p>
            @endforelse
        </div>
    </div>
</div>
