@extends('layouts.dashboard')

@section('title')
    پنل کاربری اپلیکیشن شخصی رابین
@endsection

@section('content')

    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo bg-yellow">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('imgs/logo-white.png') }}" alt="logo" class="logo-default" />
                </a>
            </div>
            <!-- END LOGO -->

            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
            <!-- END RESPONSIVE MENU TOGGLER -->

            <!-- BEGIN PAGE ACTIONS -->
            <div class="page-actions">
                <div class="btn-group">
                    <button type="button" id="add_new_btn" class="btn btn-circle btn-outline yellow dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-plus"></i>&nbsp;
                        <span class="hidden-sm hidden-xs">افزودن&nbsp;</span>&nbsp;
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="javascript:;">
                                <i class="icon-docs"></i> پست جدید </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="icon-picture"></i> عکس جدید </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="icon-camcorder"></i> ویدیو جدید </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- END PAGE ACTIONS -->

            <!-- BEGIN PAGE TOP -->
            <div class="page-top">

                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <li class="dropdown dropdown-user dropdown-dark">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="{{ asset('imgs/avatar.png') }}" />
                                <span class="username username-hide-on-mobile"> {{ Auth::user()->first_name.' '.Auth::user()->last_name }} </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="#">
                                        <i class="icon-user"></i> پروفایل من </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-calendar"></i> تقویم </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-envelope-open"></i> نامه ها
                                        <span class="badge badge-danger"> 3 </span>
                                    </a>
                                </li>
                                <li class="divider"> </li>
                                <li style="margin-bottom: 10px">
                                    @if(!Auth::guest())
                                        <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="icon-logout"></i> خروج
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    @endif
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END PAGE TOP -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->

    <div class="clearfix"> </div>

    <!-- BEGIN CONTAINER -->
    <div class="page-container">

        @include('partials.sidemenu', array('li' => 'dashboard'))

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" style="min-height: 700px;">
                <h1 class="page-title"> داشبورد </h1>

                <div class="row widget-row">
                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">تعداد دانلودها</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-casablanca icon-graph"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">نفر</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="7,644">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">کل پست ها</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-haze icon-layers"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">پست</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="24">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">کل نظرات</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-lemon icon-speech"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">نظر</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="666">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">بازدیدها</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow icon-eye"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">نفر</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="5,071">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->

@endsection
