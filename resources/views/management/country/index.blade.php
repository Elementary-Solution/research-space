@extends('management.layouts.master')
@section('title')
    Country - {{config('app.dashboard')}}
@endsection
@section('content')

    <div class="container-fluid px-4">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title"> Countries</h4>
                            </li>

                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <button type="button" class="btn btn-primary float-right mt-3"> Back
                        </button>
                    </div>
                </div>
                @include('management.layouts.error')
                <form  action="{{route('countries.store')}}"  method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="card">
                    <div class="header">
                        <button type="submit" class="btn btn-primary waves-effect" >update
                        </button>

                        <div class="body table-responsive">
                            <table class="table" id="">
                                <thead>
                                <tr>
                                    <th class="col-lg-3">Name</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $count=1
                                ?>
                                @foreach($countries as $country)@php
                                    $low = strtolower($country->iso);
                              @endphp

                                    @csrf
                                    <tr>
                                        <td>
                                            <label>
                                                <input {{$country->status ==1 ? 'checked' : ''}} type="checkbox" class="filled-in" value="{{$country->id}}" name="checkbox[]">
                                                <span>
                                                    <img height="20px" class="mx-2" src="{{asset('/flags/'.$low.'.svg')}}">
                                               {{$country->name}}
                                                </span>
                                            </label>
                                        </td>
                                    </tr>


                              @endforeach
                                </tbody></table>
                            <button type="submit" class="btn btn-primary waves-effect" >update
                            </button>
                           </div>
                    </div>
                </div>
                </form>



@endsection


                <style>
                    tbody {
                        display: grid;
                        grid-template-columns: 1fr 1fr 1fr;
                    }
                </style>
