<div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
    <div
        class="mx-auto mb-5 max-w-4xl space-y-4 rounded-md bg-white p-5 shadow-lg">
        <h1 class="text-3xl font-black text-gray-900">
            {{ $downloadable->name }}
        </h1>
        <p class="text-sm font-medium text-gray-700">
            {{ $downloadable->formattedDate() }}</p>
        <p class="text-base text-gray-700">
            {{ $downloadable->description }}
        </p>
        <x-button wire:click="download">
            {{ 'Download File' }}
        </x-button>
    </div>
</div>
