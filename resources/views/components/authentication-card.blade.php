<div class="flex min-h-screen flex-col items-center p-8 sm:justify-center">
    <div>
        {{ $logo }}
    </div>

    <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-md">
        {{ $slot }}
    </div>
</div>
