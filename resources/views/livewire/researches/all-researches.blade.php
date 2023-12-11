<div>
    <x-slot name="header">
        <h1 class="text-4xl font-black text-gray-900">
            {{ 'Researches' }}
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-x-8 md:grid-cols-3">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700"
                    for="department">{{ 'Filter by Department' }}</label>
                <select
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-900 focus:ring-blue-900"
                    id="department" wire:model.live.debounce="selectedDepartment">
                    <option value="0" selected>{{ 'All Departments' }}</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

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
            @forelse ($researches as $research)
                <a class="group block aspect-auto w-full space-y-2 rounded-md bg-gray-50 p-4 shadow-lg hover:bg-blue-50"
                    href="{{ route('show-research', ['slug' => $research->slug]) }}" wire:navigate
                    wire:key="{{ $research->id }}">
                    <p
                        class="inline-flex items-center gap-x-1.5 rounded-md border border-blue-900 px-3 py-1.5 text-xs font-medium text-blue-900">
                        {{ $research->department->name }}
                    </p>
                    <h2 class="text-xl font-bold text-blue-900 group-hover:underline">
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
                </a>
            @empty
                <p class="text-xl font-bold text-gray-700">
                    {{ 'No researches yet.' }}
                </p>
            @endforelse
        </div>

        <div class="space-y-2 pt-8">
            {{ $researches->links() }}
        </div>
    </div>
</div>
