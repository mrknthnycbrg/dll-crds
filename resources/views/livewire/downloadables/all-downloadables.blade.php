@section('title')
    {{ 'Resources' }}
@endsection

<div>
    <x-slot name="header">
        <h1 class="text-3xl font-black text-gray-900">
            {{ 'Resources' }}
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @foreach ($downloadables as $downloadable)
                <a class="group mb-2 block p-4 hover:rounded-md hover:bg-white hover:shadow-lg"
                    role="button" wire:click="download({{ $downloadable->id }})"
                    wire:key="{{ $downloadable->id }}">
                    <h2
                        class="mb-2 text-lg font-extrabold text-gray-900 group-hover:text-blue-900 group-hover:underline">
                        {{ $downloadable->name }}
                    </h2>
                    <p class="mb-2 text-sm font-extralight text-gray-900">
                        {{ $downloadable->formattedDate() }}</p>
                </a>
            @endforeach
        </div>

        <div class="py-8">
            {{ $downloadables->links() }}
        </div>
    </div>
</div>
