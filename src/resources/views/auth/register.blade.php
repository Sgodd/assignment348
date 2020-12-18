@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="mt-12 shadow mx-8 p-8 pb-4 md:mx-auto md:w-1/2 xl:w-1/4 rounded-lg">
        <h1 class="font-semibold text-xl">{{__('Register') }}</h1>

        <div>
            <form method="POST" action="{{ route('register') }}">
                @csrf 

                <label for="name" class="block mt-4">
                    <span class="text-gray-700">{{ __('Name') }}</span> 
                    <input class="form-input mt-1 block w-full rounded-lg  @error('name') is-invalid @enderror" type="text" name="name" id="email" placeholder="John Smith">
                    @error('name')
                        <span class="text-red-400" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </label>

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

                <label for="password-confirm" class="block mt-4">
                    <span class="text-gray-700">{{ __('Confirm Password') }}</span> 
                    <input class="form-input mt-1 block w-full rounded-lg  @error('password') is-invalid @enderror" type="password" name="password_confirmation" id="password-confirm" placeholder="">
                </label>

                <div class="mt-6 block items-center text-center">
                    <button type="submit" class="text-xl font-bold block p-3 mr-4 bg-pink-600 rounded-lg w-full  hover:bg-pink-700 text-white transition duration-200 ease-in-out">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

{{--
@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
--}}