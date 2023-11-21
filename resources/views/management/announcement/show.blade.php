@extends('management/layouts/master')
@section('title')
    Announcment
@endsection
@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">Dashboard</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a href="{{url('home')}}">
                                <i class="fas fa-home"></i>Announcement</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- Widgets -->

        <div class="mb-5 " id="style-1">

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="counter-box white">
                        <div class="container">
                            <div class="row mt-5">
                                <div class="col">
                                    <h2>
                                        <strong >Announcement <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                        </strong></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @foreach($Announcement as $announcements)

                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="counter-box white">
                            <div class="container">
                                <div class="row mt-4 align-items-center">

                                    <div class="col-9">
                                        <strong class="font-weight-bold font-21">  {{$announcements->erp_title}} </strong>
                                    </div>
                                    <div class="col-3   text-right">
                                        <strong class=" font-12"> Post Date :{{$announcements->erp_timetype == 'immediate'? $announcements->created_at:$announcements->Date}}</strong> </>
                                </div>

                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <strong class="font-16">{{$announcements->erp_message}}</strong>
                                </div>

                            </div>


                            <div class="row mt-4">
                                <div class="col-12">
                                    {{--                                    @if (in_array($extension = pathinfo($announcements['erp_file'], PATHINFO_EXTENSION), ['jpg', 'png', 'bmp','jpeg','PNG']))--}}
                                    @if ($announcements->erp_file == '')


                                    @else
                                        <div class="row">
                                            <div class="col">
                                                <strong class="font-12">Click here</strong>
                                            </div>

                                        </div>
                                    <div class="mt-3">
                                        <a  class="btn btn-default btn-circle waves-effect waves-circle waves-float" href="{{asset('image/announcement'.'/'.$announcements->erp_file)}}" download>
                                            <i class="material-icons">publish</i>
                                        </a>
                                    </div>


                                    @endif



                                </div>



                            </div>


                            <div>

                            </div>
                        </div>


                    </div>

                </div>
        </div>

        @endforeach
    </div>
@endsection

