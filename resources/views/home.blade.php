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
                    <div class="col-md-4">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">تعداد تراکنش های امروز</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-casablanca icon-graph"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">تراکنش</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="{{ number_format($today['count']) }}">0</span>
                                          {{--data-value="{{ number_format($top_widget['transactions_count']) }}">0</span>--}}
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-4">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">جمع مبلغ مبادله شده امروز</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-haze fa fa-money"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">ریال</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="{{ number_format($today['sum']) }}">0</span>
                                          {{--data-value="{{ number_format($top_widget['transactions_sum']) }}">0</span>--}}
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    {{--<div class="col-md-3">--}}
                        {{--<!-- BEGIN WIDGET THUMB -->--}}
                        {{--<div class="widget-thumb widget-bg-color-white margin-bottom-20 ">--}}
                            {{--<h4 class="widget-thumb-heading">تعداد کاربران تائید نشده</h4>--}}
                            {{--<div class="widget-thumb-wrap">--}}
                                {{--<i class="widget-thumb-icon bg-yellow-lemon icon-shuffle"></i>--}}
                                {{--<div class="widget-thumb-body">--}}
                                    {{--<span class="widget-thumb-subtitle">نفر</span>--}}
                                    {{--<span class="widget-thumb-body-stat" data-counter="counterup"--}}
                                          {{--data-value="{{ number_format($top_widget['euro_last_rate']) }}">0</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- END WIDGET THUMB -->--}}
                    {{--</div>--}}

                    <div class="col-md-4">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">کاربران استفاده کننده</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow icon-user"></i>
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
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold">لیست</span>
                                    <span class="caption-helper">تراکنش های بخصوص</span>
                                </div>
                                <div class="actions">
                                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                                        <label class="btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm active">
                                            <input type="radio" name="options" class="toggle"
                                                   id="option1">روزانه</label>
                                        {{--<label class="btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm">--}}
                                            {{--<input type="radio" name="options" class="toggle" id="option2">هفتگی</label>--}}
                                        {{--<label class="btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm">--}}
                                            {{--<input type="radio" name="options" class="toggle"--}}
                                                   {{--id="option2">ماهانه</label>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row number-stats margin-bottom-30">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="stat-left">
                                            <div class="stat-chart">
                                                <div id="sparkline_bar"></div>
                                            </div>
                                            <div class="stat-number">
                                                <div class="title" style="padding-bottom: 5px"> جمع پرداختی های امروز
                                                    <small>(ریال)</small>
                                                </div>
                                                <div class="number">{{ number_format($today['sum']) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="stat-right">
                                            <div class="stat-chart">
                                                <div id="sparkline_bar2"></div>
                                            </div>
                                            <div class="stat-number">
                                                <div class="title" style="padding-bottom: 5px"> تعداد تراکنش های امروز</div>
                                                <div class="number">{{ number_format($today['count']) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-scrollable table-scrollable-borderless">
                                    @if(count($today['special']) > 0)
                                        <table class="table table-hover table-light">
                                            <thead>
                                            <tr>
                                                <th> کاربر</th>
                                                <th> مبلغ</th>
                                                <th> نرخ تبدیل</th>
                                                <th> تاریخ</th>
                                            </tr>
                                            </thead>
                                            @foreach($today['special'] as $special_tran)
                                                <tr>
                                                    <td class="font-blue-chambray">{{ $special_tran->sender_fname . ' ' . $special_tran->sender_lname }}</td>
                                                    <td class="font-red-haze bold">{{ number_format($special_tran->premium_amount) . ' ' . $special_tran->currency }}</td>
                                                    <td>{{ number_format($special_tran->exchange_rate) }} ریال</td>
                                                    <td>{{ jdate($special_tran->payment_date)->format('%y %B %d , H:i:s') }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <h4 class="font-grey-silver text-center">تراکنشی برای نمایش وجود ندارد</h4>
                                    @endif
                                </div>
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
