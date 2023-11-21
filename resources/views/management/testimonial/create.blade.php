@extends('management.layouts.master')
@section('title')
    Testimonial Create - {{config('app.dashboard')}}

@endsection
@section('content')

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
                {{--                @php--}}
                {{--                    $bl = $_GET['type'];--}}
                {{--                @endphp--}}
                <form action="{{route('testimonial.store')}}"  method="POST" enctype="multipart/form-data">
                    @csrf

                    @php
                            @endphp

                    <input type="hidden" name="user_id" value="{{Auth()->user()->id}}">


                    <div class="row">
                        <div class="col-md-8">
                            <div class="card py-4">

                                <div class="header">
                                    <div class="row">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong> Name </strong></label>
                                            <div class="form-line">
                                                <input type="text" id="name"
                                                       class="form-control" name="name"
                                                       placeholder="Name" value="{{old('name') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong> Designation </strong></label>
                                            <div class="form-line">
                                                <input type="text" id="designation"
                                                       class="form-control" name="designation"
                                                       placeholder="Designation" value="{{old('designation') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class=" col-12">
                                            <label for="email_address1">   <strong>  Comment </strong></label>
                                            <textarea value="{{old('comment') }}" type="text" name="comment"
                                                      id="comment"  class="ckeditor form-control choices" cols="30"
                                                      rows="10"
                                            ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="card">





                                <div class="header">
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary  my-2 float-right"> Submit   </button>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class=" col-12">
                                            <label for="email_address1">Status </label>
                                            <select class="form-control select2" name="status" id="Quiz-type" data-placeholder="Select">
                                                <option {{ old('status') == 1 ? 'Selected' : '' }}  value= 1>Publish</option>
                                                <option {{ old('status') == 0 ? 'Selected' : '' }}  value= 0>draft</option>

                                            </select>
                                        </div>
                                    </div>
{{--<div class="row my-1">--}}
{{--    <div class=" col-12">--}}
{{--        <label for="email_address1"> <strong> Order By </strong></label>--}}
{{--        <div class="form-line">--}}
{{--            <input type="text" id="orderby"--}}
{{--                   class="form-control" name="orderby"--}}
{{--                   placeholder="Order By">--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

                                    <div class="row">
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <script>

                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                $('#imageResult')
                                    .attr('src', e.target.result);
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    $(function () {
                        $('#upload').on('change', function () {
                            readURL(input);
                        });
                    });

                    /*  ==========================================
                        SHOW UPLOADED IMAGE NAME
                    * ========================================== */
                    var input = document.getElementById( 'upload' );
                    var infoArea = document.getElementById( 'upload-label' );

                    input.addEventListener( 'change', showFileName );
                    function showFileName( event ) {
                        var input = event.srcElement;
                        var fileName = input.files[0].name;
                        infoArea.textContent = 'File name: ' + fileName;
                    }

                </script>


@endsection

