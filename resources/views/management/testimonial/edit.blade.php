@extends('management.layouts.master')
@section('title')
    Testimonial Edit - {{config('app.dashboard')}}
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
                                <h4 class="page-title"> Testimonial</h4>
                            </li>

                        </ul>
                    </div>
                </div>



                <form action="{{route('testimonial.update',$testimonial->id)}}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="user_id" value="{{Auth()->user()->id}}">



                    <div class="row">
                        <div class="col-md-8">
                            <div class="card py-4">

                                <div class="header">
                                    <div class="row">
                                        <div class=" col-12">
                                            <label for="email_address1">   <strong>    Name </strong></label>
                                            <div class="form-line">
                                                <input value="{{$testimonial->name}}" type="text" id="erp_question_text"
                                                       class="form-control" name="name"
                                                       placeholder="Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class=" col-12">
                                            <label for="email_address1">   <strong>    Designation </strong></label>
                                            <div class="form-line">
                                                <input value="{{$testimonial->designation}}" type="text" id="erp_question_text"
                                                       class="form-control" name="designation"
                                                       placeholder="Designation" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class=" col-12">
                                            <label for="email_address1">   <strong>  Comment </strong></label>
                                            <textarea type="text" name="comment"
                                                      id="comment"  class="ckeditor form-control choices" cols="30"
                                                      rows="10">

                                                {{$testimonial->comment}}
                                            </textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">





                                <div class="header">
                                    <div class="row">
                                        <div class="col-12 my-3">
{{--                                            <a target="_blank" href="{{url('page',$data->slug)}}" class="btn btn-primary float-right"> Preview   </a>--}}
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary float-right"> Submit   </button>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class=" col-12">
                                            <label for="email_address1">Status </label>
                                            <select class="form-control select2" name="status" id="Quiz-type" data-placeholder="Select">
                                                <option value="">Select</option>
                                                <option {{$testimonial->status == '1' ? 'selected' : ''}}   value= 1>Publish</option>
                                                <option {{$testimonial->status == '0' ? 'selected' : ''}}  value= 0>draft</option>

                                            </select>
                                        </div>
                                    </div>
{{--                                    <div class="row">--}}
{{--                                        <div class=" col-12">--}}
{{--                                            <label for="email_address1">   <strong>    Order </strong></label>--}}
{{--                                            <div class="form-line">--}}
{{--                                                <input value="{{$data->orderby}}" type="text" id="erp_question_text"--}}
{{--                                                       class="form-control" name="orderby"--}}
{{--                                                       placeholder="Order By">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


                                    <div class="row image-box">
                                        <div class="col">
                                            <div class="main_container m-3">
                                                <div class="main imagebox position-relative rounded-3 overflow-hidden">
                                                    <div class="select_img d-flex justify-content-center align-items-center">
                                                        <div class="dz-message p-3 text-center">
                                                            <div class="drag-icon-cph">
                                                                <i class="material-icons" style="font-size: 35px">touch_app</i>
                                                            </div>
                                                            <h3>Click to upload.</h3>
                                                            <em>(This is just a demo dropzone. Selected files are
                                                                <strong>not</strong> actually uploaded.)
                                                            </em>
                                                        </div>
                                                    </div>
                                                    <input type="file" name="image" accept=".jpg,.gif,.png,.webp"
                                                           class="main_file w-100 h-100 form-control position-absolute  opacity-0" />
                                                    <div class="img-thumb">
                                                        @if($media == null)
                                                        @else
                                                        <img class="main_img d-block w-100 h-100 position-absolute" src="{{asset('images/media'.'/'.$media->image)}}" alt="">
                                                        @endif
                                                    </div>

                                                </div>
                                                @if($media == null)
                                                @else
                                                    <a class="btn mt-3 remove_lol fw-normal border-0 shadow-none" data-id="{{$media->id}}">Remove</a>
                                                @endif

                                            </div>
                                        </div>

                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </form>



@endsection

