@extends('layouts.dashboard')

@section('title')
    پنل صرافی
@endsection

@section('content')

    @include('partials.header')

    <div class="clearfix"></div>

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
                            <h4 class="widget-thumb-heading">تعداد تراکنش های امروز</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-casablanca icon-graph"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">تراکنش</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="{{ number_format($today['count']) }}">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">جمع مبلغ مبادله شده امروز</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-haze fa fa-money"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">ریال</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="{{ number_format($today['sum']) }}">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">تعداد کاربران تائید نشده</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-lemon icon-user-unfollow"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">نفر</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="{{ number_format($top_widget['unauthorized_users_count']) }}">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">کاربران استفاده کننده</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow icon-user-following"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">نفر</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="{{ number_format($top_widget['users_count']) }}">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>
                </div>

                <div class="row">
                    {{-- Exchage Rate Setting Form --}}
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                        @include('partials.ratePortlet')
                    </div>

                    {{-- Top Transactions List --}}
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                        <div class="portlet light" id="perWrapperContainer">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold">لیست</span>
                                    <span class="caption-helper">تراکنش های بخصوص</span>
                                </div>
                                <div class="actions">
                                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                                        <label class="specialAnchor btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm active">
                                            <input type="radio" name="options" class="toggle" data-per="daily" data-perName="روزانه" id="option1">روزانه
                                        </label>
                                        <label class="specialAnchor btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm">
                                            <input type="radio" name="options" class="toggle" data-per="weekly" data-perName="هفتگی" id="option2">هفتگی
                                        </label>
                                        <label class="specialAnchor btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm">
                                            <input type="radio" name="options" class="toggle" data-per="monthly" data-perName="ماهانه" id="option2">ماهانه
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="portlet-body" id="perWrapper">
                                @include('partials.specialTrans', ['today' => $today])
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
@endsection

@section('scripts')
@endsection
