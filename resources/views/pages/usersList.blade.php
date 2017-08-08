@extends('layouts.dashboard')

@section('title')
    پنل صرافی | لیست کاربران تائید شده
@endsection

@section('content')

    @include('partials.header')

    <div class="clearfix"></div>

    <!-- BEGIN CONTAINER -->
    <div class="page-container">

        @include('partials.sidemenu', array('li' => 'users'))

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" style="min-height: 700px;">
                <h1 class="page-title"> لیست کاربران تائید شده توسط فناپ </h1>

                <div class="row widget-row">
                    <div class="col-md-6 col-xs-12">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">کل کاربران</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-casablanca icon-user"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">نفر</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="105">0</span>
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
                                    <i class="fa fa-search font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold">جستجو</span>
                                    <span class="caption-helper">در لیست کاربران</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <form role="form" action="">
                                    <div class="row">
                                        <div class="form-body col-xs-9 col-sm-10">
                                            <div class="form-group">
                                                <input class="form-control input-lg" placeholder="جستجو کنید" type="text">
                                            </div>
                                        </div>
                                        <div class="form-actions right col-xs-3 col-sm-2">
                                            <button type="submit" class="btn green btn-lg fullWidth">بیاب</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- End Search in transactions --}}
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
                                    <span class="caption-helper">کاربران تائید شده</span>
                                </div>
                                <div class="actions">
                                    <a href="#" class="btn btn-circle green btn-outline btn-sm">
                                        <i class="fa fa-file-excel-o"></i> Excel </a>
                                    <a href="#" class="btn btn-circle red btn-outline btn-sm">
                                        <i class="fa fa-file-pdf-o"></i> PDF </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light">
                                        <thead>
                                        <tr>
                                            <th> ردیف</th>
                                            <th> نام</th>
                                            <th> نام خانوادگی</th>
                                            <th>شماره ملی</th>
                                            <th> شماره موبایل</th>
                                            <th> تاریخ</th>
                                            <th>وضعیت</th>
                                            <th> عملیات</th>
                                        </tr>
                                        </thead>

                                        {{--@foreach($payed_transactions as $transaction)--}}
                                            <tr id="">
                                                <td>1</td>
                                                <td class="font-blue-chambray">عماد</td>
                                                <td class="font-blue-chambray">قربانی نیا</td>
                                                <td class="font-yellow-crusta bold">0012546587</td>
                                                <td class="bold">09999903880</td>
                                                <td>{{ jdate('now')->format('%y %B %d , H:i:s') }}</td>
                                                <td class="font-red-mint bold">احراز شده</td>
                                                <td>
                                                    <a href="#"
                                                       class="btn btn-circle btn-outline btn-sm green-haze">
                                                        <i class="icon-user-follow"></i>مشاهده ی اطلاعات
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr id="">
                                                <td>1</td>
                                                <td class="font-blue-chambray">پوریا</td>
                                                <td class="font-blue-chambray">پهلوانی</td>
                                                <td class="font-yellow-crusta bold">00125487458</td>
                                                <td class="bold">091255659874</td>
                                                <td>{{ jdate('now')->format('%y %B %d , H:i:s') }}</td>
                                                <td class="font-red-mint bold">احراز شده</td>
                                                <td>
                                                    <a href="#"
                                                       class="btn btn-circle btn-outline btn-sm green-haze">
                                                        <i class="icon-user-follow"></i>مشاهده ی اطلاعات
                                                    </a>
                                                </td>
                                            </tr>
                                        {{--@endforeach--}}
                                    </table>
                                    <br>
                                    {{--{{ $payed_transactions->links() }}--}}
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
