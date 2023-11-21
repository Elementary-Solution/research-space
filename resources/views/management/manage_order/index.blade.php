@extends('management.layouts.master')
@section('title')
    Manage Order
@endsection
@section('content')
    <div class="container-fluid px-4">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-12">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item d-flex align-items-center justify-content-between w-100">
                                <h4 class="page-title">Manage Order</h4>
                                {{-- <a href="{{ route('orders.create') }}" type="button" class="btn btn-primary">
                                    Create Order
                                </a> --}}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="header">

                        <div class="body table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Topic</th>
                                        <th>Academic Level</th>
                                        <th>Subject Name</th>
                                        <th>Language</th>
                                        <th>Resource Material</th>
                                        <th>status</th>
                                        <th>Order Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    ?>
                                    @foreach ($order as $row)
                                        <tr>
                                            <td>
                                                <a href="{{ route('orders.show', $row->id) }}">
                                                    {{ $row->name ?? '' }}</a>
                                            </td>
                                            <td>
                                                {{ $row->erp_order_topic ?? '' }}
                                            </td>
                                            <td>
                                                {{ $row->erp_academic_name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $row->erp_subject_name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $row->erp_language_name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $row->erp_resource_materials ?? '' }}
                                            </td>
                                            @if ($row->erp_status == 1)
                                                <td><label class="badge badge-info" data-toggle="modal"
                                                        data-target="#active_inactive">New</label>
                                                </td>
                                            @elseif ($row->erp_status == 0)
                                                <td><label class="badge badge-primary" data-toggle="modal"
                                                        data-target="#active_inactive">Created</label>
                                                </td>
                                            @elseif ($row->erp_status == 2)
                                                <td><label class="badge badge-warning" data-toggle="modal"
                                                        data-target="#active_inactive">In Progress</label>
                                                </td>
                                            @elseif ($row->erp_status == 3)
                                                <td><label class="badge badge-danger" data-toggle="modal"
                                                        data-target="#active_inactive">Canceled</label>
                                                </td>
                                            @elseif ($row->erp_status == 4)
                                                <td><label class="badge badge-success" data-toggle="modal"
                                                        data-target="#active_inactive">Completed</label>
                                                </td>
                                            @endif
                                            <td>
                                                <div>
                                                    @if ($row->order_type === '1')
                                                        Custom <br>
                                                        @if ($row->is_paid)
                                                            <label class="badge badge-success" data-toggle="modal"
                                                                data-target="#active_inactive">Paid</label>
                                                        @else
                                                            <label class="badge badge-danger" data-toggle="modal"
                                                                data-target="#active_inactive">Pending</label>
                                                        @endif
                                                    @else
                                                        Order
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
