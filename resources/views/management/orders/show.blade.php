@extends('management.layouts.master')
@section('title')
    Order Show - {{ config('app.dashboard') }}
@endsection
@section('content')
    <style>
        .ps-0 {
            padding-left: 0px !important;
            display: flex;
            justify-content: space-between;
        }
    </style>
    <div class="container-fluid px-4">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title"> Order</h4>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card py-4">
                            <div class="header">
                                <div class="row">
                                    <div class=" col-12">
                                        <label for="email_address1"> <strong><a href="" style="color: #0ba360">
                                                    #{{ $data->id ?? '' }}</a> </strong></label>
                                        <div class="mt-3">
                                            <table class="table">
                                                <td class="d-flex align-items-center justify-content-between">
                                                    @if ($data->no_of_pages != 'custom')
                                                        <p class="mb-0">

                                                            {{ $data->title ?? '' }}
                                                        </p>
                                                    @else
                                                        <p class="mb-0">
                                                            {{ $data->custom_title ?? '' }}
                                                        </p>
                                                    @endif

                                                    @if ($data->no_of_pages != 'custom')
                                                        <p class="mb-0">
                                                            <b>Subscription Duration: </b>
                                                            {{ $data->subscription_duration ?? '' }}
                                                            /mo
                                                        </p>
                                                    @else
                                                        <p class="mb-0">
                                                            <b>Deadline: </b>
                                                            @if ($data->custom_duration === 'erp_eight_hrs')
                                                                8 hours
                                                            @elseif($data->custom_duration === 'erp_tf_hrs')
                                                                24 hours
                                                            @elseif($data->custom_duration === 'erp_fe_hrs')
                                                                48 hours
                                                            @elseif($data->custom_duration === 'erp_three_days')
                                                                3 days
                                                            @elseif($data->custom_duration === 'erp_five_days')
                                                                5 days
                                                            @elseif($data->custom_duration === 'erp_seven_days')
                                                                7 days
                                                            @elseif($data->custom_duration === 'erp_fourteen_days')
                                                                14 days
                                                            @elseif($data->custom_duration === 'erp_fourteen_plus_days')
                                                                14+ days
                                                            @endif
                                                        </p>
                                                    @endif

                                                    @if ($data->no_of_pages != 'custom')
                                                        <p class="mb-0">
                                                            <b>No of Pages: </b>
                                                            {{ $data->no_of_pages ?? '' }}
                                                        </p>
                                                    @else
                                                        <p class="mb-0">
                                                            <b>No of Pages: </b>
                                                            {{ $data->erp_number_Pages ?? '' }}
                                                        </p>
                                                    @endif
                                                </td>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card py-4">
                            <div class="header">
                                <div class="row">
                                    <div class=" col-12">
                                        <label for="email_address1"> <strong><a href=""
                                                    style="color: #0ba360">PAID</a> </strong></label>
                                        <div class="mt-3">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td class="ps-0">
                                                            <span>
                                                                Subtotal:
                                                            </span>
                                                            <span>
                                                                ${{ $data->grand_total ?? '' }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ps-0">
                                                            <span>
                                                                Discount:
                                                            </span>
                                                            <span>
                                                                ${{ $data->coupon_discount ? '' : 0 }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ps-0">
                                                            <span>
                                                                Grand Total:
                                                            </span>
                                                            <span>
                                                                ${{ $data->order_total ?? '' }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <div class="row my-1">
                                    <div class=" col-12">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <label for="email_address1"><strong>Customer</strong> </label>
                                                        </div>
                                                        <div>
                                                            <label for="email_address1"><a
                                                                    href="{{ route('users.show', $data->userid) }}">{{ $data->name ?? '' }}</a></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <label for="email_address1"><strong>Billing Information</strong>
                                                            </label>
                                                        </div>

                                                        <div>
                                                            <label for="email_address1"><a
                                                                    href="mailto:{{ $data->billing_email }}">{{ $data->billing_first_name ?? '' }}
                                                                    {{ $data->billing_last_name ?? '' }}</a></label>
                                                        </div>
                                                        <div>
                                                            <label for="email_address1"><a
                                                                    href="mailto:{{ $data->billing_email }}">{{ $data->billing_email ?? '' }}</a></label>
                                                        </div>
                                                        <div>
                                                            <label for="email_address1"><a
                                                                    href="tel:{{ $data->billing_phone }}">{{ $data->billing_phone ?? '' }}</a></label>
                                                        </div>
                                                        <div>
                                                            <label
                                                                for="email_address1">{{ $data->billing_country ?? '' }}</label>
                                                        </div>
                                                        <div>
                                                            <label
                                                                for="email_address1">{{ $data->billing_street_address ?? '' }}</label>
                                                        </div>
                                                    </td>
                                                </tr>

                                                {{-- <tr>
                                                    <td>
                                                        <div>
                                                            <label for="email_address1"><strong>Subscription
                                                                    Duration</strong> </label>
                                                        </div>
                                                        <div>
                                                            <label
                                                                for="email_address1">{{ $data->subscription_duration ?? '' }}</label>
                                                        </div>
                                                    </td>
                                                </tr> --}}

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
