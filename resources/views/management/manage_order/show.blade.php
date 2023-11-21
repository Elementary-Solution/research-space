@extends('management.layouts.master')
@section('title')
    Manage Order
@endsection
@section('content')
    <style>
        .text-white {
            color: white !important
        }

        .types {
            font-style: italic;
            background-color: #f1efef;
            color: #070808;
            font-size: 14px;
            letter-spacing: 0.5px;
            padding: 10px 15px 10px 15px;
            border-radius: 20px;
            text-align: center;
            margin: 3px auto !important;
            display: inline-flex;
            align-items: center;
        }

        #chat-conversation {
            overflow-y: auto
        }

        .text-uppercase {
            text-transform: uppercase !important
        }

        .btn.btn-primary {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
        }

        .message .str {
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 14px;
            background: #0000000f;
            padding: 10px;
            border-radius: 10px;
            margin-block: 10px
        }

        .message .str a {
            margin-bottom: 0;
            background: white;
            color: black;
            display: flex;
            width: 42px;
            text-transform: uppercase;
            height: 42px;
            font-size: 10px;
            border-radius: 6px;
            justify-content: center;
            align-items: center;
        }

        .message .str p {
            margin: 0
        }

        #slimScrollDiv,
        .slimScrollDiv,
        .chat .chat-history {
            height: 100% !important;
        }

        #slimScrollDiv #chat-conversation {
            height: 100% !important;
        }




        .file {
            position: relative;
            /* max-width: 22.5rem; */
            font-size: 1.0625rem;
            font-weight: 600;
        }

        .file__input,
        .file__value {
            background-color: rgb(255, 255, 255);
            border-radius: 3px;
            margin-bottom: 0.875rem;
            color: rgba(255, 255, 255, 0.3);
            padding: 0.9375rem 1.0625rem;
        }

        .file__value--text,
        .file__value--remove {
            color: black
        }

        .file__input--file {
            position: absolute;
            opacity: 0;
        }

        .file__input--label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0;
            cursor: pointer;
        }

        .file__input--label:after {
            content: attr(data-text-btn);
            border-radius: 3px;
            background-color: #5783c7;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.18);
            padding: 0.9375rem 1.0625rem;
            margin: -0.9375rem -1.0625rem;
            color: white;
            cursor: pointer;
        }

        .file__value {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: rgba(255, 255, 255, 0.6);
        }

        .file__value:hover:after {
            color: white;
        }

        .file__value:after {
            content: 'X';
            cursor: pointer;
            color: black;

        }

        .file__value:after:hover {
            color: black;
        }

        .file__remove {
            display: block;
            width: 20px;
            height: 20px;
            border: 1px solid #000;
        }

        .wrap {
            border-radius: 4px;
            background-color: #c3c3c347;
            box-shadow: 0 1px 2px 0 #c9ced1;
            padding: 1.25rem;
            margin-top: 2em;
        }
    </style>

    <div class="container-fluid px-4">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="breadcrumb breadcrumb-style ">
                    <li class="breadcrumb-item d-flex justify-content-between w-100">
                        <h4 class="page-title">Manage Order</h4>
                        <div class="">

                            <button class="btn btn-primary w-auto text-left mb-3 h-auto width100 btnOrdersDetail"
                                style="display: block;    width: 100%" data-type="return-to-available" data-toggle="modal"
                                data-target="#status">Manage Status <info></info>
                            </button>
                        </div>

                    </li>
                </ul>

                <div class="modal fade" id="status" tabindex="-1" role="dialog" aria-labelledby="formModal"
                    aria-hidden="true">
                    <form method="POST" id="manageStatus">
                        @csrf
                        @method('POST')

                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="create_questions">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="color: black" id="formModal">
                                            Manage Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                    </div>
                                    <div class="container">
                                        <div class="form-group row mx-auto">
                                            <div class="col-sm-12">

                                                <select class="form-control" name="status">
                                                    <option value="{{ $data->erp_status }}" selected hidden>
                                                        {{ (((($data->erp_status === '1' ? '' : $data->erp_status === '0') ? 'Pending' : $data->erp_status === '2') ? 'Progress' : $data->erp_status === '3') ? 'Completed' : $data->erp_status === '4') ? 'Canceled' : '' }}
                                                    </option>
                                                    <option value="0">Pending</option>
                                                    <option value="2">Progress</option>
                                                    <option value="3">Completed</option>
                                                    <option value="4">Canceled</option>

                                                </select>

                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer pb-0">

                                            <button type="button" data-dismiss="modal" class="btn btn-primary"
                                                aria-label="Close">No
                                            </button>
                                            <button type="submit" class="btn btn-primary">Yes</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card mb-0">
                    <div class="header p-0">
                        <div class="body table-responsive p-0">
                            <div class="row w-100 mx-auto">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card mb-0">
                                        <div class="body">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                                <li role="presentation">
                                                    <a href="#home" data-toggle="tab" class="active show">Details</a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#profile" data-toggle="tab">Message</a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#messages" data-toggle="tab">Files</a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#setting" data-toggle="tab">Rating & Review</a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#note" data-toggle="tab">Note</a>
                                                </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade in active show" id="home">
                                                    <div id="tab1" class="pt-3 tab-pane fade in active show">
                                                        <div class="row blockquote w-100 mx-auto">
                                                            <div class="col-12 ">

                                                                <button
                                                                    class="btn btn-primary w-auto text-left mb-3 h-auto width100 btnOrdersDetail"
                                                                    style="display: block;
                                                                        width: 100%"
                                                                    data-type="return-to-available" data-toggle="modal"
                                                                    data-target="#add">Send Message <info></info>
                                                                </button>
                                                            </div>

                                                            <div class="modal fade" id="add" tabindex="-1"
                                                                role="dialog" aria-labelledby="formModal"
                                                                aria-hidden="true">
                                                                <form action="http://wms.writing-space.com/instructions"
                                                                    method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="erp_order_id"
                                                                        value="">
                                                                    <input type="hidden" name="erp_user_id"
                                                                        value="">

                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="create_questions">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        style="color: black"
                                                                                        id="formModal">
                                                                                        Additional instruction</h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span aria-hidden="true">x</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="container">
                                                                                    <div class="form-group row mx-auto">
                                                                                        <div class="col-sm-12">

                                                                                            <textarea class="form-control" name="erp_message"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer pb-0">

                                                                                        <button type="button"
                                                                                            data-dismiss="modal"
                                                                                            class="btn btn-primary"
                                                                                            aria-label="Close">No
                                                                                        </button>
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary">Yes</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>



                                                            <div class="col-md-10">


                                                                <div class="row pb-5">
                                                                    <div class="col-md-12 mb-3">

                                                                        <span class="types">
                                                                            Order ID :
                                                                            {{ $data->id ?? '' }}
                                                                        </span>
                                                                        <span class="types">
                                                                            Number of Pages:
                                                                            {{ $data->erp_number_Pages ?? '' }}
                                                                        </span>
                                                                        <span class="types">
                                                                            Topic:
                                                                            {{ $data->erp_order_topic ?? '' }}
                                                                        </span>
                                                                        <span class="types">
                                                                            Spacing:
                                                                            {{ $data->erp_spacing ?? '' }}

                                                                        </span>



                                                                        <span class="types">
                                                                            Sources:
                                                                            {{ $data->erp_resource_materials ?? '' }}
                                                                        </span>

                                                                        <span class="types">
                                                                            Customer’s
                                                                            Deadline:

                                                                            @if ($data->erp_deadline === 'erp_eight_hrs')
                                                                                8 hours
                                                                            @elseif($data->erp_deadline === 'erp_tf_hrs')
                                                                                24 hours
                                                                            @elseif($data->erp_deadline === 'erp_fe_hrs')
                                                                                48 hours
                                                                            @elseif($data->erp_deadline === 'erp_three_days')
                                                                                3 days
                                                                            @elseif($data->erp_deadline === 'erp_five_days')
                                                                                5 days
                                                                            @elseif($data->erp_deadline === 'erp_seven_days')
                                                                                7 days
                                                                            @elseif($data->erp_deadline === 'erp_fourteen_days')
                                                                                14 days
                                                                            @elseif($data->erp_deadline === 'erp_fourteen_plus_days')
                                                                                14+ days
                                                                            @endif
                                                                        </span>
                                                                        <span class="types">
                                                                            Paper Format:
                                                                            {{ $data->erp_paper_format ?? '' }}

                                                                        </span>

                                                                        <span class="types">
                                                                            Academic Level:
                                                                            {{ $data->erp_academic_name ?? '' }}



                                                                        </span>

                                                                        <span class="types">
                                                                            Paper Type:
                                                                            {{ $data->erp_paper_type ?? '' }}

                                                                        </span>
                                                                        @if ($data->papertype_file)
                                                                            <span class="types">

                                                                                Paper Type file =
                                                                                <a href="https://eliteblue.net/research-space/public/uploads/{{ $data->id }}/{{ $data->papertype_file }}"
                                                                                    download><i
                                                                                        class="fa fa-file fa-2x mx-2"
                                                                                        aria-hidden="true"> </i></a>

                                                                            </span>
                                                                        @endif
                                                                        @if ($data->paperformat_file)
                                                                            <span class="types">
                                                                                Paper Format file =

                                                                                <a href="https://eliteblue.net/research-space/public/uploads/{{ $data->id }}/{{ $data->paperformat_file }}"
                                                                                    download><i
                                                                                        class="fa fa-file fa-2x mx-2"
                                                                                        aria-hidden="true"> </i></a>

                                                                            </span>
                                                                        @endif
                                                                        @if ($data->erp_resource_file)
                                                                            <span class="types">
                                                                                Customer Resource File =

                                                                                <a href="https://eliteblue.net/research-space/public/{{ $data->erp_resource_file }}"
                                                                                    download><i
                                                                                        class="fa fa-file fa-2x mx-2"
                                                                                        aria-hidden="true"> </i></a>

                                                                            </span>
                                                                        @endif


                                                                        <span class="types">
                                                                            Paper Type description:
                                                                            {{ $data->papertype_desc ?? '' }}

                                                                        </span>

                                                                        <span class="types">

                                                                            Paper format description:
                                                                            {{ $data->paperformat_desc ?? '' }}


                                                                        </span>





                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <span class="types text-left d-block">
                                                                            PowerPoint Slides :
                                                                            {{ $data->erp_powerPoint_slides ?? '' }}

                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <span class="types text-left d-block">
                                                                            1-Page Summary:
                                                                            {{ $data->erp_page_summary ?? '' }}

                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <span class="types text-left d-block">
                                                                            Statistical Analysis:
                                                                            {{ $data->erp_statistical_analysis ?? '' }}

                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <span class="types text-left d-block">
                                                                            Abstract:
                                                                            {{ $data->erp_abstract_page ?? '' }}

                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <span class="types text-left d-block">

                                                                            A Copy of Sources:
                                                                            {{ $data->erp_copy_sources ?? '' }}

                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <span class="types text-left d-block">

                                                                            Outline in Bullets:
                                                                            {{ $data->erp_paper_outline ?? '' }}

                                                                        </span>

                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class="col-md-2">
                                                                <span class="types  d-block text-left">
                                                                    <h5 class="font-weight-bold"> Order Deadline:
                                                                    </h5>
                                                                    <p class="mb-0" id="dateTime">
                                                                        {{ date('d-M-Y h:i A', strtotime($data->erp_datetime)) }}
                                                                    </p>
                                                                </span>

                                                                {{-- <script>
                                                                    var dateTime = document.getElementByIs('dateTime');
                                                                    var date = new Date(dateTime);
                                                                    console.log(date);
                                                                </script> --}}
                                                                <span class="types  d-block text-left">
                                                                    <h5 class="font-weight-bold"> Time Left : </h5>
                                                                    {{ $remaintime }}
                                                                </span>


                                                                <div class="table-responsive d-none">
                                                                    <table class="table table-bordered">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Order Deadline: 10-06-2022 08:16
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Time Left
                                                                                    : 0 Days 15 Hours 39 Minutes
                                                                                </td>

                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="profile">
                                                    <div class="row">
                                                        <div class="col-12 ">

                                                            <button
                                                                class="btn btn-primary w-auto text-left mb-3 h-auto width100 btnOrdersDetail"
                                                                style="display: block;
                                                                    width: 100%"
                                                                data-toggle="modal" data-target="#message">Send Message
                                                                <info></info>
                                                            </button>
                                                        </div>

                                                        <div class="modal fade" id="message" tabindex="-1"
                                                            role="dialog" aria-labelledby="formModal"
                                                            aria-hidden="true">
                                                            <form id="messageForm" method="POST">
                                                                @csrf
                                                                @method('POST')
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="create_questions">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    style="color: black" id="formModal">
                                                                                    Send Message</h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">x</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="container">
                                                                                <div class="form-group row mx-auto">
                                                                                    <div class="col-sm-12">

                                                                                        <input class="form-control"
                                                                                            required
                                                                                            placeholder="Type Message..."
                                                                                            name="txt"></input>
                                                                                        <div class="d-none">

                                                                                            <input class="form-control"
                                                                                                name="type"
                                                                                                value='message'></input>
                                                                                            <input type="text"
                                                                                                name="order_id"
                                                                                                id="orderId"
                                                                                                value="{{ $data->id }}">
                                                                                            <input type="text"
                                                                                                id="userToken"
                                                                                                value="{{ auth()->user()->user_token }}"
                                                                                                name="user_token">
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer pb-0">

                                                                                    <button type="button"
                                                                                        data-dismiss="modal"
                                                                                        class="btn btn-primary"
                                                                                        aria-label="Close">No
                                                                                    </button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary">Yes</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                        </div>

                                                        <div class="col-12">
                                                            <div class="card m-0">
                                                                <div class="chat">
                                                                    <div class="slimScrollDiv"
                                                                        style="position: relative; overflow: hidden; width: auto;    max-height: 56vh;height: 100%">
                                                                        <div class="chat-history" id="chat-conversation"
                                                                            style="overflow: hidden; width: auto;    overflow-y: auto;  max-height: 56vh; height: 100%">
                                                                            <ul class="mb-0" id="messagesBox">

                                                                                @foreach ($messages as $item)
                                                                                    @if ($item['type'] === 'message')
                                                                                        <li class="clearfix">
                                                                                            <div
                                                                                                class=" {{ $item['user_token'] === auth()->user()->user_token ? 'message-data text-right mb-2' : 'message-data' }}">

                                                                                                <span
                                                                                                    class="message-data-time">{{ $item['created_at'] }}</span>
                                                                                                &nbsp; &nbsp;
                                                                                                <span
                                                                                                    class="message-data-name">{{ $item['user_token'] === auth()->user()->user_token ? 'You' : $item['name'] }}</span>
                                                                                                <i
                                                                                                    class="zmdi zmdi-circle me"></i>
                                                                                            </div>
                                                                                            <div
                                                                                                class="{{ $item['user_token'] === auth()->user()->user_token ? 'message other-message float-right' : 'message my-message' }}">

                                                                                                {{ $item['title'] }}


                                                                                            </div>
                                                                                        </li>
                                                                                    @endif
                                                                                @endforeach


                                                                            </ul>
                                                                        </div>
                                                                        <div class="slimScrollBar"
                                                                            style="background: rgb(0, 0, 0); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 131.161px;">
                                                                        </div>
                                                                        <div class="slimScrollRail"
                                                                            style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="messages">
                                                    <div class="row">
                                                        <div class="col-12 ">

                                                            <button
                                                                class="btn btn-primary w-auto text-left mb-3 h-auto width100 btnOrdersDetail"
                                                                style="display: block;
                                                                    width: 100%"
                                                                data-toggle="modal" data-target="#files">Send Files

                                                            </button>
                                                        </div>

                                                        <div class="modal fade" id="files" tabindex="-1"
                                                            role="dialog" aria-labelledby="formModal"
                                                            aria-hidden="true">
                                                            <form id="filesForm" method="POST">
                                                                @csrf
                                                                @method('POST')
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="create_questions">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    style="color: black" id="formModal">
                                                                                    Send File</h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">x</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="container">
                                                                                <div class="form-group row mx-auto">
                                                                                    <div class="col-sm-12">

                                                                                        <input class="form-control"
                                                                                            placeholder="Type Message..."
                                                                                            name="txt"></input>


                                                                                        <div class="wrap">


                                                                                            <div class="file">
                                                                                                <div class="file__input"
                                                                                                    id="file__input">
                                                                                                    <input
                                                                                                        class="file__input--file"
                                                                                                        id="customFile"
                                                                                                        type="file"
                                                                                                        required
                                                                                                        multiple="multiple"
                                                                                                        name="file[]" />
                                                                                                    <label
                                                                                                        class="file__input--label"
                                                                                                        for="customFile"
                                                                                                        data-text-btn="Upload">Add
                                                                                                        file:</label>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>

                                                                                        <div class="d-none">

                                                                                            <input class="form-control"
                                                                                                name="type"
                                                                                                value='file'></input>
                                                                                            <input type="text"
                                                                                                name="order_id"
                                                                                                id="orderId"
                                                                                                value="{{ $data->id }}">
                                                                                            <input type="text"
                                                                                                id="userToken"
                                                                                                value="{{ auth()->user()->user_token }}"
                                                                                                name="user_token">
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer pb-0">

                                                                                    <button type="button"
                                                                                        data-dismiss="modal"
                                                                                        class="btn btn-primary"
                                                                                        aria-label="Close">No
                                                                                    </button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary">Yes</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                        </div>



                                                        <div class="col-12">
                                                            <div class="card m-0">
                                                                <div class="chat">
                                                                    <div class="slimScrollDiv"
                                                                        style="position: relative; overflow: hidden; width: auto;    max-height: 56vh;height: 100%">
                                                                        <div class="chat-history" id="chat-conversation"
                                                                            style="overflow: hidden; width: auto;    overflow-y: auto;  max-height: 56vh; height: 100%">
                                                                            <ul class="mb-0" id="filesBox">

                                                                                @foreach ($messages as $item)
                                                                                    @if ($item['type'] === 'file')
                                                                                        {{-- @dd($messages) --}}

                                                                                        <li class="clearfix">
                                                                                            <div
                                                                                                class=" {{ $item['user_token'] === auth()->user()->user_token ? 'message-data text-right mb-2' : 'message-data' }}">
                                                                                                <span
                                                                                                    class="message-data-time">{{ $item['created_at'] }}</span>
                                                                                                &nbsp; &nbsp;
                                                                                                <span
                                                                                                    class="message-data-name">{{ $item['user_token'] === auth()->user()->user_token ? 'You' : $item['name'] }}</span>
                                                                                                <i
                                                                                                    class="zmdi zmdi-circle me"></i>
                                                                                            </div>
                                                                                            <div
                                                                                                class="{{ $item['user_token'] === auth()->user()->user_token ? 'message other-message float-right' : 'message my-message' }}">

                                                                                                @foreach ($item['files'] as $files)
                                                                                                    <div class='str'>
                                                                                                        <a href='//eliteblue.net/research-space/{{ $files['file'] }}'
                                                                                                            class="fileIcon text-uppercase fw-bold"
                                                                                                            download>

                                                                                                            {{ explode('.', $files['file_name'])[1] }}
                                                                                                        </a>
                                                                                                        <p
                                                                                                            class="mb-0 fileName">
                                                                                                            {{ $files['file_name'] }}
                                                                                                        </p>
                                                                                                    </div>
                                                                                                @endforeach

                                                                                                {{ $item['title'] }}

                                                                                            </div>
                                                                                        </li>
                                                                                    @endif
                                                                                @endforeach

                                                                            </ul>
                                                                        </div>
                                                                        <div class="slimScrollBar"
                                                                            style="background: rgb(0, 0, 0); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 131.161px;">
                                                                        </div>
                                                                        <div class="slimScrollRail"
                                                                            style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="setting">
                                                    <b>Settings Content</b>
                                                    <p>
                                                        Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit
                                                        mediocritatem an. Pri ut tation electram moderatius.
                                                        Per te suavitate democritum. Duis nemore probatus ne quo, ad liber
                                                        essent
                                                        aliquid
                                                        pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu
                                                        munere
                                                        gubergren
                                                        sadipscing mel.
                                                    </p>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="note">
                                                    <b>Settings Content</b>
                                                    <p>
                                                        Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit
                                                        mediocritatem an. Pri ut tation electram moderatius.
                                                        Per te suavitate democritum. Duis nemore probatus ne quo, ad liber
                                                        essent
                                                        aliquid
                                                        pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu
                                                        munere
                                                        gubergren
                                                        sadipscing mel.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {


            $('.file__input--file').on('change', function(event) {
                var files = event.target.files;
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    $("<div class='file__value'><div class='file__value--text'>" + file.name +
                        "</div><div class='file__value--remove' data-id='" + file.name +
                        "' ></div></div>").insertAfter('#file__input');
                }
            });

            $('body').on('click', '.file__value', function() {
                $(this).remove();
            });



        });

        messageForm.addEventListener("submit", handlePost, false);
        filesForm.addEventListener("submit", handlePostFile, false);
        manageStatus.addEventListener("submit", handlePostStatus, false);

        function handlePostFile(e, type) {

            e.preventDefault();

            filesForm.querySelector('button[type="submit"]').innerHTML = `<div class="preloader pl-size-xs">
                                    <div class="spinner-layer pl-grey">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div> Sending`;

            const data = new FormData(e.target);

            fetch('https://eliteblue.net/research-space/api/webs/manage-files', {
                    method: 'POST',
                    body: data,
                })
                .then((res) => res.json())
                .then((data) => {



                    if (data.success) {
                        filesForm.querySelector('button.close').click();
                        filesForm.querySelector('[name="txt"]').value = '';

                        var filesHtml = '';

                        data.files.forEach(item => {

                            filesHtml += ` <div class='str'>
                                    <a href='//eliteblue.net/research-space/${ item.file }'
                                        class="fileIcon text-uppercase fw-bold"
                                        download>

                                        ${ item.file_name.split('.')[1]}
                                        </a>
                                        <p
                                        class="mb-0 fileName">
                                        
                                        ${ item.file_name }
                                    </p>
                                </div>`;
                        });

                        filesBox.innerHTML += `
                        <li class="clearfix">
                            <div
                                class="message-data text-right mb-2">
                                <span
                                    class="message-data-time">${data.created_at}</span> &nbsp; &nbsp;
                                    <span class="message-data-name">You</span>
                               
                                <i class="zmdi zmdi-circle me"></i>
                            </div>
                            <div class="message other-message float-right"> ${filesHtml}
                                                                                              
                            ${data.title}  
                            
                            </div>
                        </li>
                        `;



                    } else {

                    }

                    filesForm.querySelector('button[type="submit"]').innerHTML = `Send`;


                })
                .catch((err) => {
                    console.log(err);
                    filesForm.querySelector('button[type="submit"]').innerHTML = `Send`;

                });
        }

        function handlePost(e) {

            e.preventDefault();

            messageForm.querySelector('button[type="submit"]').innerHTML = `<div class="preloader pl-size-xs">
                                    <div class="spinner-layer pl-grey">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div> Sending`;

            const data = new FormData(e.target);

            fetch('https://eliteblue.net/research-space/api/webs/manage-files', {
                    method: 'POST',
                    body: data,
                })
                .then((res) => res.json())
                .then((data) => {

                    if (data.success) {

                        messageForm.querySelector('button.close').click();
                        messageForm.querySelector('[name="txt"]').value = '';

                        messagesBox.innerHTML += `
                        <li class="clearfix">
                            <div
                                class="message-data text-right mb-2">
                                <span
                                    class="message-data-time">${data.created_at}</span> &nbsp; &nbsp;
                                    <span class="message-data-name">You</span>
                                <i class="zmdi zmdi-circle me"></i>
                            </div>
                            <div class="message other-message float-right">
                            ${data.title}  
                            </div>
                        </li>
                        `;

                    } else {

                    }
                    messageForm.querySelector('button[type="submit"]').innerHTML = `Send`;

                })
                .catch((err) => {
                    messageForm.querySelector('button[type="submit"]').innerHTML = `Send`;
                    console.log(err);
                });
        }

        function handlePostStatus(e) {

            e.preventDefault();

            manageStatus.querySelector('button[type="submit"]').innerHTML = `<div class="preloader pl-size-xs">
                                    <div class="spinner-layer pl-grey">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div> Sending`;

            const data = new FormData(e.target);



            fetch('https://eliteblue.net/research-space/api/webs/manage-status', {
                    method: 'POST',
                    body: data,
                })
                .then((res) => res.json())
                .then((data) => {
                    manageStatus.querySelector('button[type="submit"]').innerHTML = `Send`;

                })
                .catch((err) => {
                    manageStatus.querySelector('button[type="submit"]').innerHTML = `Send`;
                    console.log(err);
                });
        }
    </script>
@endsection
