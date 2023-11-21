@extends('management.layouts.master')
@section('title')
    Orders
@endsection
@section('content')
    <div class="container-fluid px-4">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title">Purchase History</h4>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        </div>
                        <div class="body table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Order No.</th>
                                        <th>Name</th>
                                        <th>Order Total</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    ?>
                                    @foreach ($data as $row)
                                        @if ($row->order_type == 1)
                                            <tr>
                                                <td>
                                                    #{{ $row->id }}
                                                </td>
                                                <td>
                                                    {{-- <a href="{{ route('view-order.show', $row->id) }}"> --}}
                                                    {{ $row->name }}
                                                    {{-- </a> --}}
                                                </td>
                                                <td>
                                                    ${{ $row->order_price ?? '' }}
                                                </td>
                                                <td>
                                                    @if ($row->is_paid)
                                                        <label class="badge badge-success" data-toggle="modal"
                                                            data-target="#active_inactive">Paid</label>
                                                    @else
                                                        <label class="badge badge-danger" data-toggle="modal"
                                                            data-target="#active_inactive">Pending</label>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
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
