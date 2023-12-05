@section('title')
    {{ $research->title }}
@endsection

<div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-5 space-y-5 rounded-md bg-white p-5 shadow-lg">
        <h1 class="text-3xl font-black text-gray-900">
            {{ $research->title }}
        </h1>
        <p class="text-gray-900">
            <span class="font-extrabold">{{ 'Department:' }}</span>
            <span
                class="my-2 inline-flex items-center gap-x-1.5 rounded-full border border-blue-900 px-3 py-1.5 text-xs font-medium text-blue-900"
                href="/researches/department/{{ $research->department->slug }}"
                role="button" wire:navigate>
                {{ $research->department->name }}
            </span>
        </p>
        <p class="text-gray-900">
            <span class="font-extrabold">{{ 'Adviser:' }}</span>
            {{ $research->adviser }}
        </p>
        <p class="text-gray-900">
            <span class="font-extrabold">{{ 'Date Submitted:' }}</span>
            {{ $research->formattedDAte() }}
        </p>
        <p class="text-gray-900">
            <span class="font-extrabold">{{ 'Author(s):' }}</span>
            {{ $research->author }}
        </p>
        <p class="text-gray-900">
            <span class="font-extrabold">{{ 'Keyword(s):' }}</span>
            {{ $research->keyword }}
        </p>
        <p class="font-extrabold text-gray-900">{{ 'Abstract:' }}</p>
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

    @foreach ($relatedResearches as $research)
        <a class="group my-2 block p-4 hover:rounded-md hover:bg-white hover:shadow-lg"
            href="/researches/{{ $research->slug }}" wire:navigate
            wire:key="{{ $research->id }}">
            <span
                class="my-2 inline-flex items-center gap-x-1.5 rounded-full border border-blue-900 px-3 py-1.5 text-xs font-medium text-blue-900">
                {{ $research->department->name }}
            </span>
            <h2
                class="my-2 text-lg font-extrabold text-gray-900 group-hover:text-blue-900 group-hover:underline">
                {{ $research->title }}</h2>
            <p class="my-2 text-sm font-bold text-gray-900">
                {{ $research->author }}</p>
            <p class="my-2 text-sm font-light text-gray-900">
                {{ $research->formattedDate() }}</p>
            <p class="my-2 text-sm font-extralight text-gray-900">
                {{ $research->formattedAbstract() }}
            </p>
        </a>
    @endforeach
</div>
