@extends('management.layouts.master')
@section('title')
    Ads
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
                                <h4 class="page-title"> Ads</h4>
                            </li>

                        </ul>
                    </div>
                </div>
                <form action="{{route('slider.store')}}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{Auth()->user()->id}}">
                    <div class="row">
                        <div class="col-md-2">


                        </div>
                        <div class="col-md-8">
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
                                                <option   value= 1>Publish</option>
                                                <option   value= 0>draft</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row my-1">


                                        <div class=" col-12">
                                            <label for="email_address1">Type </label>
                                            <select class="form-control select2" name="type" id="Quiz-type" data-placeholder="Select">
                                                <option   value="ad">ad</option>
                                                <option   value="popup">Popup</option>
                                                <option   value="slider">Slider</option>
                                            </select>
                                        </div>
                                    </div>
{{--                                    <div class="row my-3">--}}
{{--                                        <div class=" col-12">--}}
{{--                                            <label for="email_address1">Orderby </label>--}}
{{--                                            <div class="form-line">--}}
{{--                                                <input type="number" id="erp_question_text" class="form-control" name="orderby" placeholder="orderby" required="">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="row my-3">
                                        <div class=" col-12">
                                            <label for="email_address1">Url </label>
                                            <div class="form-line">
                                                <input type="url" id="erp_question_text" class="form-control" name="url" placeholder="url" required="">
                                            </div>
                                        </div>
                                    </div>
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
{{--                                                            <em>(This is just a demo dropzone. Selected files are--}}
{{--                                                                <strong>not</strong> actually uploaded.)--}}
{{--                                                            </em>--}}
                                                        </div>
                                                    </div>
                                                    <input type="file" name="image" accept=".jpg,.gif,.png"
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

