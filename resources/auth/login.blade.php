@extends('frontend.layouts.master')
@section('title')
    Sign in - {{config('app.name')}}
@endsection
@section('content')
<div class="container h-100 py-5">
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-md-5">
            <div class="card shadow border-0">
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

                <div class="card-body">
                    <h4 class="text-black text-center text-uppercase fw-bold py-4">Login  your account</h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
{{--                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>--}}

                            <div class="col-md-12">
                                <input id="email" type="email" placeholder="Enter your enter" class="py-3 form-control text-dark rounded-pill @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  autocomplete="off">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
{{--                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

                            <div class="col-md-12">
                                <input id="password" type="password" placeholder="Enter your password" class="py-3 text-dark rounded-pill form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" autocomplete="off">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-check">
                                    <label class="d-flex">
                                        <input type="checkbox" class="filled-in"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} >
                                        <span>{{ __('Remember Me') }}</span>
                                    </label>

                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-decoration-none text-black " href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md=12 ">
                                <button type="submit" class="btn read-more-cta bg-signature px-4 py-2 fs-5 text-uppercase my-4 w-100 " >
                                    {{ __('Login') }}
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
