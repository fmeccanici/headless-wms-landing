<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Headless WMS</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/headless_wms.svg') }}">

    @livewireStyles
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.2/cdn.js" integrity="sha512-JCRiGqeZmFnnSl3E68K2QpL8Pwvp4PKAqekg41WWUfjqCnKJEv1DvZJdi76q/XFt6VzZ3V4bCE51NkDQ+dOJKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="https://cdn.redoc.ly/redoc/latest/bundles/redoc.standalone.js"> </script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fathom - beautiful, simple website analytics -->
    <script src="https://cdn.usefathom.com/script.js" data-site="IEDLEDUN" defer></script>
    <!-- / Fathom -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-S0G68P28RS"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-S0G68P28RS');
    </script>
</head>
<body
    x-data="{ showSignUpPopup: false }">

    <div id="app">
        <x-header></x-header>

        @yield('content')

        <div
            x-cloak
            x-transition:enter="duration-150 ease-out"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="duration-100 ease-in"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            x-show="showSignUpPopup"
            class="bg-orange-400 w-96 p-10 bottom-0 right-0 fixed text-white font-bold text-xl rounded-l mr-1 mb-1 w-full">
            <p>We are still in beta, please sign up for our <a href="/register/trial" class="text-black cursor-pointer underline underline-offset-1">free trial</a>.</p>
            <svg
                x-on:click="showSignUpPopup = false"
                xmlns="http://www.w3.org/2000/svg"
                class="h-14 w-14 absolute top-0 right-0 p-3 cursor-pointer text-black"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">

                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
        <x-footer></x-footer>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    @livewireScripts
</body>
</html>
