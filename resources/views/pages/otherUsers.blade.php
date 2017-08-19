@extends('layouts.dashboard')

@section('title')
    پنل صرافی | لیست کاربران در انتظار تائید
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
                <h1 class="page-title"> لیست کاربران در انتظار تائید </h1>

                <div class="row widget-row">
                    <div class="col-md-6 col-xs-12">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">تعداد کاربران در انتظار</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-casablanca icon-user"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">نفر</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="65">0</span>
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
                                    <i class="icon-list font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold">لیست</span>
                                    <span class="caption-helper">کاربران در انتظار تائید</span>
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
                                                <td class="font-blue-chambray">مسعود</td>
                                                <td class="font-blue-chambray">امجدی</td>
                                                <td class="font-yellow-crusta bold">1640113886</td>
                                                <td class="bold">09148401824</td>
                                                <td>{{ jdate('now')->format('%y %B %d , H:i:s') }}</td>
                                                <td class="font-red-mint bold">احراز نشده</td>
                                                <td>
                                                    <a data-target="#transConfirmModal" data-toggle="modal"
                                                       class="btn btn-circle btn-outline btn-sm green-haze transConfirmLinks"
                                                       data-id="76">
                                                        <i class="icon-check"></i> تائید کاربر
                                                    </a>

                                                    <a data-target="#transRejectModal" data-toggle="modal"
                                                       class="btn btn-circle btn-outline btn-sm red-haze transRejectLinks"
                                                       data-id="345">
                                                        <i class="icon-close"></i> رد کردن کاربر
                                                    </a>

                                                    <a href="#" disabled="disabled"
                                                       class="btn btn-circle btn-outline btn-sm grey">
                                                        <i class="icon-user-follow"></i> احراز هویت
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr id="">
                                                <td>1</td>
                                                <td class="font-blue-chambray">محمد</td>
                                                <td class="font-blue-chambray">پرهام</td>
                                                <td class="font-yellow-crusta bold">3652547854</td>
                                                <td class="bold">09125556548</td>
                                                <td>{{ jdate('now')->format('%y %B %d , H:i:s') }}</td>
                                                <td class="font-red-mint bold">احراز نشده</td>
                                                <td>
                                                    <a data-target="#transConfirmModal" data-toggle="modal"
                                                       class="btn btn-circle btn-outline btn-sm green-haze transConfirmLinks"
                                                       data-id="76">
                                                        <i class="icon-check"></i> تائید کاربر
                                                    </a>

                                                    <a data-target="#transRejectModal" data-toggle="modal"
                                                       class="btn btn-circle btn-outline btn-sm red-haze transRejectLinks"
                                                       data-id="345">
                                                        <i class="icon-close"></i> رد کردن کاربر
                                                    </a>

                                                    <a href="#" disabled="disabled"
                                                       class="btn btn-circle btn-outline btn-sm grey">
                                                        <i class="icon-user-follow"></i> احراز هویت
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
