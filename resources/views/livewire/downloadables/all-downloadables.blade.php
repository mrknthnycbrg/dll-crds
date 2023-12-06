<div>
    <x-slot name="header">
        <h1 class="text-3xl font-black text-gray-900">
            {{ 'Resources' }}
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @foreach ($downloadables as $downloadable)
                <a class="group block space-y-2 rounded-md bg-gray-50 p-4 shadow-lg hover:bg-white"
                    href="{{ route('show-downloadable', ['slug' => $downloadable->slug]) }}"
                    wire:navigate wire:key="{{ $downloadable->id }}">
                    <h2
                        class="text-xl font-bold text-blue-900 group-hover:underline">
                        {{ $downloadable->name }}
                    </h2>
                    <p class="text-xs font-thin text-gray-700">
                        {{ $downloadable->formattedDate() }}</p>
                </a>
            @endforeach
        </div>

        <div class="space-y-2 py-8">
            {{ $downloadables->links() }}
        </div>
    </div>
</div>
