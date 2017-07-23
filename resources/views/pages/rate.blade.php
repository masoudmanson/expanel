@extends('layouts.dashboard')

@section('title')
    پنل صرافی
@endsection

@section('content')

    @include('partials.header')

    <div class="clearfix"></div>

    <!-- BEGIN CONTAINER -->
    <div class="page-container">

    @include('partials.sidemenu', array('li' => 'statistic'))

    <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" style="min-height: 700px;">
                <h1 class="page-title"> نرخ تبدیل ارز </h1>

                <div class="row">
                    {{-- Exchage Rate Setting Form --}}
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="portlet light exchange-rate">
                            <div class="portlet-title tabbable-line">
                                <div class="caption">
                                    <i class="icon-shuffle font-yellow-crusta"></i>
                                    <span class="caption-subject bold font-yellow-crusta uppercase"> تنظیم نرخ تبدیل ارز </span>
                                </div>
                                <ul class="nav nav-tabs">
                                    {{--<li>--}}
                                    {{--<a href="#portlet_tab2" data-toggle="tab"> لیر ترکیه ₺ </a>--}}
                                    {{--</li>--}}
                                    <li class="active">
                                        <a href="#portlet_tab1" data-toggle="tab"> یورو € </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">

                                    <div class="row">
                                        <div class="col-xs-6 exchange-cols">
                                            <p>زمان کنونی سرور: </p>
                                            <div id="server-time" class="font-grey-silver">بارگزاری ... </div>
                                        </div>

                                        <div class="col-xs-6  exchange-cols">
                                            <p>نرخ کنونی ارز: </p>
                                            <div class="font-yellow-gold">3850</div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="tab-pane active" id="portlet_tab1">
                                        <div>
                                            <h4>تنظیم نرخ تبدیل <b>یورو €</b> به <b>ریال</b></h4>
                                            <br>
                                            <form role="form">
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-lg" placeholder="نرخ تبدیل ارز">
                                                    </div>
                                                </div>

                                                <div class="form-actions right">
                                                    <button type="button" class="btn default">انصراف</button>
                                                    <button type="submit" class="btn yellow-crusta">تنظیم</button>
                                                </div>
                                                <br>
                                            </form>
                                        </div>
                                    </div>
                                    {{--<div class="tab-pane" id="portlet_tab2">--}}
                                    {{--<div>--}}
                                    {{--<h4>تنظیم نرخ تبدیل <b>لیر ترکیه ₺</b> به <b>ریال</b></h4>--}}
                                    {{--<br>--}}
                                    {{--<form role="form">--}}
                                    {{--<div class="form-body">--}}
                                    {{--<div class="form-group">--}}
                                    {{--<input type="text" class="form-control input-lg" placeholder="نرخ تبدیل ارز">--}}
                                    {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="form-actions right">--}}
                                    {{--<button type="button" class="btn default">انصراف</button>--}}
                                    {{--<button type="submit" class="btn yellow-crusta">تنظیم</button>--}}
                                    {{--</div>--}}
                                    {{--<br>--}}
                                    {{--</form>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Top Transactions List --}}
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold">لیست</span>
                                    <span class="caption-helper">نرخ های اخیر</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row number-stats margin-bottom-30">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="stat-left">
                                            <div class="stat-chart">
                                                <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                <div id="sparkline_bar"></div>
                                            </div>
                                            <div class="stat-number">
                                                <div class="title" style="padding-bottom: 5px"> بیشترین نرخ <small>(ریال)</small> </div>
                                                <div class="number  font-red-haze"> 4,125 </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="stat-right">
                                            <div class="stat-chart">
                                                <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                <div id="sparkline_bar2"></div>
                                            </div>
                                            <div class="stat-number">
                                                <div class="title" style="padding-bottom: 5px"> کمترین نرخ <small>(ریال)</small> </div>
                                                <div class="number font-blue-soft"> 3,856 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light">
                                        <thead>
                                        <tr>
                                            <th> ارز </th>
                                            <th> نرخ تبدیل </th>
                                            <th> زمان استفاده شده </th>
                                            <th> تاریخ تنظیم </th>
                                            <th> IP </th>
                                        </tr>
                                        </thead>
                                        <tr>
                                            <td class="font-blue-chambray">یورو €</td>
                                            <td class="font-red-haze bold"> 4125 </td>
                                            <td> 02:15:00 </td>
                                            <td>3 مرداد 96 - 12:04:23</td>
                                            <td> 172.16.1.58 </td>
                                        </tr>
                                        <tr>
                                            <td class="font-blue-chambray">یورو €</td>
                                            <td class="font-red-haze bold"> 3985 </td>
                                            <td> 00:15:00 </td>
                                            <td>3 مرداد 96 - 12:04:23</td>
                                            <td> 172.16.1.58 </td>
                                        </tr>
                                        <tr>
                                            <td class="font-blue-chambray">یورو €</td>
                                            <td class="font-red-haze bold"> 4015 </td>
                                            <td> 01:05:00 </td>
                                            <td>3 مرداد 96 - 12:04:23</td>
                                            <td> 172.16.3.96 </td>
                                        </tr>
                                        <tr>
                                            <td class="font-blue-chambray">یورو €</td>
                                            <td class="font-red-haze bold"> 4200 </td>
                                            <td> 00:10:00 </td>
                                            <td>3 مرداد 96 - 12:04:23</td>
                                            <td> 172.16.3.36 </td>
                                        </tr>
                                        <tr>
                                            <td class="font-blue-chambray">یورو €</td>
                                            <td class="font-red-haze bold"> 3950 </td>
                                            <td> 08:15:00 </td>
                                            <td>3 مرداد 96 - 12:04:23</td>
                                            <td> 172.16.1.41 </td>
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
