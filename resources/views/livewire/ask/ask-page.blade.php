<div>
    <x-slot name="header">
        <h1 class="text-4xl font-black text-gray-900">
            Ask AI
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center">
            <form class="flex w-full items-center justify-center space-x-2" wire:submit="response">
                <x-input class="block w-full" type="text" placeholder="Enter a topic" required autofocus
                    wire:model="input" />
                <x-button wire:loading.attr="disabled">
                    Ask
                </x-button>
            </form>
            <div class="w-full p-8">
                {{ $output }}
            </div>
        </div>
    </div>
</div>
