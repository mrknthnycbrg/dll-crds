<div>
    <div class="mx-auto max-w-full bg-white px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <!-- Logo -->
            <div class="flex shrink-0 items-center">
                <a class="group flex items-center space-x-2" href="{{ route('welcome') }}" wire:navigate>
                    <x-application-logo class="size-10 block" />
                    <span class="text-xl font-black text-black group-hover:text-blue-800 group-focus:text-blue-800">
                        DLL-CRDS
                    </span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="flex space-x-8 sm:-my-px sm:ms-10">
                @auth
                    <x-nav-link href="{{ route('home') }}" wire:navigate :active="request()->routeIs('home')">
                        Home
                    </x-nav-link>
                @else
                    <x-nav-link href="{{ route('login') }}" wire:navigate :active="request()->routeIs('login')">
                        Log In
                    </x-nav-link>
                @endauth
            </div>
        </div>
    </div>
    <div class="mx-auto max-w-full space-y-8 bg-blue-800 px-4 py-32 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="block text-5xl font-black text-yellow-400 sm:text-6xl md:text-7xl lg:text-8xl">
                College Research and Development Services
            </h1>
        </div>

        <div class="text-center">
            <p class="block text-2xl font-bold text-gray-100 sm:text-3xl md:text-4xl lg:text-5xl">
                Dalubhasaan ng Lungsod ng Lucena
            </p>
        </div>

        <div class="text-center">
            <p class="block text-base font-medium text-gray-100 sm:text-lg md:text-xl lg:text-2xl">
                Welcome to the DLL-CRDS Research Repository, providing free access to research papers by Dalubcenians,
                for
                Dalubcenians.
            </p>
        </div>
    </div>
    <div class="mx-auto max-w-full px-4 py-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <p class="text-base text-gray-700">
                &copy; {{ date('Y') }} DLL-CRDS
            </p>
        </div>
    </div>
</div>
