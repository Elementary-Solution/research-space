@extends('management.layouts.master')
@section('title')
    User-info
@endsection
@section('content')

    <div class="container-fluid px-4">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title"> User-info</h4>
                            </li>



                        </ul>
                    </div>
                </div>


                <div class="card">
                    <div class="header">
{{--                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">--}}

{{--                            <a href="{{route('slider.create')}}" type="button" class="btn btn-primary"> Add Slider--}}
{{--                            </a>--}}
{{--                        </div>--}}



                        <div class="body table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                <tr>
                                    <th class="col-lg-3">image</th>
                                    <th class="col-lg-3">Name</th>
                                    <th class="col-lg-3">Email</th>
                                    <th class="col-lg-3">Status</th>
                                    <th class="col-lg-3">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $count=1
                                ?>
                                @foreach($users as $row)
                                    <tr>
                                        <td>

                                            @if($row->image!= null)
                                                @php $image = 'profile/'.$row->image @endphp
                                            @else

                                                @php $image = 'profile/avatar.png' @endphp
                                            @endif
                                            <img style="" src="{{asset('images'.'/'.$image)}}" height="60px" width="60px">
                                        </td>
                                        <td> {{$row->name}}</td>
                                        <td> {{$row->email}}</td>

                                        @if($row->status == 1)
                                            <td><label class="badge badge-info" data-toggle="modal" data-target="#active_inactive">Published</label>

                                            </td>
                                        @else
                                            <td><label class="badge badge-danger" data-toggle="modal" data-target="#active_inactive">Draft</label>

                                            </td>
                                        @endif
                                        <td>

                                            <a class="btn bg-blue btn-circle " href="{{route('user-info.show',$row->id)}}">
                                                <i class="fa fa-arrow-right" aria-hidden="true"></i>

                                                <i class="material-icons" href="">eye</i>
                                            </a>

                                            <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#exampleModalCenter{{$row->id}}">
                                                <i class="material-icons"> delete  </i>
                                            </button>



                                            <div class="modal fade" id="exampleModalCenter{{$row->id}}" tabindex="-1" role="dialog"
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
                                                            Are you sure want to proceed this action?                                           </div>
                                                        <div class="modal-footer">

                                                            <button type="submit" class="btn btn-danger waves-effect"
                                                                    data-dismiss="modal">Close</button>
                                                            <form action="{{route('user-info.destroy',$row->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-info waves-effect">Delete</button>

                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                </form>



@endsection

