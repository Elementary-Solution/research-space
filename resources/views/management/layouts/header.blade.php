
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.radixtouch.in/templates/admin/lorax/source/light/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Jun 2021 10:52:06 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>@yield('title')</title>
    <!-- Favicon-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <link rel="icon" href="{{asset('management/images/favicon.jpeg')}}"
          type="image/x-icon">
    <!-- Plugins Core Css -->
    <link href="{{asset('management/css/app.min.css')}}" rel="stylesheet">
    <!-- Custom Css -->
    <!-- Theme style. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('management/css/styles/all-themes.css')}}" rel="stylesheet" />
    <link href="{{asset('management/css/style.css')}}" rel="stylesheet" />

    <link href="{{asset('management/css/form.min.css')}}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    {{--    <link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
{{--    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">--}}
{{--    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}
{{--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link rel="stylesheet"  href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">


</head>
<style>
    .fw-900{
        font-weight: 900 !important;
    }
    .text-signature {
        color: #E8BC50;
    }
    .bg-signature {
        background: #E8BC50;
    }
</style>
<body class="light">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30">
            <img class="loading-img-spin" src="{{asset('management/images/preloading.png')}}" width="20" height="20" alt="admin">
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="#" onClick="return false;" class="navbar-toggle collapsed" data-toggle="collapse"
               data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="#" onClick="return false;" class="bars"></a>
            <a class="navbar-brand" href="/">
                <img height="35px" src="{{asset('management/images/logo.png')}}" alt="{{config('app.dashboard')}}" />
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="pull-left">
                <li>
                    <a href="#" onClick="return false;" class="sidemenu-collapse">
                        <i class="fas fa-align-justify"></i>                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!-- Full Screen Button -->
                <li class="fullscreen">
                    <a href="javascript:;" class="fullscreen-btn">
                        <i class="fas fa-expand"></i>
                    </a>
                </li>
                <!-- #END# Full Screen Button -->
                <!-- #START# Notifications-->
{{--                @include('Notifications/index');--}}
                <!-- #END# Notifications-->
{{--                <li class="dropdown user_profile">--}}
{{--                    <a href="#" onClick="return false;" class="dropdown-toggle" data-toggle="dropdown"--}}
{{--                       role="button">--}}
{{--                        <img src="{{asset('management/images/user.jpg')}}" width="32" height="32" alt="{{config('app.dashboard')}} | User">--}}
{{--                    </a>--}}
{{--                    <ul class="dropdown-menu pullDown">--}}
{{--                        <li class="body">--}}
{{--                            <ul class="user_dw_menu">--}}
{{--                                <li>--}}
{{--                                    <a href="#" onClick="return false;">--}}
{{--                                        <i class="fas fa-user"></i>Profile--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <form class="m-0" method="POST" action="{{ route('logout') }}">--}}
{{--                                        @csrf--}}
{{--                                        <a href="#"  :href="route('logout')"--}}
{{--                                           onclick="event.preventDefault();--}}
{{--                                                this.closest('form').submit();">--}}
{{--                                            <i class="material-icons">power_settings_new</i> {{ __('Log Out') }}--}}
{{--                                        </a>--}}
{{--                                    </form>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </li>--}}
                <!-- #END# Tasks -->
{{--                <li class="pull-right">--}}
{{--                    <a href="#" onClick="return false;" class="js-right-sidebar" data-close="true">--}}
{{--                        <i class="fas fa-cog"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
</nav>
