
@extends('frontend.layouts.master')

{{--@extends('layouts.app')--}}
@section('title')
    Sign up - {{config('app.name')}}
@endsection
@section('content')
<div class="container h-100 py-5">
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-md-5">
            <div class="card shadow border-0">
{{--                <div class="card-header">{{ __('Register') }}</div>--}}
                <h4 class="text-black text-center text-uppercase fw-bold py-4">Create  your account</h4>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
{{--                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>--}}

                            <div class="col-md-12">
                                <input id="name" type="text" placeholder="Enter Your Name" class="py-3 form-control text-dark rounded-pill @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
{{--                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>--}}

                            <div class="col-md-12">
                                <input id="email" type="email" placeholder="Enter Your Email Address" class="py-3 form-control text-dark rounded-pill @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password"  placeholder="Password"  class="py-3 form-control text-dark rounded-pill @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>--}}

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" placeholder="Confirm Password" class="py-3 form-control text-dark rounded-pill" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn read-more-cta px-4 bg-signature py-2 fs-5 text-uppercase my-4 w-100 " >
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
