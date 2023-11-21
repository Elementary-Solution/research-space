@extends('management.layouts.master')
@section('title')
    Subscription Create - {{ config('app.dashboard') }}
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
                <form action="{{ route('subscription.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card py-4">
                                <div class="header">
                                    <div class="row">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong> Title </strong></label>
                                            <div class="form-line">
                                                <input value="{{ old('title') }}" type="text" id="erp_question_text"
                                                    class="form-control" name="title" placeholder="Title" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong> Description </strong></label>
                                            <textarea value="{{ old('description') }}" type="text" name="description" id="description"
                                                class="ckeditor form-control choices" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div class="row my-2">
                                        <div class="col-md-12">
                                            <label for="email_address1">Subscription Duration </label>
                                        </div>
                                        <div class=" col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="number" id="erp_question_text" class="form-control"
                                                        name="subscription_duration" placeholder=" no of days"
                                                        min="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" col-md-6">
                                            <select class="form-control select2" name="duration_type" id="Quiz-type"
                                                data-placeholder="Select">
                                                <option value="">Select</option>
                                                {{--                                                <option {{ old('duration') == 'days' ? 'Selected' : '' }}  value="days">days</option> --}}
                                                {{--                                                <option {{ old('duration') == 'week' ? 'Selected' : '' }}  value="week">weeks</option> --}}
                                                <option {{ old('duration_type') == 'month' ? 'Selected' : '' }}
                                                    value="month">
                                                    months</option>
                                                <option {{ old('duration_type') == 'year' ? 'Selected' : '' }}
                                                    value="year">
                                                    years</option>
                                            </select>

                                        </div>
                                    </div>


                                    <div id="writingSer">
                                        <div class="row">
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

{{--                                        <div class="row">--}}
{{--                                            <div class=" col-md-6">--}}
{{--                                                <label for="email_address1"><strong> Minimum </strong> Number of Pages--}}
{{--                                                    Allowed--}}
{{--                                                    in AddOn by customer </label>--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <div class="form-line">--}}
{{--                                                        <input type="number" class="form-control"--}}
{{--                                                            name="minimum_addon_allowed" placeholder="Manimum no of pages"--}}
{{--                                                            min="1">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class=" col-md-6">--}}
{{--                                                <label for="email_address1"><strong> Maximum </strong> Number of Pages--}}
{{--                                                    Allowed--}}
{{--                                                    in AddOn by customer </label>--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <div class="form-line">--}}
{{--                                                        <input type="number" id="erp_question_text" class="form-control"--}}
{{--                                                            name="maximum_addon_allowed" placeholder="Maximum no of pages"--}}
{{--                                                            min="1">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}


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
                                        </div>
                                    </div>

                                    <div id="downloadInq"></div>
                                </div>
                            </div>
                            <div class="card d-none py-4">
                                <div class="header">
                                    <div class="row">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong> Meta Title </strong></label>
                                            <div class="form-line">
                                                <input value="{{ old('meta_title') }}" type="text"
                                                    id="erp_question_text" class="form-control" name="meta_title"
                                                    placeholder="Meta Title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong> Meta Description </strong></label>
                                            <textarea value="{{ old('erp_order_message') }}" type="text" name="meta_description" id="erp_order_message"
                                                class="ckeditor form-control choices" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div class="row my-4">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong> Meta Keywords </strong></label>

                                            <div class="form-line">
                                                <input value="{{ old('meta_keywords') }}" type="text"
                                                    id="erp_question_text" class="form-control" name="meta_keywords"
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
                                            <button class="btn btn-primary  my-2 float-right"> Submit</button>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class=" col-12">
                                            <label for="email_address1"><strong>Status</strong> </label>
                                            <select class="form-control select2" name="status" id="Quiz-type"
                                                data-placeholder="Select">
                                                <option {{ old('status') == 1 ? 'Selected' : '' }} value=1>Publish
                                                </option>
                                                <option {{ old('status') == 0 ? 'Selected' : '' }} value=0>draft
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class=" col-12">
                                            <label for="email_address1"><strong>Permissions</strong> Customer who buy this
                                                subscription can access</label>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                {{--                                            <label class="d-block"> --}}
                                                {{--                                                <input type="radio" name="permission" value="custom-order"> --}}
                                                {{--                                                <span>Custom Order</span> --}}
                                                {{--                                            </label> --}}
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
                                    </div>
                                    {{--                                    <div class="row my-3"> --}}
                                    {{--                                        <div class=" col-12"> --}}
                                    {{--                                            <label for="email_address1"><strong>No  OF Pages</strong></label> --}}
                                    {{--                                            <input type="number" name="no_of_pages" class="form-control"> --}}
                                    {{--                                        </div> --}}
                                    {{--                                    </div> --}}
                                    {{--                                    <div class="row my-3"> --}}
                                    {{--                                        <div class=" col-12"> --}}
                                    {{--                                            <label for="email_address1"><strong>Regular Price</strong></label> --}}
                                    {{--                                            <input type="number" name="regular_price" class="form-control"> --}}
                                    {{--                                        </div> --}}
                                    {{--                                    </div> --}}
                                    {{--                                    <div class="row my-3"> --}}
                                    {{--                                        <div class=" col-12"> --}}
                                    {{--                                            <label for="email_address1"><strong>Discount Price</strong></label> --}}
                                    {{--                                            <input type="number" name="discount_price" class="form-control"> --}}
                                    {{--                                        </div> --}}
                                    {{--                                    </div> --}}
                                    {{--                                    <div class="row my-3"> --}}
                                    {{--                                        <div class=" col-12"> --}}
                                    {{--                                            <label for="email_address1"><strong>Stock</strong></label> --}}
                                    {{--                                            <input type="number" name="stock" class="form-control"> --}}
                                    {{--                                        </div> --}}
                                    {{--                                    </div> --}}
                                    {{--                                    <div class="row my-3"> --}}
                                    {{--                                        <div class=" col-12"> --}}
                                    {{--                                            <label for="email_address1"><strong>Subscription Duration</strong></label> --}}
                                    {{--                                            <input type="text" name="subscription_duration" class="form-control"> --}}
                                    {{--                                        </div> --}}
                                    {{--                                    </div> --}}


                                    <label class="mt-3"><strong>Media Gallery</strong></label>
                                    <div class="multiimage">
                                        <div class="row wow-remove">
                                            <div class="col">
                                                <div class="main_container m-3">
                                                    <div class="main imagebox position-relative rounded-3 overflow-hidden">
                                                        <div
                                                            class="select_img d-flex justify-content-center align-items-center">
                                                            <div class="dz-message p-3 text-center">
                                                                <h3>Click to upload.</h3>
                                                            </div>
                                                        </div>
                                                        <input type="file" name="image"
                                                            accept=".jpg,.gif,.png,.webp"
                                                            class="main_file w-100 h-100 form-control position-absolute  opacity-0" />
                                                        <div class="img-thumb">
                                                        </div>
                                                    </div>
                                                    <a
                                                        class="btn mt-3  fw-normal remove_clone border-0 shadow-none">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="d-none  cloner" style="display:none;">
                    <div class="row wow-remove">
                        <div class="col">
                            <div class="main_container m-3">
                                <div class="main imagebox position-relative rounded-3 overflow-hidden">
                                    <div class="select_img d-flex justify-content-center align-items-center">
                                        <div class="dz-message p-3 text-center">
                                            <h3>Click to upload.</h3>
                                        </div>
                                    </div>
                                    <input type="file" name="image"
                                        class="main_file w-100 h-100 form-control position-absolute  opacity-0" />
                                    <div class="img-thumb">
                                    </div>
                                </div>
                                <a class="btn mt-3  fw-normal remove_clone border-0 shadow-none">Remove</a>
                            </div>
                        </div>

                    </div>
                </div>
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
<!--                        <div class=" col-md-6">-->
<!--                            <label for="email_address1"><strong> Minimum </strong> Number of Pages-->
<!--                                Allowed-->
<!--                                in AddOn by customer </label>-->
<!--                            <div class="form-group">-->
<!--                                <div class="form-line">-->
<!--                                    <input type="number" class="form-control"-->
<!--                                        name="minimum_addon_allowed" placeholder="Manimum no of pages"-->
<!--                                        min="1">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class=" col-md-6">-->
<!--                            <label for="email_address1"><strong> Maximum </strong> Number of Pages-->
<!--                                Allowed-->
<!--                                in AddOn by customer </label>-->
<!--                            <div class="form-group">-->
<!--                                <div class="form-line">-->
<!--                                    <input type="number" id="erp_question_text" class="form-control"-->
<!--                                        name="maximum_addon_allowed" placeholder="Maximum no of pages"-->
<!--                                        min="1">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
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
            console.log(e);
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
        $(document).ready(function() {



            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_clone'); //Add button selector
            var wrapper = $('.team_main'); //Input field wrapper
            var fieldHTML = jQuery('.cloner .row');
            var fieldHTML2 =
                '<a href="javascript:void(0);" class="remove_button btn btn-dark mx-1">Cancel</a>';
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(document).on('click', '.add_clone', function() {
                var wow = $(this);
                //Check maximum number of input fields
                if (x < maxField) {
                    x++;
                    $(wow).parents('.multiimage').append($(fieldHTML).clone());
                }
            });
            //Once remove button is clicked
            $(document).on('click', '.remove_clone', function(e) {

                $(this).parents('.wow-remove').remove(); //Remove field html
                if ($(".multiimage .row").length == 0) {
                    $('.multiimage').append($(fieldHTML).clone());

                }

            });
        });

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
