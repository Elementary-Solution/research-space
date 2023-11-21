@extends('frontend.layouts.master')
@section('title')
   404 - {{config('app.name')}}
@endsection
@section('description')
    {{--Meta Description here --}}
@endsection
@section('keywords')
    {{--   Meta Keywords here --}}
@endsection
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto text-center">
            <img class="w-100 p-5" src="{{asset('frontend/404.png')}}" alt="">
            <a href="{{url('/')}}" class="btn read-more-cta px-4 py-2 fs-5 text-uppercase my-4 mb-5">
                Return to home
            </a>
        </div>
    </div>
</div>


@endsection

