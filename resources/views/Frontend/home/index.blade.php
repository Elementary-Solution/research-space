@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @auth()
                            Welcome <span><a href="{{url('admin/home')}}">login</a></span>

                        @endauth
                        @guest()
                            Welcome <span><a href="{{url('login')}}">Home</a></span>

                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
