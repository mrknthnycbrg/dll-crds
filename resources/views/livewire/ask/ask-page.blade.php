<div>
    <x-slot name="header">
        <h1 class="text-4xl font-black text-gray-900">
            Ask AI
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center">
            <form class="flex w-full items-center justify-center space-x-2" wire:submit.prevent="response">
                <x-input class="block w-full" type="text" required autofocus wire:model="input"
                    placeholder="Ask a question" />
                <x-button>
                    Ask
                </x-button>
            </form>
            <textarea class="mt-4 block h-40 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-900 focus:ring-blue-900"
                readonly wire:model="output">
            </textarea>
        </div>
    </div>
</div>
