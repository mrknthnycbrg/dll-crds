@section('title')
    {{ $downloadable->name }}
@endsection

<div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-5 space-y-5 rounded-md bg-white p-5 shadow-lg">
        <h1 class="text-3xl font-black text-gray-900">
            {{ $downloadable->name }}
        </h1>
        <div class="prose max-w-none">
            {!! $downloadable->description !!}
        </div>
        <x-button wire:click="download">
            {{ 'Download File' }}
        </x-button>
    </div>
</div>
