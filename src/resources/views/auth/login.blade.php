@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="mt-12 shadow mx-8 p-8 pb-4 md:mx-auto md:w-1/2 xl:w-1/4 rounded-lg">
        <h1 class="font-semibold text-xl">{{__('Login') }}</h1>

        <div>
            <form method="POST" action="{{ route('login') }}">
                @csrf 

                <label for="email" class="block mt-4">
                    <span class="text-gray-700">{{ __('Email') }}</span> 
                    <input class="form-input mt-1 block w-full rounded-lg  @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="somebody@example.com">
                    @error('email')
                        <span class="text-red-400" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </label>

                <label for="password" class="block mt-4">
                    <span class="text-gray-700">{{ __('Password') }}</span> 
                    <input class="form-input mt-1 block w-full rounded-lg  @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="">
                    @error('password')
                        <span class="text-red-400" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </label>

                <label for="remember" class="block mt-4">
                    <input class="form-checkbox text-pink-600 text-lg rounded-md" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="text-gray-700">{{ __('Remember Me') }}</span>
                </label> 

                <div class="mt-4 block items-center text-center">
                    <button type="submit" class="focus:outline-0 focus:outline-none text-xl font-bold block p-3 mr-4 bg-pink-600 rounded-lg w-full  hover:bg-pink-700 text-white transition duration-200 ease-in-out">
                        {{ __('Log in') }}
                    </button>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="mt-4 text-gray-700 block hover:text-pink-600 accent-link "><u>{{ __('Forgot Your Password?') }}</u></a>
                    @endif
                </div>

                <hr class="mt-4">
                
                <div class="w-full mt-6 mx-auto items-center text-center">
                    <a class="text-2xl text-pink-600 font-bold hover:text-pink-600 accent-link" href="{{ route('register') }}">{{ __('Create an account here') }}</a>
                </div>
    
            </form>
        </div>
    </div>

</div>
@endsection
