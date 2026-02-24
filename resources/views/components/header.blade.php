<header
    x-data="{ open : false }">
    <div class="relative bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
                <div class="flex justify-start lg:w-0 lg:flex-1">
                    <a href="{{ route('home') }}">
                        <img class="h-20 w-auto sm:h-16 hover:scale-110 transform ease-in-out duration-500" src="{{ asset('images/headless_wms.svg') }}" alt="Headless WMS">
                    </a>
                </div>
                <div class="-mr-2 -my-2 md:hidden">
                    <button
                        x-on:click="open = true"
                        type="button"
                        class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                        aria-expanded="false">

                        <span class="sr-only">Open menu</span>
                        <!-- Heroicon name: outline/menu -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                <nav class="hidden md:flex space-x-10">
                    <a href="{{ route('home') }}" class="text-base font-medium hover:text-orange-400 transition ease-in-out"> Home </a>
                    <a href="{{ route('pricing') }}" class="text-base font-medium hover:text-orange-400 transition ease-in-out"> Pricing </a>
                    <a href="{{ route('docs') }}" class="text-base font-medium hover:text-orange-400 transition ease-in-out"> Docs </a>
                    <a href="{{ route('features') }}" class="text-base font-medium hover:text-orange-400 transition ease-in-out"> Features </a>
                </nav>
                <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
                    <a
                        x-on:click="showSignUpPopup = true; window.fathom.trackGoal('6ZNKMQ4W', 0);"
                        href="#" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-orange-400 hover:bg-orange-200 hover:text-orange-400">
                        Sign up
                    </a>
                    <a
                        onclick="window.fathom.trackGoal('8N4RJ1K6', 0);"
                        href="{{ route('trial') }}"
                        class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-black hover:bg-orange-200 hover:text-orange-400"> Try now for free </a>
                </div>
            </div>
        </div>

        <!--
          Mobile menu, show/hide based on mobile menu state.

          Entering: "duration-200 ease-out"
            From: "opacity-0 scale-95"
            To: "opacity-100 scale-100"
          Leaving: "duration-100 ease-in"
            From: "opacity-100 scale-100"
            To: "opacity-0 scale-95"
        -->
        <div
             x-cloak
             x-show="open"
             class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden"
             x-on:click.away="open = false"
             x-transition:enter="duration-150 ease-out"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="duration-100 ease-in"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
                <div class="pt-5 pb-6 px-5">
                    <div class="flex items-center justify-between">
                        <div class="flex">
                            <img class="h-10 w-auto" src="{{ asset('images/headless_wms.svg') }}" alt="Workflow">
                        </div>
                        <div class="-mr-2">
                            <button
                                type="button"
                                class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                                x-on:click="open = false">
                                <span class="sr-only">Close menu</span>
                                <!-- Heroicon name: outline/x -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="py-6 px-5 space-y-6">
                    <div class="grid grid-cols-2 gap-y-4 gap-x-8">
                        <a href="{{ route('home') }}" class="text-base font-medium text-gray-900 hover:text-gray-700"> Home </a>
                        <a href="{{ route('pricing') }}" class="text-base font-medium text-gray-900 hover:text-gray-700"> Pricing </a>
                        <a href="{{ route('docs') }}" class="text-base font-medium text-gray-900 hover:text-gray-700"> Docs </a>
                        <a href="{{ route('features') }}" class="text-base font-medium text-gray-900 hover:text-gray-700"> Features </a>
                    </div>
                    <div>
                        <a
                            x-on:click="showSignUpPopup = true; window.fathom.trackGoal('6ZNKMQ4W', 0);"
                            href="#"
                            class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium bg-orange-400 text-white hover:bg-orange-200 hover:text-orange-400">
                            Sign up
                        </a>
                    </div>
                    <div>
                        <a
                            onclick="window.fathom.trackGoal('8N4RJ1K6', 0);"
                            href="{{ route('trial') }}"
                            class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-black hover:bg-orange-200 hover:text-orange-400"> Try now for free </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
