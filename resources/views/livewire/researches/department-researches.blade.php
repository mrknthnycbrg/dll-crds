@section('title')
    {{ 'Researches' }}
@endsection

<div>
    <x-slot name="header">
        <h1 class="text-3xl font-black text-gray-900">
            {{ 'Researches' }}
        </h1>
        <span
            class="my-2 inline-flex items-center gap-x-1.5 rounded-full border border-blue-900 px-3 py-1.5 text-xs font-medium text-blue-900">
            {{ $department->name }}
        </span>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        @foreach ($researches as $research)
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

        <div class="py-8">
            {{ $researches->links() }}
        </div>
    </div>
</div>
