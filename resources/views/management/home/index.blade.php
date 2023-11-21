@extends('management.layouts.master')
@section('title')
    Dashboard - Admin Control Panel
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
                        <a>
                            <i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <strong>Recent</strong> Queries</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">

{{--                            <ul class="dropdown-menu pull-right">--}}
{{--                                <li>--}}
{{--                                    <a href="#" onClick="return false;">Action</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#" onClick="return false;">Another action</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#" onClick="return false;">Something else here</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
                        </li>
                    </ul>
                </div>
                <div class="tableBody">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(auth()->user()->hasPermissionTo('contacts-list'))
                            <?php
                            $count=1
                            ?>
                            @if(count($order)  != 0)
                            @foreach($order as $row)
                                <tr>
                                    <td>
                                        <a href="{{route('contacts.show',$row->id)}}">

                                            {{$row->name}}
                                        </a>
                                    </td>
                                    <td> {{$row->email}}</td>
                                    <td> {{$row->created_at}}</td>

                                </tr>
                            @endforeach
                            @else

                                <tr>
                                    <td colspan="3">
                                        No Record Found

                                    </td>
                                </tr>
                            @endif
                            <?php
                            $count=1
                            ?>
                            @else
                                <tr>
                                    <td class="text-center" colspan="5">
                                UNAUTHORIZED
                                    </td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->

    </div>
</div>

@endsection
