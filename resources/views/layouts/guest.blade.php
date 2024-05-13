<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    <div>
        @if (Request::is('login'))
            <h1 class="mb-0"><a href="{{ url('/') }}" class="text-white h2 mb-0"><strong>Login</strong></a>
            </h1>
        @elseif (Request::is('register'))
            <h1 class="mb-0 text-white"><a href="{{ url('/') }}" class=" h2 mb-0"><strong>Register</strong></a>
            </h1>
        @else
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        @endif
    </div>


    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
