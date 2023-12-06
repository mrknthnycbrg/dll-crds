<div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-5 space-y-4 rounded-md bg-white p-5 shadow-lg">
        <h1 class="text-3xl font-black text-gray-900">
            {{ $research->title }}
        </h1>
        <span class="font-extrabold text-gray-900">{{ 'Department:' }}</span>
        <span
            class="inline-flex items-center gap-x-1.5 rounded-full border border-blue-900 px-3 py-1.5 text-xs text-blue-900 hover:bg-blue-900 hover:text-gray-100"
            href="{{ route('department-researches', ['slug' => $research->department->slug]) }}"
            role="button" wire:navigate>
            {{ $research->department->name }}
        </span>
        <p class="text-base text-gray-700">
            <span class="font-extrabold text-gray-900">{{ 'Adviser:' }}</span>
            {{ $research->adviser }}
        </p>
        <p class="text-base text-gray-700">
            <span
                class="font-extrabold text-gray-900">{{ 'Date Submitted:' }}</span>
            {{ $research->formattedDAte() }}
        </p>
        <p class="text-base text-gray-700">
            <span
                class="font-extrabold text-gray-900">{{ 'Author(s):' }}</span>
            {{ $research->author }}
        </p>
        <p class="text-base text-gray-700">
            <span
                class="font-extrabold text-gray-900">{{ 'Keyword(s):' }}</span>
            {{ $research->keyword }}
        </p>
        <p class="text-base font-extrabold text-gray-900">{{ 'Abstract:' }}
        </p>
        <div class="prose max-w-none">
            {!! $research->abstract !!}
        </div>
        @if ($research->pdf_path)
            <x-button wire:click="view">
                {{ 'View' }}
            </x-button>
        @endif
    </div>

    <div class="flex items-center justify-between py-8">
        <h1 class="text-3xl font-black text-gray-900">
            {{ 'Related Researches' }}
        </h1>
    </div>

    <div class="grid grid-cols-1 gap-8">
        @foreach ($relatedResearches as $research)
            <a class="group block space-y-2 rounded-md bg-gray-50 p-4 shadow-lg hover:bg-white"
                href="{{ route('show-research', ['slug' => $research->slug]) }}"
                wire:navigate wire:key="{{ $research->id }}">
                <span
                    class="inline-flex items-center gap-x-1.5 rounded-full border border-blue-900 px-3 py-1.5 text-xs text-blue-900">
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
