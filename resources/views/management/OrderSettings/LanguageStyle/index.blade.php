@extends('management.layouts.master')
@section('title')
    Language Style
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
                                <h4 class="page-title">Language Style</h4>
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
                                    data-target="#exampleModal">Add Language Style
                            </button>
                            @include('management.OrderSettings.LanguageStyle.add')
                        </div>
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Language Style Name</th>
                                <th>Status</th>
                                <th>Actions</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $count=1
                            ?>
                            @foreach($data as $row)
                                <tr>
                                    <th scope="row">{{$count++}}</th>
                                    <td>{{$row->erp_language_name}}</td>
                                    <td><label class="badge badge-{{$row->erp_status == '1' ? 'info':'danger'}}" data-toggle="modal" data-target="#active_inactive">{{$row->erp_status == '1' ? 'Enable':'Disable'}}</label>
                                    </td>


                                    <td>


                                        <button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#exampleModalCenteredit{{$row->id}}">
                                            <i class="material-icons">edit</i>

                                        </button>
                                        @include('management.OrderSettings.LanguageStyle.edit')


                                        <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#exampleModalCenter{{$row->id}}">
                                            <i class="material-icons"> delete  </i>
                                        </button>


                 @if ($row->erp_status == '0')



                                        <div class="modal fade" id="exampleModalCenter{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Delete
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to proceed with this action?
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="submit" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                                        <form action="{{route('language_style.destroy',$row->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="btn btn-info waves-effect">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                            <div class="modal fade" id="exampleModalCenter{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                            Only Disabled Language Style will be deleted
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
