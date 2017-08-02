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

        <div class="modal fade" id="ajax" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span> &nbsp;&nbsp;Loading... </span>
                    </div>
                </div>
            </div>
        </div>

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
                                          data-value="544">0</span>
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
                                          data-value="2,800,000">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">بالاترین نرخ تبدیل ارز</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-lemon icon-shuffle"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">یورو به ریال</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="4235">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">پایین ترین نرخ تبدیل ارز</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue-hoki icon-shuffle"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">یورو به ریال</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="3955">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>
                </div>

                <div class="row">
                    {{-- Today's Transactions List --}}
                    <div class="col-lg-12">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold">لیست</span>
                                    <span class="caption-helper">نرخ های اخیر</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light">
                                        <thead>
                                        <tr>
                                            <th> کاربر</th>
                                            <th> مبلغ</th>
                                            <th> نرخ تبدیل</th>
                                            <th> مقصد</th>
                                            <th> شماره تراکنش</th>
                                            <th> تاریخ</th>
                                            <th> عملیات</th>
                                        </tr>
                                        </thead>
                                        <tr>
                                            <td class="font-blue-chambray">حمیدرضا آموزگار</td>
                                            <td class="font-red-haze bold"> $5200</td>
                                            <td> 3900</td>
                                            <td class="font-blue-dark"> ترکیه</td>
                                            <td class="bold font-dark"> 7553412y8526812K</td>
                                            <td> 3 مرداد 96</td>
                                            <td>

                                                <a href="{{route('admin.transactions.excel')}}"
                                                   class="btn btn-circle btn-outline btn-sm yellow-gold">
                                                    <i class="icon-eye"></i> اکسل
                                                </a>
                                                <a href="#" data-target="#ajax" data-toggle="modal"
                                                   class="btn btn-circle btn-outline btn-sm yellow-gold">
                                                    <i class="icon-eye"></i> مشاهده
                                                </a>

                                                <a href="#" data-target="#ajax" data-toggle="modal"
                                                   class="btn btn-circle btn-outline btn-sm green-haze">
                                                    <i class="icon-check"></i> تائید
                                                </a>

                                                <a href="#" data-target="#ajax" data-toggle="modal"
                                                   class="btn btn-circle btn-outline btn-sm red-haze">
                                                    <i class="icon-close"></i> رد کردن
                                                </a>

                                                <a href="#" data-target="#ajax" data-toggle="modal"
                                                   class="btn btn-circle btn-outline btn-sm yellow-crusta">
                                                    <i class="icon-user-follow"></i> احراز هویت
                                                </a>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="font-blue-chambray">عماد قربانی نیا</td>
                                            <td class="font-red-haze bold"> $3045</td>
                                            <td> 3867</td>
                                            <td class="font-blue-dark"> ترکیه</td>
                                            <td class="bold font-dark"> 7553412y8526812K</td>
                                            <td> 3 مرداد 96</td>
                                            <td>
                                                <a href="#" data-target="#ajax" data-toggle="modal"
                                                   class="btn btn-circle btn-outline btn-sm yellow-gold">
                                                    <i class="icon-eye"></i> مشاهده
                                                </a>

                                                <a href="#" data-target="#ajax" data-toggle="modal"
                                                   class="btn btn-circle btn-outline btn-sm green-haze">
                                                    <i class="icon-check"></i> تائید
                                                </a>

                                                <a href="#" data-target="#ajax" data-toggle="modal"
                                                   class="btn btn-circle btn-outline btn-sm red-haze">
                                                    <i class="icon-close"></i> رد کردن
                                                </a>

                                                <a href="#" data-target="#ajax" data-toggle="modal"
                                                   class="btn btn-circle btn-outline btn-sm yellow-crusta">
                                                    <i class="icon-user-follow"></i> احراز هویت
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="font-blue-chambray">مسعود امجدی</td>
                                            <td class="font-red-haze bold"> $2500</td>
                                            <td> 3680</td>
                                            <td class="font-blue-dark"> ترکیه</td>
                                            <td class="bold font-dark"> 7553412y8526812K</td>
                                            <td> 3 مرداد 96</td>
                                            <td>
                                                <a href="#" data-target="#ajax" data-toggle="modal"
                                                   class="btn btn-circle btn-outline btn-sm yellow-gold">
                                                    <i class="icon-eye"></i> مشاهده
                                                </a>

                                                <a href="#" data-target="#ajax" data-toggle="modal"
                                                   class="btn btn-circle btn-outline btn-sm green-haze">
                                                    <i class="icon-check"></i> تائید
                                                </a>

                                                <a href="#" data-target="#ajax" data-toggle="modal"
                                                   class="btn btn-circle btn-outline btn-sm red-haze">
                                                    <i class="icon-close"></i> رد کردن
                                                </a>

                                                <a href="#" data-target="#ajax" data-toggle="modal"
                                                   class="btn btn-circle btn-outline btn-sm yellow-crusta">
                                                    <i class="icon-user-follow"></i> احراز هویت
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="font-blue-chambray">پوریا پهلوانی</td>
                                            <td class="font-red-haze bold"> $1560</td>
                                            <td> 3998</td>
                                            <td class="font-blue-dark"> ترکیه</td>
                                            <td class="bold font-dark"> 7553412y8526812K</td>
                                            <td> 3 مرداد 96</td>
                                            <td>
                                                <a href="#" data-target="#ajax" data-toggle="modal"
                                                   class="btn btn-circle btn-outline btn-sm yellow-gold">
                                                    <i class="icon-eye"></i> مشاهده
                                                </a>

                                                <a href="#" data-target="#ajax" data-toggle="modal"
                                                   class="btn btn-circle btn-outline btn-sm green-haze">
                                                    <i class="icon-check"></i> تائید
                                                </a>

                                                <a href="#" data-target="#ajax" data-toggle="modal"
                                                   class="btn btn-circle btn-outline btn-sm red-haze">
                                                    <i class="icon-close"></i> رد کردن
                                                </a>

                                                <a href="#" data-target="#ajax" data-toggle="modal"
                                                   class="btn btn-circle btn-outline btn-sm yellow-crusta">
                                                    <i class="icon-user-follow"></i> احراز هویت
                                                </a>
                                            </td>
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
