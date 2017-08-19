@extends('layouts.dashboard')

@section('title')
    پنل صرافی | لیست تراکنش های امروز
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
                <h1 class="page-title"> لیست تراکنش های امروز </h1>

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
                                          data-value="{{ number_format($top_widget['transactions_count']) }}">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">مبلغ مبادله شده امروز</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-haze fa fa-money"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">ریال</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="{{ number_format($top_widget['transactions_sum']) }}">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-6 col-xs-12">

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
                                {{--<form role="form">--}}
                                <div class="row">
                                    <div class="form-body col-xs-9 col-sm-10">
                                        <div class="form-group">
                                            <input class="form-control input-lg searchForm" placeholder="جستجو کنید" type="text" name="input">
                                        </div>
                                    </div>
                                    <div class="form-actions right col-xs-3 col-sm-2">
                                        <button type="submit" class="btn green btn-lg fullWidth">بیاب</button>
                                    </div>
                                </div>
                                {{--</form>--}}
                            </div>
                        </div>
                        {{-- End Search in transactions --}}
                    </div>

                    {{--<div class="col-md-3">--}}
                        {{--<!-- BEGIN WIDGET THUMB -->--}}
                        {{--<div class="widget-thumb widget-bg-color-white margin-bottom-20 ">--}}
                            {{--<h4 class="widget-thumb-heading">بالاترین نرخ تبدیل ارز</h4>--}}
                            {{--<div class="widget-thumb-wrap">--}}
                                {{--<i class="widget-thumb-icon bg-yellow-lemon icon-shuffle"></i>--}}
                                {{--<div class="widget-thumb-body">--}}
                                    {{--<span class="widget-thumb-subtitle">یورو به ریال</span>--}}
                                    {{--<span class="widget-thumb-body-stat" data-counter="counterup"--}}
                                          {{--data-value="4235">0</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- END WIDGET THUMB -->--}}
                    {{--</div>--}}

                    {{--<div class="col-md-3">--}}
                        {{--<!-- BEGIN WIDGET THUMB -->--}}
                        {{--<div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">--}}
                            {{--<h4 class="widget-thumb-heading">پایین ترین نرخ تبدیل ارز</h4>--}}
                            {{--<div class="widget-thumb-wrap">--}}
                                {{--<i class="widget-thumb-icon bg-blue-hoki icon-shuffle"></i>--}}
                                {{--<div class="widget-thumb-body">--}}
                                    {{--<span class="widget-thumb-subtitle">یورو به ریال</span>--}}
                                    {{--<span class="widget-thumb-body-stat" data-counter="counterup"--}}
                                          {{--data-value="3955">0</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- END WIDGET THUMB -->--}}
                    {{--</div>--}}
                </div>

                <div class="row">
                    {{-- Today's Transactions List --}}
                    <div class="col-lg-12">

                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold">لیست</span>
                                    <span class="caption-helper">تراکنش های در انتظار تائید</span>
                                </div>
                                <div class="actions">
                                    <a href="{{route('admin.transactions.excel')}}" class="btn btn-circle green btn-outline btn-sm">
                                        <i class="fa fa-file-excel-o"></i> Excel </a>
                                    <a href="#" class="btn btn-circle red btn-outline btn-sm">
                                        <i class="fa fa-file-pdf-o"></i> PDF </a>
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
                                        @include('partials.search-transactions', ['payed_transactions' => $payed_transactions, 'extraInfo' => $extraInfo])
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
    <script>
        var orderType = 'id';
        var orderOption = 'DESC';
    </script>
@endsection
