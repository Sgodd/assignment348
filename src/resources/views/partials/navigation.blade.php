<nav class="bg-gray-50">
    <ul class="md:flex overflow-x-hidden mr-10 font-semibold">
        @guest

        @endguest

        @if (Auth::Check())
            <li class="mr-6 p-1">
                <a class="text-black hover:text-pink-600 accent-link" href="#{{--{{ route('account') }} --}}">{{ __('Account') }}</a>
            </li>            
    
            <li class="mr-6 p-1">
                <a class="text-black hover:text-pink-600 accent-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" >{{ __('Log out') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none hidden">
                    @csrf
                </form>
            </li>
        @endif
    </ul>
</nav>
