@extends('management.layouts.master')
@section('title')
    Users-info
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
                                <h4 class="page-title">     Users-info
                                </h4>
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
                                    <div class="container">
                                        <div class="row">
{{--                                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 ">--}}
{{--                                                <ul class="breadcrumb breadcrumb-style ">--}}
{{--                                                    <li class="breadcrumb-item">--}}
{{--                                                        <h4 class="page-title"> My Profile</h4>--}}
{{--                                                    </li>--}}

{{--                                                </ul>--}}
{{--                                            </div>--}}
                                            <div class=" image d-none">
                                                <img src="http://wms.writing-space.com/management/images/usrbig.jpg" class="img-circle user-img-circle" alt="User Image">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 ">
                                                <div class="card body">
                                                    <div class="row">
                                                        <div class="contact-photo">
                                                            <a href="" style="width:80px;">
                                                                @if($user->image!= null)
                                                                    @php $image = 'profile/'.$user->image @endphp
                                                                @else

                                                                    @php $image = 'profile/avatar.png' @endphp
                                                                @endif
                                                                <img style="" src="{{asset('images'.'/'.$image)}}" height="110px" width="150px">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="contact-usertitle">
                                                        <div class="contact-usertitle-name">{{$user->name}}</div>
                                                        <div class="contact-usertitle-job">
{{--                                                            <button type="button" class="btn btn-border-radius bg-primary waves-effect">admin </button>--}}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-8 ">

                                                <div class="card">

                                                    <div class="row">
                                                        <div class="col-lg-12 col-12">
                                                            <ul class="nav nav-tabs" id="myTab" role="tablist" style="padding: 20px 30px" ;="">

                                                                <li class="nav-item">
                                                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">PROFILE</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Wish List</a>
                                                                </li>



                                                            </ul>
                                                            <div class="tab-content" id="myTabContent" style="padding: 20px 30px" ;="">
                                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                                                                    <form method="POST" id="home" action="http://wms.writing-space.com/myprofile/1" enctype="multipart/form-data" "="">
                                                                    <input type="hidden" name="_token" value="JMRP0ZDLiJjdnb2jeeP6LqofgkZkIg9QRNVxhU7r">                              <input type="hidden" name="_method" value="PUT">                            <div class="row ">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <div class="form-line focused">
                                                                                    <input value="{{$user->name}}" type="text" name="name" id="name" class="form-control" placeholder="Full Name" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="form-line focused">
                                                                                    <input value="{{$user->email}}"  type="email"  name="email" id="email" class="form-control" placeholder="Email" readonly="">


                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="form-line">
                                                                                    <input value="{{$user->phone_number ? $user->phone_number : 'N/A' }}"   name="email" id="email" class="form-control" placeholder="Email" readonly="">

                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                </form>

            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <form method="POST" id="home" action="http://wms.writing-space.com/security/1" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="JMRP0ZDLiJjdnb2jeeP6LqofgkZkIg9QRNVxhU7r">                            <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                       @foreach($reaction as $data)


                           {{$data->id}}

                        @endforeach
                    </div>
                </form>
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
                </form>


@endsection

