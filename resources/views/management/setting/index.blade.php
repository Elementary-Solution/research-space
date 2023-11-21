@extends('management.layouts.master')
@section('title')
    Theme Settings
@endsection
@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">Settings</h4>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Example Tab -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal">Don't Touch it Developer Use Only </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                     aria-labelledby="formModal" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{url('admin/theme-setting-fields')}}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="formModal">Me Kehta Hun Sochlo!</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    {{--                                                @dd($types);--}}
                                                </div>
                                                <div class="modal-body">

                                                    <label for="type">Select Type For Tabing Purpose</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <select name="type" id="" class="form-control" required>
                                                                <option value="">Select One</option>

                                                                @foreach($types as $key=>$value)
                                                                    <option value="{{$key}}">{{$value}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <label >Title (For Describing Purpose)</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="title"
                                                                   placeholder="Type Title" required>
                                                        </div>
                                                    </div>


                                                    <label >Option Key</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="option_key"
                                                                   placeholder="Type Option Key Format => (option-filter)">
                                                        </div>
                                                    </div>
                                                    <label for="email_address1">Option Input Type</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <select name="input_type" id="" class="form-control">
                                                                <option value="toggle">Toggle</option>
                                                                <option value="checkbox">Radio</option>
                                                            </select>
                                                        </div>
                                                    </div>



                                                    <label >Name Of Input Key</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="input_type_key[]"
                                                                   placeholder="Type Option Key Format => (option-filter)">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="input_type_key[]"
                                                                   placeholder="i.e On / Off or Grid / List">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"
                                                            class="btn btn-info waves-effect">Create</button>
                                                    <button type="button" class="btn btn-danger waves-effect"
                                                            data-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <div class="demo-switch">
                                    <div class="switch developer_switch">
                                        <code class="p-3">
                                            <label>Developer Guide
                                                <input type="checkbox" name="choose[1]">
                                                <span class="lever"></span></label>
                                        </code>

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <?php $i=1?>
                            @foreach($settings as $key=>$value)
                                <li role="presentation">
                                    <a href="#{{$key.$i}}" data-toggle="tab" class="show text-uppercase  {{$i == 1 ? 'active show' : ''}}">{{$key}}</a>
                                </li>
                                <?php $i++?>
                            @endforeach
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <?php $i=1?>
                            @foreach($settings as $key=>$value)
                                <div role="tabpanel" class="tab-pane developer-tool-settings fade in {{$i == 1 ? 'active show' : ''}}" id="{{$key.$i}}">
                                    <div class="row align-items-end my-3 w-100 mx-auto">
                                        <div class="col-md-12 m-0">
                                    <h2 class="text-uppercase">{{$key}}</h2>
                                        </div>
                                    </div>
                                   <form action="{{route('theme-setting.update',$key)}}" method="post">
                                       @csrf
                                       @method('PUT')
                                    @foreach($value as $fields)
                                           <input type="hidden" name="id[]" value="{{$fields->id}}">
                                        <div class="row align-items-end my-3 w-100 mx-auto">
                                            <div class="col-md-4 m-0">
                                                <h6>{{$fields->title}}</h6>
                                                <input type="text" readonly value="{{$fields->option_key}}">
                                            </div>
                                            <div class="col-md-4 m-0 ">
                                                <div class="developer_guide bg-dark p-3 hide">
                                                @if($fields->input_type == 'toggle')
                                                    <code>
                                                    Matching Contidion = on / off
                                                        <br>
                                                    if($variable == on){
                                                            <br>
                                                        Show something
                                                            <br>
                                                    }else{
                                                            <br>
                                                        Hide something
                                                            <br>
                                                    }
                                                        </code>
                                                @else
                                                    <code>
                                                    Matching Contidion =
                                                    @foreach(json_decode($fields->input_type_key) as $radio)
                                                          {{$radio}} /
                                                    @endforeach
                                                        <br>
                                                        if($variable == '{{json_decode($fields->input_type_key)[0]}}'){
                                                        <br>
                                                        Show something
                                                        <br>
                                                        }else{
                                                        <br>
                                                        Hide something
                                                        <br>
                                                        }
                                                    </code>
                                                @endif
                                                    </div>
                                            </div>
                                            <div class="col-md-4 m-0">
                                                @if($fields->input_type == 'toggle')
                                                <div class="demo-switch">
                                                    <div class="switch">
                                                        <label>Show
                                                            <input type="checkbox" {{$fields->choose == 'on' ? 'checked' : ''}} name="choose[{{$fields->id}}]" >
                                                            <span class="lever"></span>Hide</label>
                                                    </div>
                                                </div>
                                                @else

                                                        <div class="row align-items-end">
                                                            @foreach(json_decode($fields->input_type_key) as $radio)
                                                            <div class="col-3 m-0 ">
                                                                <div class="form-check form-check-radio">
                                                                    <label>
                                                                        <input name="choose[{{$fields->id}}]" value="{{$radio}}" {{$radio == $fields->choose ? 'checked' : ''}} type="radio">
                                                                        <span>{{$radio}}</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>

                                                @endif

                                            </div>
                                        </div>
                                    @endforeach
                                       <div class="row w-100 mx-auto my-4">
                                           <div class="col-12">
                                           <button type="submit"
                                                   class="btn btn-primary waves-effect">Update</button>
                                           </div>
                                       </div>

                                   </form>
                                </div>
                                <?php $i++?>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Example Tab -->
    </div>
    <style>
        .developer-tool-settings input[type="text"] {
            font-size: 14px !important;
            line-height: 1px;
            background: #343a40 !important;
            color: #e83e8c;
            padding: 0 10px !important;
        }
    </style>
    <script>
        $('.developer_switch input').on('click',function(){
            $('.developer_guide').toggleClass('hide');

        })
    </script>
@endsection


