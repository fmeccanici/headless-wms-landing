
@extends('layouts.app')
@section('content')
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <img class="mx-auto h-12 w-auto" src="/images/headless_wms.svg" alt="Headless WMS">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Free 14-day trial</h2>
            </div>
            <form class="mt-8 space-y-6" action="{{ route('create-user') }}" method="POST">
                <input type="hidden" name="remember" value="true">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="name" class="sr-only">Name</label>
                        <input onclick="window.fathom.trackGoal('4B94NMZY', 0);" id="name" name="name" type="text" autocomplete="name" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-headless-wms-orange-400 focus:border-headless-wms-orange-400 focus:z-10 sm:text-sm" placeholder="Name">

                        @error('name')
                            <div class="text-red-600 text-sm p-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="company" class="sr-only">Company</label>
                        <input onclick="window.fathom.trackGoal('4B94NMZY', 0);" id="company" name="company" type="text" autocomplete="company" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-headless-wms-orange-400 focus:border-headless-wms-orange-400 focus:z-10 sm:text-sm" placeholder="Company">

                        @error('company')
                            <div class="text-red-600 text-sm p-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input onclick="window.fathom.trackGoal('4B94NMZY', 0);" id="email" name="email" type="email" autocomplete="email" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-headless-wms-orange-400 focus:border-headless-wms-orange-400 focus:z-10 sm:text-sm" placeholder="Email address">

                        @error('email')
                            <div class="text-red-600 text-sm p-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input onclick="window.fathom.trackGoal('4B94NMZY', 0);" id="password" name="password" type="password" autocomplete="current-password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-headless-wms-orange-400 focus:border-headless-wms-orange-400 focus:z-10 sm:text-sm" placeholder="Password">

                        @error('password')
                            <div class="text-red-600 text-sm p-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="sr-only">Password Confirmation</label>
                        <input onclick="window.fathom.trackGoal('4B94NMZY', 0);" id="password_confirmation" name="password_confirmation" type="password" autocomplete="current-password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-headless-wms-orange-400 focus:border-headless-wms-orange-400 focus:z-10 sm:text-sm" placeholder="Password Confirmation">
                    </div>
                </div>

{{--                <div class="flex items-center justify-between">--}}
{{--                    <div class="flex items-center">--}}
{{--                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">--}}
{{--                        <label for="remember-me" class="ml-2 block text-sm text-gray-900"> Remember me </label>--}}
{{--                    </div>--}}

{{--                    <div class="text-sm">--}}
{{--                        <a href="#" class="font-medium text-headless-wms-orange-500 hover:text-headless-wms-orange-400"> Forgot your password? </a>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div>
                    <button onclick="window.fathom.trackGoal('8N4RJ1K6', 0);" type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-orange-400 hover:bg-orange-200 hover:text-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign up
                    </button>
                </div>
                @if (session()->has('success'))
                    <div class="text-green-600 text-sm">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
