@section('title')
    {{ $research->title }}
@endsection

<div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
    <article class="mb-5 space-y-5 rounded-md bg-white p-5 shadow-lg">
        <header>
            <h1 class="text-3xl font-black text-gray-900">
                {{ $research->title }}
            </h1>
        </header>

        <p class="text-gray-900">
            <span class="font-extrabold">{{ 'Author(s):' }}</span>
            {{ $research->author }}
        </p>
        <p class="text-gray-900">
            <span class="font-extrabold">{{ 'Date Submitted:' }}</span>
            {{ $research->formattedDAte() }}
        </p>
        <p class="text-gray-900">
            <span class="font-extrabold">{{ 'Department:' }}</span>
            {{ $research->department->name }}
        </p>
        <p class="text-gray-900">
            <span class="font-extrabold">{{ 'Adviser:' }}</span>
            {{ $research->adviser }}
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
                {{ 'View PDF' }}
            </x-button>
        @endif
    </article>
</div>
