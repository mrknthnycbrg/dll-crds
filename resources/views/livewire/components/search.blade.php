<div>
    <div class="flex justify-center">
        <div
            class="relative flex w-full items-center sm:w-full md:w-2/3 lg:w-1/3">
            <x-input class="block w-full pl-10 placeholder-gray-500"
                type="text" wire:model.live.debounce="search"
                placeholder="Explore researches" />
            <div
                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <x-search-icon class="block h-6 w-auto text-gray-500" />
            </div>
        </div>
    </div>

    @if ($search)
        <div class="space-y-2 py-8">
            @if ($researches->count() > 0)
                <h1 class="text-3xl font-black text-gray-900">
                    {{ 'Search Results' }}
                </h1>
            @else
                <h1 class="text-3xl font-black text-gray-900">
                    {{ 'Search Results' }}
                </h1>
                <p class="text-xl font-bold text-gray-700">
                    {{ 'No results' }}
                </p>
            @endif
        </div>

        <div class="grid grid-cols-1 gap-8">
            @foreach ($researches as $research)
                <a class="group block aspect-auto w-full space-y-2 rounded-md bg-gray-50 p-4 shadow-lg hover:bg-white"
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

        <div class="space-y-2 py-8">
            {{ $researches->links() }}
        </div>
    @endif
</div>
