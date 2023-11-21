@extends('management.layouts.master')
@section('title')
    Contact Show - Elite Blue Dashboard
@endsection
@section('content')
    <div class="container-fluid px-4">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title"> Contact</h4>
                            </li>

                        </ul>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card pt-4">
                                <div class="header">
                                    <div>
                                        <h6>Name</h6>
                                        <p>{{$data->name ?? ''}}</p>
                                    </div>
                                    <div>
                                        <h6>Email</h6>
                                        <p>
                                            <a href="mailto:{{$data->email}}">{{$data->email ?? ''}}</a>
                                        </p>
                                    </div>
                                    <div>
                                        <h6>Phone</h6>
                                        <p>
                                            <a href="tel:{{$data->phone}}">{{$data->phone ?? ''}}</a>
                                        </p>
                                    </div>
                                    <div>
                                        <h6>Guard</h6>
                                        <p>{{$data->guard ?? ''}}</p>
                                    </div>
                                    <div>
                                        <h6>Domain</h6>
                                        <p>{{$data->domain ?? ''}}</p>
                                    </div>
                                    <div>
                                        <h6>Subject</h6>
                                        <p>{{$data->subject ?? ''}}</p>
                                    </div>
                                    <div>
                                        <h6>Message</h6>
                                        <p>{{$data->message ?? ''}}</p>
                                    </div>
                                    <div class="text-right">
                                        <h6>Date / Time</h6>
                                        <p class="m-0">{{$data->created_at ?? ''}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

