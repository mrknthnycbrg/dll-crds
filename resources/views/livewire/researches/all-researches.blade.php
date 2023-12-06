<div>
    <x-slot name="header">
        <h1 class="text-3xl font-black text-gray-900">
            {{ 'Researches' }}
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8">
            @foreach ($researches as $research)
                <a class="group block space-y-2 rounded-md bg-gray-50 p-4 shadow-lg hover:bg-white"
                    href="{{ route('show-research', ['slug' => $research->slug]) }}"
                    wire:navigate wire:key="{{ $research->id }}">
                    <span
                        class="inline-flex items-center gap-x-1.5 rounded-full border border-blue-900 px-3 py-1.5 text-xs font-medium text-blue-900">
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

        <div class="py-8">
            {{ $researches->links() }}
        </div>
    </div>
</div>
