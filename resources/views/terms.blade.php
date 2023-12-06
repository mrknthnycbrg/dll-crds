<x-guest-layout>
    <div class="mt-6">
        <div class="flex min-h-screen flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-application-logo class="block h-28 w-auto" />
            </div>

            <div
                class="prose mt-6 w-full overflow-hidden bg-white p-6 shadow-md sm:rounded-lg">
                {!! $terms !!}
            </div>
        </div>
    </div>
</x-guest-layout>
