@extends('management.layouts.master')
@section('title')
    Subscription
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
    </style>
    <div class="container-fluid px-4">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title"> Subscription</h4>
                            </li>

                        </ul>
                    </div>
                </div>
                <form action="{{ route('subscription.update', $subscription->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card py-4">
                                <div class="header">
                                    <div class="row">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong> Title </strong></label>
                                            <div class="form-line">
                                                <input value="{{ $subscription->title ?? '' }}" type="text"
                                                    id="erp_question_text" class="form-control" name="title"
                                                    placeholder="Title" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong> Description </strong></label>
                                            <textarea type="text" name="description" id="erp_order_message" class="ckeditor form-control choices" cols="30"
                                                rows="10">
                                                {{ $subscription->description ?? '' }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card py-4 d-none">

                                <div class="header">
                                    <div class="row">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong> Meta Title </strong></label>

                                            <div class="form-line">
                                                <input value="{{ $seo->meta_title ?? '' }}" type="text"
                                                    id="erp_question_text" class="form-control" name="meta_title"
                                                    placeholder="Meta Title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong> Meta Description </strong></label>
                                            <textarea value="{{ old('erp_order_message') }}" type="text" name="meta_description" id="erp_order_message"
                                                class="ckeditor form-control choices" cols="30" rows="10">
                                                {{ $seo->meta_description ?? '' }}
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="row my-4">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong> Meta Keywords </strong></label>

                                            <div class="form-line">
                                                <input value="{{ $seo->meta_keywords ?? '' }}" type="text"
                                                    id="erp_question_text" class="form-control" name="meta_keywords"
                                                    placeholder="Meta Keywords">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card p-4">


                                <div id="writingSer"
                                    class="{{ $subscription->permission === 'writing-service' ? 'd-none' : '' }}">

                                </div>

                                <div id="downloadInq"
                                    class="{{ $subscription->permission != 'writing-service' ? 'd-none' : '' }}"></div>


                                <div class="{{ $subscription->permission != 'writing-service' ? 'd-none' : '' }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="email_address1"><strong>Minimum No of Pages</strong></label>
                                            <input type="number" value="{{ $subscription->minimum_pages_allowed ?? '' }}"
                                                name="no_of_pages" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email_address1"><strong>Maximum No of Pages</strong></label>
                                            <input type="number" value="{{ $subscription->maximum_pages_allowed ?? '' }}"
                                                name="no_of_pages" class="form-control">
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="email_address1">
                                                <strong>
                                                    Actual Price
                                                    {{ $subscription->permission === 'writing-service' ? 'Per Page' : '' }}
                                                </strong>
                                            </label>
                                            <input type="number"
                                                value="{{ $subscription->permission === 'writing-service' ? $subscription->actual_price_per_page ?? '' : $subscription->actual_price }}"
                                                name="no_of_pages" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email_address1"><strong>
                                                    Compare Price
                                                    {{ $subscription->permission === 'writing-service' ? 'Per Page' : '' }}
                                                </strong></label>
                                            <input type="number"
                                                value="{{ $subscription->permission === 'writing-service' ? $subscription->compare_price_per_page ?? '' : $subscription->compare_price }}"
                                                name="no_of_pages" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email_address1"><strong>Subscription Duration</strong></label>
                                            <input type="text"
                                                value="{{ $subscription->subscription_duration ?? '' }}"
                                                name="subscription_duration" class="form-control">
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
                                            <button class="btn btn-primary float-right"> Submit</button>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class=" col-12">
                                            <label for="email_address1"><strong>Status</strong> </label>
                                            <select class="form-control select2" name="status" id="Quiz-type"
                                                data-placeholder="Select">
                                                <option value="">Select</option>
                                                <option {{ $subscription->status == '1' ? 'selected' : '' }} value=1>
                                                    Publish
                                                </option>
                                                <option {{ $subscription->status == '0' ? 'selected' : '' }} value=0>draft
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="row my-3">
                                        <div class=" col-12">
                                            <label for="email_address1"><strong>Permissions</strong> Customer who buy this
                                                subscription can access</label>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group"> 
                                                <label class="d-block">
                                                    <input type="radio" name="permission" checked
                                                        onclick="managePermissions(2)" value="writing-service">
                                                    <span>Writing Service</span>
                                                </label>
                                                <label class="d-block">
                                                    <input type="radio" name="permission"
                                                        onclick="managePermissions(1)" value="past-paper">
                                                    <span>Download Past Paper</span>
                                                </label>
                                                <label class="d-block">
                                                    <input type="radio" name="permission"
                                                        onclick="managePermissions(3)" value="inquire">
                                                    <span>Inquire Only</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="row my-3">
                                        <div class=" col-12">
                                            <label for="email_address1"><strong>Parent Category</strong></label>
                                            <select class="form-control select2" name="category_id" id="Quiz-type"
                                                data-placeholder="Select">
                                                <option value=""> select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <label class="mt-3"><strong>Media Gallery</strong></label>
                                    <div class="row image-box">
                                        <div class="col">
                                            <div class="main_container m-3">
                                                <div class="main imagebox position-relative rounded-3 overflow-hidden">
                                                    <div
                                                        class="select_img d-flex justify-content-center align-items-center">
                                                        <div class="dz-message p-3 text-center">
                                                            <h3>Click to upload.</h3>
                                                        </div>
                                                    </div>
                                                    <input type="file" name="image" accept=".jpg,.gif,.png,.webp"
                                                        class="main_file w-100 h-100 form-control position-absolute  opacity-0" />
                                                    <div class="img-thumb">
                                                        @if ($media == null)
                                                        @else
                                                            <img class="main_img d-block w-100 h-100 position-absolute"
                                                                src="{{ asset('images/media' . '/' . $media->image) }}"
                                                                alt="">
                                                        @endif
                                                    </div>
                                                </div>
                                                <a class="btn mt-3 remove_lol fw-normal border-0 shadow-none"
                                                    data-id="{{ $subscription->id }}">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const managePermissions = (e) => {

            var writingSer = `<div class="row">
            <div class=" col-md-6">
                <label for="email_address1"><strong> Minimum </strong> Number of Pages
                    Allowed
                    to be Purchased by customer </label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="number" class="form-control" name="minimum_allowed"
                            placeholder="Manimum no of pages" min="1">
                    </div>
                </div>
            </div>
            <div class=" col-md-6">
                <label for="email_address1"><strong> Maximum </strong> Number of Pages
                    Allowed
                    to be Purchased by customer </label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="number" id="erp_question_text" class="form-control"
                            name="maximum_allowed" placeholder="Maximum no of pages"
                            min="1">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class=" col-md-6">
                <label for="email_address1"><strong> Minimum </strong> Number of Pages
                    Allowed
                    in AddOn by customer </label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="number" class="form-control"
                            name="minimum_addon_allowed" placeholder="Manimum no of pages"
                            min="1">
                    </div>
                </div>
            </div>
            <div class=" col-md-6">
                <label for="email_address1"><strong> Maximum </strong> Number of Pages
                    Allowed
                    in AddOn by customer </label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="number" id="erp_question_text" class="form-control"
                            name="maximum_addon_allowed" placeholder="Maximum no of pages"
                            min="1">
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <label for="email_address1"><strong> Price Per Page </strong> </label>

            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <div class="form-line">
                        <input type="number" id="erp_question_text" class="form-control"
                            name="actual_price_per_page" placeholder="Regular Price"
                            min="0">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-line">
                        <input type="number" id="erp_question_text" class="form-control"
                            name="compare_price_per_page" placeholder="Compare price"
                            min="0">
                    </div>
                </div>
            </div>
        </div>`;

            var downloadInq = `     <div class="row">
                                <div class="col-md-6">
                                    <label><strong> Actual Price </strong> </label>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="erp_question_text" class="form-control"
                                                name="actual_price" placeholder="Regular Price"
                                                min="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label><strong> Compare Price </strong> </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="erp_question_text" class="form-control"
                                                name="compare_price" placeholder="Compare price"
                                                min="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label><strong> Number of Pages </strong> </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="erp_question_text" class="form-control"
                                                name="number_of_pages" placeholder="Number of Pages"
                                                min="0">
                                        </div>
                                    </div>
                                </div>
                        </div>`;



            if (e === 1 || e === 3) {
                console.log(document.getElementById('downloadInq').innerHTML);
                $('#writingSer').html('');
                if (document.getElementById('downloadInq').innerHTML === '') {
                    $('#downloadInq').append(downloadInq);
                }
            } else {
                $('#downloadInq').html('');
                if (document.getElementById('writingSer').innerHTML === '') {
                    $('#writingSer').append(writingSer);
                }

            }

        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imageResult')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function() {
            $('#upload').on('change', function() {
                readURL(input);
            });
        });

        /*  ==========================================
            SHOW UPLOADED IMAGE NAME
        * ========================================== */
        var input = document.getElementById('upload');
        var infoArea = document.getElementById('upload-label');

        input.addEventListener('change', showFileName);

        function showFileName(event) {
            var input = event.srcElement;
            var fileName = input.files[0].name;
            infoArea.textContent = 'File name: ' + fileName;
        }
    </script>
@endsection
