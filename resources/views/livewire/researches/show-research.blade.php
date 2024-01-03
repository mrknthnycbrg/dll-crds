<div class="mx-auto max-w-full bg-white px-4 py-8 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <div class="max-w-full space-y-4 lg:col-span-2">
            <h1 class="text-4xl font-black text-gray-900">
                {{ $research->title }}
            </h1>
            <p class="text-base text-gray-700">
                <span class="font-extrabold text-gray-900">
                    Department:
                </span>
                {{ $research->department->name }}
            </p>
            <p class="text-base text-gray-700">
                <span class="font-extrabold text-gray-900">
                    Adviser:
                </span>
                {{ $research->adviser }}
            </p>
            <p class="text-base text-gray-700">
                <span class="font-extrabold text-gray-900">
                    Date Submitted:
                </span>
                {{ $research->formattedDAte() }}
            </p>
            <p class="text-base text-gray-700">
                <span class="font-extrabold text-gray-900">
                    Authors:
                </span>
                {{ $research->author }}
            </p>
            <p class="text-base text-gray-700">
                <span class="font-extrabold text-gray-900">
                    Keywords:
                </span>
                {{ $research->keyword }}
            </p>
            <p class="text-base font-extrabold text-gray-900">
                Abstract:
            </p>
            <p class="text-base text-gray-700">
                {{ $research->abstract }}
            </p>
            @if ($research->pdf_path)
                <x-button wire:click="view">
                    View
                </x-button>
            @endif
        </div>

        <div class="grid gap-8 lg:col-span-1 lg:grid-cols-1">
            <div class="space-y-2">
                <h1 class="text-4xl font-black text-gray-900">
                    Related Researches
                </h1>

                <x-badge class="hover:bg-blue-800 hover:text-white"
                    href="{{ route('department-researches', ['slug' => $research->department->slug]) }}" role="button"
                    wire:navigate>
                    {{ $research->department->name }}
                </x-badge>
            </div>

            @forelse ($relatedResearches as $research)
                <x-card href="{{ route('show-research', ['slug' => $research->slug]) }}" wire:navigate
                    wire:key="{{ $research->id }}">
                    <x-badge>
                        {{ $research->department->name }}
                    </x-badge>
                    <h2 class="text-xl font-bold text-gray-700 group-hover:text-blue-800">
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
                    No related researches.
                </p>
            @endforelse
        </div>
    </div>
</div>
