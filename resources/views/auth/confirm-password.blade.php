<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-application-logo class="block h-28 w-auto" />
        </x-slot>

        <div class="mb-4 text-sm text-gray-700">
            {{ 'This is a secure area of the application. Please confirm your password before continuing.' }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-label for="password" value="{{ 'Password' }}" />
                <x-input class="mt-1 block w-full" id="password" name="password" type="password" required
                    autocomplete="current-password" autofocus />
            </div>

            <div class="mt-4 flex justify-end">
                <x-button class="ml-4">
                    {{ 'Confirm' }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
