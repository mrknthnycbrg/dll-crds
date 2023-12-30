<div>
    <x-slot name="header">
        <h1 class="text-4xl font-black text-gray-900">
            Resources
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-x-8 md:grid-cols-3">
            <div class="mb-8">
                <x-label for="year" value="Filter by Year" />
                <x-select class="mt-1 block w-full" id="year" wire:model.live.debounce="selectedYear"
                    :default="'All Years'" :options="range(today()->year, 2001)" />
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @forelse ($downloadables as $downloadable)
                <x-card href="{{ route('show-downloadable', ['slug' => $downloadable->slug]) }}" wire:navigate
                    wire:key="{{ $downloadable->id }}">
                    <h2 class="text-xl font-bold text-blue-800 group-hover:underline">
                        {{ $downloadable->name }}
                    </h2>
                    <p class="text-xs font-thin text-gray-700">
                        {{ $downloadable->formattedDate() }}
                    </p>
                </x-card>
            @empty
                <p class="text-xl font-bold text-gray-700">
                    No resources yet.
                </p>
            @endforelse
        </div>

        <div class="space-y-2 pt-8">
            {{ $downloadables->links() }}
        </div>
    </div>
</div>
