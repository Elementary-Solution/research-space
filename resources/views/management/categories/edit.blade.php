@php
    $bl = $_GET['type'];
@endphp
@extends('management.layouts.master')
@section('title')
    Categories Edit | {{base64_decode($bl)}}
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
                                <h4 class="page-title"> Categories</h4>
                            </li>

                        </ul>
                    </div>
                </div>
                @php
                    $bl = $_GET['type'];
                @endphp
                <form action="{{route('categories.update',$category->id)}}?type={{$bl}}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card py-4">

                                <div class="header">
                                    <div class="row">
                                        <div class=" col-12">
                                            <label for="email_address1">   <strong>    Title </strong></label>
                                            <div class="form-line">
                                                <input value="{{$category->title}}" type="text" id="erp_question_text"
                                                       class="form-control" name="title"
                                                       placeholder="Title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class=" col-12">
                                            <label for="email_address1">   <strong>    Description </strong></label>
                                            <textarea type="text" name="description"
                                                      id="erp_order_message"  class="ckeditor form-control choices" cols="30"
                                                      rows="10">

                                                {{$category->description}}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card py-4">

                                <div class="header">
                                    <div class="row">
                                        <div class=" col-12">
                                            <label for="email_address1">   <strong>    Meta Title </strong></label>

                                            <div class="form-line">
                                                <input value=" {{$seo != null ? $seo->meta_title : ''}} "  type="text" id="erp_question_text"
                                                       class="form-control" name="meta_title"
                                                       placeholder="Meta Title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class=" col-12">
                                            <label for="email_address1">   <strong>  Meta Description </strong></label>
                                            <textarea value="{{old('erp_order_message') }}" type="text" name="meta_description"
                                                      id="erp_order_message"  class="ckeditor form-control choices" cols="30"
                                                      rows="10">
                                              {{$seo != null ? $seo->meta_description : ''}}
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="row my-4">
                                        <div class=" col-12">
                                            <label for="email_address1">   <strong>    Meta Keywords  </strong></label>

                                            <div class="form-line">
                                                <input value="{{$seo != null ? $seo->meta_keywords : ''}}" type="text" id="erp_question_text"
                                                       class="form-control" name="meta_keywords"
                                                       placeholder="Meta Keywords">
                                            </div>
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
                                            <button class="btn btn-primary float-right"> Submit   </button>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class=" col-12">
                                            <label for="email_address1">Status </label>
                                            <select class="form-control select2" name="status" id="Quiz-type" data-placeholder="Select">
                                                <option value="">Select</option>
                                                <option {{$category->status == '1' ? 'selected' : ''}}   value= 1>Publish</option>
                                                <option {{$category->status == '0' ? 'selected' : ''}}  value= 0>draft</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class=" col-12">
                                            <label for="email_address1">Parent Category</label>
                                            <select class="form-control select2" name="parent_category" id="Quiz-type" data-placeholder="Select">
                                                <option value=""> select </option>
                                                @foreach($all_category as $row)
                                                        <option {{$category->parent_category == $row->id ? 'selected' : ''}}   value={{$row->id}}>{{$row->title}} </option>
                                                @endforeach

                                            </select>
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
                                                            <em>(This is just a demo dropzone. Selected files are
                                                                <strong>not</strong> actually uploaded.)
                                                            </em>
                                                        </div>
                                                    </div>
                                                    <input type="file" name="image" accept=".jpg,.gif,.png"
                                                           class="main_file w-100 h-100 form-control position-absolute  opacity-0" />
                                                    <div class="img-thumb">
                                                        <img class="main_img d-block w-100 h-100 position-absolute" src="{{asset('images/media'.'/'.$category->image)}}" alt="{{$category->title}}">
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

