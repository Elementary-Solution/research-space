

@extends('management.layouts.master')
@section('title')
    Document Type
@endsection
@section('content')

    <div class="container">
        @include('management.layouts.error')
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title">Document Type</h4>
                            </li>

                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-primary float-right mt-3"> Back
                            </button>
                        </a>
                    </div>

                </div>
                <div class="card">
                    <div class="header">
                        <!-- #START# Modal Form Example -->
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <button type="button" class="btn btn-primary " data-toggle="modal"
                                    data-target="#exampleModal"> Add Document email template

                            </button>
                            @include('management.OrderSettings.DocumentType.add')
                        </div>

                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th class="w-25">Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count=1
                            ?>
                            @foreach($data as $row)

                                <tr>
                                    <th scope="row">{{$count++}}</th>
                                    <td>{{$row->erp_document_title}}</td>
                                    <td><label class="badge badge-{{$row->erp_status == '1' ? 'info':'danger'}}" data-toggle="modal" data-target="#active_inactive">{{$row->erp_status == '1' ? 'Enable':'Disable'}}</label>
                                    </td>

                                    <td>
                                    <button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#exampleModal1{{$row->id}}">
                                        <i class="material-icons">edit</i>
                                    </button>

                                    @include('management.OrderSettings.DocumentType.edit')


                                    <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#exampleModalCenter2{{$row->id}}">
                                        <i class="material-icons"> delete  </i>
                                        </button>
                                        @if ($row->erp_status == '0')


                                    <div class="modal fade" id="exampleModalCenter2{{$row->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure want to proceed this action?
                                                </div>
                                                <div class="modal-footer">

                                                    <button type="submit" class="btn btn-danger waves-effect"
                                                            data-dismiss="modal">Close</button>
                                                    <form action="{{route('document_type.destroy',$row->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-info waves-effect">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        @else

                                            <div class="modal fade" id="exampleModalCenter2{{$row->id}}" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content bg-danger">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-white " id="exampleModalCenterTitle" >Alert
                                                                <i class="fas fa-exclamation-triangle"></i></h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true" class="text-white">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-white">
                                                            Only Disabled Document Type will be deleted
                                                        </div>
                                                        <div class="modal-footer">

                                                            <button type="submit" class="btn btn-danger waves-effect"
                                                                    data-dismiss="modal">Close</button>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            <?php
                            $count++;
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

