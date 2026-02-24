
@extends('layouts.app')
@section('content')
    <div class="grid md:grid-cols-3 grid-cols-1">
        <div class="md:col-span-1">
            <nav class="md:fixed flex flex-col items-center">
                <ul>
                    <li onclick="document.getElementById('getting-started').scrollIntoView()" class="cursor-pointer mt-10 md:ml-10 text-lg hover:text-headless-wms-orange-400 transition ease-in-out duration-500">
                        Getting started
                    </li>
                    <li onclick="document.getElementById('php-client').scrollIntoView()" class="cursor-pointer mt-5 md:ml-10 text-lg hover:text-headless-wms-orange-400 transition ease-in-out duration-500">
                        PHP Client
                    </li>
                    <li class="cursor-pointer mt-5 md:ml-10 text-lg hover:text-headless-wms-orange-400 transition ease-in-out duration-500">
                        <a href="{{ route('reference') }}">API Reference</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="md:col-span-2 text-left mt-9 mr-3 md:p-0 p-10 grid">
            <h1 class="text-4xl font-bold text-headless-wms-orange-500">Headless WMS API</h1>
            <h1 id="getting-started" class="text-3xl mt-2 font-bold">Getting started</h1>
            <h1 id="create-account" class="font-bold mt-2">Create an account</h1>
            <p>After you have created an account, either a free trial or a paid account, you can make use of our API. Our API is based on best practices and is therefore RESTful and data is formatted in JSON.</p>
            <h1 id="authentication" class="font-bold mt-2">Authentication</h1>
            <p>The first you need to do after you have created your account is to generate an API token for your account. To do this, you need to execute a POST request to following endpoint:</p>
            <http-request :route="'https://headless-wms.com/api/v1/tokens'" :request="'POST'"></http-request>
            <p>Make sure to use the following HTTP header:</p>
            <http-header :content="'Authorization: Basic <email-address>:<password>'"></http-header>
            <p>Where the email address and password should be encoded with base64. A PHP example is:</p>
            <code-block :lines="{{ collect(array('$encodedEmailAndPassword = base64_encode(\'johndoe@gmail.com:strong-password-123\');',
                                    '$header = \'Authorization: Basic \' . $encodedEmailAndPassword '))  }}">
            </code-block>
            <p>This endpoint should return a Bearer token, make sure you save it somewhere as we are not able to retrieve it if you lose it. You should use this Bearer token for all the other API endpoints, using the following header:</p>
            <http-header :content="'Authorization: Bearer <token>'"></http-header>
            <h1 id="php-client" class="font-bold mt-2 text-3xl">PHP Client</h1>
            <p>You can use our PHP client to integrate Headless WMS with your existing application. See our <a class="text-headless-wms-orange-500 inline" href="https://github.com/headless-wms/php-client">Github page</a> for the source code. To install the software you can use composer: </p>
            <code-block :lines="{{ collect(array('composer require headless-wms/php-client')) }}"></code-block>
        </div>
    </div>

@endsection
