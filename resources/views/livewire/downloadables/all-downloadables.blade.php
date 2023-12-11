<div>
    <x-slot name="header">
        <h1 class="text-4xl font-black text-gray-900">
            {{ 'Resources' }}
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-x-8 md:grid-cols-3">
            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-700" for="year">{{ 'Filter by Year' }}</label>
                <select
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-900 focus:ring-blue-900"
                    id="year" wire:model.live.debounce="selectedYear">
                    <option value="0" selected>{{ 'All Years' }}</option>
                    @for ($year = today()->year; $year >= 2001; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @forelse ($downloadables as $downloadable)
                <a class="group block aspect-auto w-full space-y-2 rounded-md bg-gray-50 p-4 shadow-lg hover:bg-blue-50"
                    href="{{ route('show-downloadable', ['slug' => $downloadable->slug]) }}" wire:navigate
                    wire:key="{{ $downloadable->id }}">
                    <h2 class="text-xl font-bold text-blue-900 group-hover:underline">
                        {{ $downloadable->name }}
                    </h2>
                    <p class="text-xs font-thin text-gray-700">
                        {{ $downloadable->formattedDate() }}
                    </p>
                </a>
            @empty
                <p class="text-xl font-bold text-gray-700">
                    {{ 'No resources yet.' }}
                </p>
            @endforelse
        </div>

        <div class="space-y-2 pt-8">
            {{ $downloadables->links() }}
        </div>
    </div>
</div>
