@section('title')
    {{ 'Researches' }}
@endsection

<div>
    <x-slot name="header">
        <h1 class="text-3xl font-black text-gray-900">
            {{ 'Researches' }}
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
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

        <div class="py-8">
            {{ $researches->links() }}
        </div>
    </div>
</div>
