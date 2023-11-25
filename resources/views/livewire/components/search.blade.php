<div>
    <div class="flex justify-center py-8">
        <div class="w-full sm:w-full md:w-2/3 lg:w-1/3">
            <x-input class="block w-full" type="text"
                wire:model.live.debounce="search"
                placeholder="Find researches" />
        </div>
    </div>

    @if ($search)
        <div class="py-8">
            @if ($researches->count() > 0)
                <h1 class="text-3xl font-black text-gray-900">
                    {{ 'Researches' }}
                </h1>
            @else
                <h1 class="text-3xl font-black text-gray-900">
                    {{ 'Researches' }}
                </h1>
                <p class="text-lg font-extrabold text-gray-900">
                    {{ 'No results' }}
                </p>
            @endif
        </div>

        @foreach ($researches as $research)
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

        @if ($researches->count() > 0)
            <div class="py-8">
                {{ $researches->links() }}
            </div>
        @endif
    @endif
</div>
