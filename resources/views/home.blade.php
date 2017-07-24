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
                            <h4 class="widget-thumb-heading">تعداد تراکنش ها</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-casablanca icon-graph"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">تراکنش</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="7,644">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">مبلغ مبادله شده</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-haze fa fa-money"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">ریال</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="256,800,000">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">نرخ تبدیل ارز</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-lemon icon-shuffle"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">یورو به ریال</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="{{$top_widget['my_last_rate']}}">0</span>
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
                                <i class="widget-thumb-icon bg-yellow icon-user"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">نفر</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="5,071">0</span>
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
                                            <input type="radio" name="options" class="toggle" id="option1">روزانه</label>
                                        <label class="btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm">
                                            <input type="radio" name="options" class="toggle" id="option2">هفتگی</label>
                                        <label class="btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm">
                                            <input type="radio" name="options" class="toggle" id="option2">ماهانه</label>
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
                                                <div class="title" style="padding-bottom: 5px"> جمع پرداختی ها <small>(ریال)</small> </div>
                                                <div class="number"> 25,256,000 </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="stat-right">
                                            <div class="stat-chart">
                                                <div id="sparkline_bar2"></div>
                                            </div>
                                            <div class="stat-number">
                                                <div class="title" style="padding-bottom: 5px"> جمع تراکنش ها </div>
                                                <div class="number"> 719 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light">
                                        <thead>
                                        <tr>
                                            <th> کاربر </th>
                                            <th> مبلغ </th>
                                            <th> نرخ تبدیل </th>
                                            <th> تاریخ </th>
                                        </tr>
                                        </thead>
                                        <tr>
                                            <td class="font-blue-chambray">حمیدرضا آموزگار</td>
                                            <td class="font-red-haze bold"> $5200 </td>
                                            <td> 3900 </td>
                                            <td> 3 مرداد 96 </td>
                                        </tr>

                                        <tr>
                                            <td class="font-blue-chambray">عماد قربانی نیا</td>
                                            <td class="font-red-haze bold"> $3045 </td>
                                            <td> 3867 </td>
                                            <td> 3 مرداد 96 </td>
                                        </tr>

                                        <tr>
                                            <td class="font-blue-chambray">مسعود امجدی</td>
                                            <td class="font-red-haze bold"> $2500 </td>
                                            <td> 3680 </td>
                                            <td> 3 مرداد 96 </td>
                                        </tr>

                                        <tr>
                                            <td class="font-blue-chambray">پوریا پهلوانی</td>
                                            <td class="font-red-haze bold"> $1560 </td>
                                            <td> 3998 </td>
                                            <td> 3 مرداد 96 </td>
                                        </tr>
                                    </table>
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
        var serverTime = {{ time()*1000 }};
        console.log(serverTime);
        var localtime = +Date.now();
        console.log(localtime);
        var diff = serverTime - localtime;
        console.log(diff);

        function startTime() {
            var today = new Date(+Date.now() + diff);
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            $('#server-time').text(h + ":" + m + ":" + s);
            var t = setTimeout(startTime, 1000);
        }
        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }
            return i;
        }
    </script>
@endsection
