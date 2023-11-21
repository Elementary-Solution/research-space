@extends('management.layouts.master')
@section('title')
    Paper
@endsection
@section('content')
    <div class="container-fluid px-4">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title"> Paper</h4>
                            </li>

                        </ul>
                    </div>
                </div>
                <form action="{{route('paper.update',$paper->id)}}" method="POST" enctype="multipart/form-data">
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
                                                <input value="{{$paper->title ?? ''}}" type="text" id="erp_question_text"
                                                       class="form-control" name="title"
                                                       placeholder="Title" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class=" col-12">
                                            <label for="email_address1"> <strong> Summary </strong></label>
                                            <textarea type="text" name="summary"
                                                      id="erp_order_message" class="ckeditor form-control choices"
                                                      cols="30"
                                                      rows="10">
                                                {{$paper->summary ?? ''}}
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
                                                <option {{$paper->status == '1' ? 'selected' : ''}}   value=1>
                                                    Publish
                                                </option>
                                                <option {{$paper->status == '0' ? 'selected' : ''}}  value=0>draft
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class=" col-12">
                                            <label for="email_address1"><strong>Type</strong> </label>
                                            <select class="form-control select2" name="type" id="type"
                                                    data-placeholder="Select">
                                                <option {{ $paper->type == 1 ? 'Selected' : '' }}  value="1">Premium
                                                </option>
                                                <option {{ $paper->type == 0 ? 'Selected' : '' }}  value="0">Free
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <label class="mt-3"><strong>File Upload</strong></label>
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>File</span>
                                            <input type="file" name="file_upload" accept="application/pdf,application/vnd.ms-excel" multiple="">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text" placeholder="file upload">
                                        </div>
                                    </div>
                                    <label class="mt-3"><strong>View Uploaded File</strong></label>
                                    <div>
                                        <a href="{{asset('document/file'.'/'.$paper->file_upload)}}" target="_blank">{{$paper->file_upload}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
@endsection

