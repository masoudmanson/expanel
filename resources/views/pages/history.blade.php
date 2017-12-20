@extends('layouts.dashboard')

@section('title')
    پنل صرافی | تاریخچه ی تراکنش ها
@endsection

@section('content')

    @include('partials.header')

    <div class="clearfix"></div>

    <!-- BEGIN CONTAINER -->
    <div class="page-container">

        @include('partials.sidemenu', array('li' => 'transactions'))

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" style="min-height: 700px;">
                <h1 class="page-title"> تاریخچه ی تراکنش ها </h1>

                <div class="row widget-row">
                    <div class="col-md-4">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">تعداد کل تراکنش ها</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-casablanca icon-graph"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">تراکنش</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="{{ number_format($top_widget['transactions_count']) }}">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-4">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">مجموع مبلغ تراکنش های دریافتی</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-haze fa fa-money"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">ریال</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="{{ number_format($top_widget['transactions_sum_received']) }}">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    {{--<div class="col-md-3">--}}
                        {{--<!-- BEGIN WIDGET THUMB -->--}}
                        {{--<div class="widget-thumb widget-bg-color-white margin-bottom-20 ">--}}
                            {{--<h4 class="widget-thumb-heading">مجموع مبلغ تراکنش های تائید شده</h4>--}}
                            {{--<div class="widget-thumb-wrap">--}}
                                {{--<i class="widget-thumb-icon bg-yellow-lemon fa fa-money"></i>--}}
                                {{--<div class="widget-thumb-body">--}}
                                    {{--<span class="widget-thumb-subtitle">ریال</span>--}}
                                    {{--<span class="widget-thumb-body-stat" data-counter="counterup"--}}
                                          {{--data-value="{{ number_format($top_widget['transactions_sum_accepted']) }}">0</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- END WIDGET THUMB -->--}}
                    {{--</div>--}}

                    <div class="col-md-4">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">مجموع مبلغ حواله های پایان یافته</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue-hoki fa fa-money"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">ریال</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="{{ number_format($top_widget['transactions_sum_done']) }}">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>
                </div>

                <div class="row">
                    {{-- Today's Transactions List --}}
                    <div class="col-lg-12">
                        {{-- Search in Transactions --}}
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold">جستجو</span>
                                    <span class="caption-helper">در لیست تراکنش ها</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="form-body col-xs-12 col-md-8 col-lg-10 pl0">
                                        <div class="form-group">
                                            <input class="form-control input-lg searchForm" data-target=".tableContentWrapper" data-url="/search/histories" placeholder="جستجو کنید" type="text">
                                        </div>
                                    </div>
                                    <div class="form-actions right col-xs-6 col-md-2 col-lg-1 p0">
                                        <button type="submit" class="btn green btn-lg fullWidth searchBtn">بیاب</button>
                                    </div>
                                    <div class="form-actions right col-xs-6 col-md-2 col-lg-1 pr0">
                                        <a href="{{ route('history.index') }}" class="btn grey btn-lg fullWidth">همه</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Search in transactions --}}

                        <div class="portlet light tableContentWrapper">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold">لیست</span>
                                    <span class="caption-helper">تراکنش ها</span>
                                </div>
                                <div class="actions">
                                    <a href="{{route('admin.history.excel')}}" class="btn btn-circle green btn-outline btn-sm">
                                        <i class="fa fa-file-excel-o"></i> Excel </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable table-scrollable-borderless">
                                    <div id="mainFormLoader" style="display:none;">
                                        <div class="errors" style="display: none"></div>
                                        <div class="spinner2">
                                            <div class="bounce1"></div>
                                            <div class="bounce2"></div>
                                            <div class="bounce3"></div>
                                        </div>
                                    </div>

                                    <div id="ajax-transaction-list">
                                        @include('partials.history-table', ['transactions' => $transactions, 'extraInfo' => $extraInfo])
                                    </div>

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
