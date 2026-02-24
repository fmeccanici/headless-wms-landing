
@extends('layouts.app')
@section('content')
    <main
        class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
        <div class="sm:text-center lg:text-left">
            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block xl:inline">The world's first headless </span>
                <span class="block text-orange-400 xl:inline">warehouse management system</span>
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2">
                <div>
                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">Headless WMS provides a warehouse management system that is API driven. This has the advantage that we can completely focus on making the API as extensive and developer friendly as possible, so you can integrate it easily with your existing software.</p>
                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">Since we are currently still in beta, we provide a temporary free trial period for you. Try it now for free!</p>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        <div class="rounded-md shadow">
                            <button
                                x-on:click="showSignUpPopup = true; window.fathom.trackGoal('6ZNKMQ4W', 0);"
                                class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange-400 hover:bg-orange-200 hover:text-orange-400 md:py-4 md:text-lg md:px-10">
                                Sign up
                            </button>
                        </div>
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <a
                                onclick="window.fathom.trackGoal('8N4RJ1K6', 0);"
                                href="{{ route('trial') }}"
                                class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-black hover:bg-orange-200 hover:text-orange-400 md:py-4 md:text-lg md:px-10"> Try now for free </a>
                        </div>
                    </div>
                </div>
                <img class="object-scale-down md:p-16 pt-16" src="/images/landing_page_main_image.png" alt="">
            </div>

        </div>

        <features></features>
    </main>
@endsection
