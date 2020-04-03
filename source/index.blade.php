@extends('_layouts.master')

@section('body')
<section class="container max-w-6xl mx-auto px-6 pb-10">
    <div class="flex justify-center flex-col-reverse mb-10 lg:flex-row lg:mb-24">
        <div class="mt-8 text-center">
            <h1 class="text-center">Don't be caught off guard.</h1>

            <h2 class="font-light mt-4">
                Let Watchdog monitor <span class="font-extrabold">all changes</span> to your Active Directory.
            </h2>

            <div class="flex justify-center my-10">
                <a href="/docs/getting-started" title="{{ $page->siteName }} getting started" class="bg-gray-800 hover:bg-gray-600 font-normal text-white hover:text-white rounded mr-4 py-2 px-6">
                    Get Started
                </a>

                <a href="https://jigsaw.tighten.co" title="Jigsaw by Tighten" class="bg-gray-400 hover:bg-gray-600 text-blue-900 font-normal hover:text-white rounded py-2 px-6">
                    Source Code
                </a>
            </div>
        </div>
    </div>

    <hr class="block my-8 border lg:hidden">

    <div class="md:flex -mx-2 -mx-4">
        <div class="mb-8 mx-3 px-2 md:w-1/3">
            <img src="/assets/img/icon-window.svg" class="h-12 w-12" alt="window icon">

            <h3 id="intro-laravel" class="text-2xl text-blue-900 mb-0">Track every single <br>change to all objects</h3>

            <p>Keep an eye on your entire directory and see when an object was changed, and it's before and after value.</p>
        </div>

        <div class="mb-8 mx-3 px-2 md:w-1/3">
            <img src="/assets/img/icon-terminal.svg" class="h-12 w-12" alt="terminal icon">

            <h3 id="intro-markdown" class="text-2xl text-blue-900 mb-0">Never be caught off<br>guard with notifications</h3>

            <p>Watchdog notifies you of everything important, such as password updates, account lockouts, membership changes and more.</p>
        </div>

        <div class="mx-3 px-2 md:w-1/3">
            <img src="/assets/img/icon-stack.svg" class="h-12 w-12" alt="stack icon">

            <h3 id="intro-mix" class="text-2xl text-blue-900 mb-0">Compile your assets <br>using Laravel Mix </h3>

            <p>Jigsaw comes pre-configured with Laravel Mix, a simple and powerful build tool. Use the latest frontend tech with just a few lines of code.</p>
        </div>
    </div>
</section>
@endsection
