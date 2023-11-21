@extends('management.layouts.master')
@section('title')
    Coupon Discount Edit - {{config('app.dashboard')}}

@endsection
@section('content')
    <style>

        #upload {
            opacity: 0;
        }

        #upload-label {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
        }

        .image-area {
            border: 2px dashed rgba(255, 255, 255, 0.7);
            padding: 1rem;
            position: relative;
        }

        .image-area::before {
            content: 'Uploaded image result';
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 0.8rem;
            z-index: 1;
        }

        .image-area img {
            z-index: 2;
            position: relative;
        }

        /*
        *
        * ==========================================
        * FOR DEMO PURPOSES
        * ==========================================
        *
        */
        body {
            min-height: 100vh;
            /*background-color: #757f9a;*/
            /*background-image: linear-gradient(147deg, #757f9a 0%, #d7dde8 100%);*/
        }

        /*
</style>
    <div class="container-fluid px-4">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title"> Coupon Discount Edit</h4>
                            </li>

                        </ul>
                    </div>
                </div>

                <form action="{{route('coupon-discount.update',$language->id)}}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card py-4">
                                <div class="header">
                                    <div class="row my-1">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong>Title</strong></label>
                                            <div class="form-line">
                                                <input value="{{$language->title}}" type="text" id="title"
                                                       class="form-control" name="title"
                                                       placeholder="Enter Title Of Discount Code" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong>Discount Code</strong></label>
                                            <div class="form-line">
                                                <input value="{{$language->discount_code}}" type="text" id="discount_code"
                                                       class="form-control" name="discount_code"
                                                       placeholder="Enter Discount Code" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong>Value</strong></label>
                                            <div class="form-line">
                                                <input value="{{$language->value}}" type="text" id="value"
                                                       class="form-control" name="value"
                                                       placeholder="Enter Value Of Discount Code" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong>Start Date</strong></label>
                                            <div class="form-line">
                                                <input value="{{$language->start_date}}" type="date" id="start_date"
                                                       class="form-control" name="start_date"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong> Expire Date </strong></label>
                                            <div class="form-line">
                                                <input value="{{$language->expiry_date}}" type="date"
                                                       id="expiry_date"
                                                       class="form-control" name="expiry_date"
                                                       placeholder="Enter" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class=" col-12">
                                            <label for="email_address1"><strong>Status</strong></label>
                                            <select class="form-control select2" name="status" id="Quiz-type"
                                                    data-placeholder="Select">
                                                <option {{ $language->status == 1 ? 'Selected' : '' }}  value=1>
                                                    Publish
                                                </option>
                                                <option {{ $language->status == 0 ? 'Selected' : '' }}  value=0>draft
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary  my-2 float-right"> Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
@endsection

