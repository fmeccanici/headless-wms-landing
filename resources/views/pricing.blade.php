
@extends('layouts.app')
@section('content')
    <div
        class="bg-white">

        <div class="max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:flex-col sm:align-center">
                <h1 class="text-5xl font-extrabold text-gray-900 sm:text-center">Pricing Plans</h1>
                <p class="mt-5 text-xl text-gray-500 sm:text-center">Account plans differ based on the amount of orders you process per month </p>
            </div>
            <div class="mt-12 space-y-4 sm:mt-16 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-6 lg:max-w-4xl lg:mx-auto xl:max-w-none xl:mx-0 xl:grid-cols-3">
                <div class="border border-gray-200 rounded-lg shadow-sm divide-y divide-gray-200">
                    <div class="p-6">
                        <h2 class="text-lg leading-6 font-medium text-gray-900">Startup</h2>
                        <p class="mt-4 text-sm text-gray-500">Processing around 100 orders a day?</p>
                        <p class="mt-8">
                            <span class="text-4xl font-extrabold text-gray-900">$30</span>
                            <span class="text-base font-medium text-gray-500"> / month</span>
                        </p>
                        <p class="mt-3">
                            <span class="text-base font-medium text-gray-500"> + $0.25 per additional order</span>
                        </p>
                        <a
                            x-on:click="showSignUpPopup = true; window.fathom.trackGoal('OXIBLMGC', 0);"
                            href="#" class="mt-8 block w-full bg-orange-400 border border-transparent rounded-md py-2 text-sm font-semibold text-white text-center hover:bg-orange-200 hover:text-orange-400">Buy Startup</a>
                    </div>
                    <div class="pt-6 pb-8 px-6">
                        <h3 class="text-xs font-medium text-gray-900 tracking-wide uppercase">What's included</h3>
                        <ul role="list" class="mt-6 space-y-4">

                            <li class="flex space-x-3">
                                <!-- Heroicon name: solid/check -->
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-500">Includes 3000 orders a month</span>
                            </li>

                            <li class="flex space-x-3">
                                <!-- Heroicon name: solid/check -->
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-500">All Headless WMS features</span>
                            </li>

                            <li class="flex space-x-3">
                                <!-- Heroicon name: solid/check -->
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-500">Unlimited users and API keys</span>
                            </li>

                            <li class="flex space-x-3">
                                <!-- Heroicon name: solid/check -->
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-500">Free and unlimited support</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg shadow-sm divide-y divide-gray-200">
                    <div class="p-6">
                        <h2 class="text-lg leading-6 font-medium text-gray-900">Business</h2>
                        <p class="mt-4 text-sm text-gray-500">Processing around 500 orders a day?</p>
                        <p class="mt-8">
                            <span class="text-4xl font-extrabold text-gray-900">$100</span>
                            <span class="text-base font-medium text-gray-500"> / month</span>
                        </p>
                        <p class="mt-3">
                            <span class="text-base font-medium text-gray-500"> + $0.10 per additional order</span>
                        </p>
                        <a
                            x-on:click="showSignUpPopup = true; window.fathom.trackGoal('7ZJ4PTSV', 0);"
                            href="#" class="mt-8 block w-full bg-orange-400 border border-transparent rounded-md py-2 text-sm font-semibold text-white text-center hover:bg-orange-200 hover:text-orange-400">Buy Business</a>
                    </div>
                    <div class="pt-6 pb-8 px-6">
                        <h3 class="text-xs font-medium text-gray-900 tracking-wide uppercase">What's included</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li class="flex space-x-3">
                                <!-- Heroicon name: solid/check -->
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-500">Includes 15.000 orders a month</span>
                            </li>

                            <li class="flex space-x-3">
                                <!-- Heroicon name: solid/check -->
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-500">All Headless WMS features</span>
                            </li>

                            <li class="flex space-x-3">
                                <!-- Heroicon name: solid/check -->
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-500">Unlimited users and API keys</span>
                            </li>

                            <li class="flex space-x-3">
                                <!-- Heroicon name: solid/check -->
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-500">Free and unlimited support</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg shadow-sm divide-y divide-gray-200">
                    <div class="p-6">
                        <h2 class="text-lg leading-6 font-medium text-gray-900">Enterprise</h2>
                        <p class="mt-4 text-sm text-gray-500">Processing around 2500 orders a day?</p>
                        <p class="mt-8">
                            <span class="text-4xl font-extrabold text-gray-900">$500</span>
                            <span class="text-base font-medium text-gray-500"> / month</span>
                        </p>
                        <p class="mt-3">
                            <span class="text-base font-medium text-gray-500"> + $0.05 per additional order</span>
                        </p>
                        <a
                            x-on:click="showSignUpPopup = true; window.fathom.trackGoal('NTUBZKEA', 0);"
                            href="#" class="mt-8 block w-full bg-orange-400 border border-transparent rounded-md py-2 text-sm font-semibold text-white text-center hover:bg-orange-200 hover:text-orange-400">Buy Enterprise</a>
                    </div>
                    <div class="pt-6 pb-8 px-6">
                        <h3 class="text-xs font-medium text-gray-900 tracking-wide uppercase">What's included</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li class="flex space-x-3">
                                <!-- Heroicon name: solid/check -->
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-500">Includes 75.000 orders a month</span>
                            </li>

                            <li class="flex space-x-3">
                                <!-- Heroicon name: solid/check -->
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-500">All Headless WMS features</span>
                            </li>

                            <li class="flex space-x-3">
                                <!-- Heroicon name: solid/check -->
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-500">Unlimited users and API keys</span>
                            </li>

                            <li class="flex space-x-3">
                                <!-- Heroicon name: solid/check -->
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-500">Free and unlimited support</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
