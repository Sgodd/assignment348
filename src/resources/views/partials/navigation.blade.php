<nav class="bg-gray-50">
    <ul class="hidden md:flex overflow-x-hidden mr-10 font-semibold">
        @guest
            <li class="mr-6 p-1">
                <a class="text-black hover:text-pink-600 accent-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>            
    
            <li class="mr-6 p-1">
                <a class="text-black hover:text-pink-600 accent-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endguest

        @if (Auth::Check())
            <li class="mr-6 p-1">
                <a class="text-black hover:text-pink-600 accent-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>            
    
            <li class="mr-6 p-1">
                <a class="text-black hover:text-pink-600 accent-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    </ul>
</nav>
