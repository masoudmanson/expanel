@extends('layouts.dashboard')

@section('title')
    پنل صرافی | تنظیمات
@endsection

@section('content')

    @include('partials.header')

    <div class="clearfix"></div>

    <!-- BEGIN CONTAINER -->
    <div class="page-container">

    @include('partials.sidemenu', array('li' => 'settings'))

    <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" style="min-height: 700px;">
                <h1 class="page-title"> لیست مدیران پنل </h1>

                <div class="row">
                    {{-- Exchage Rate Setting Form --}}
                    <div class="col-lg-6 col-xs-12 col-sm-12"><!-- BEGIN Portlet PORTLET-->
                        <div class="portlet light exchange-rate">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-user-follow font-yellow-crusta"></i>
                                    <span class="caption-subject bold font-yellow-crusta"> افزودن مدیر جدید </span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <form role="form" action="" method="post" id="rateForm" class="rateForm">
                                    {{ csrf_field() }}
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="firstname">نام:</label>
                                            <input type="text" id="firstname" name="firstname" class="form-control input-lg">
                                        </div>
                                    </div>

                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="lastname">نام خانوادگی:</label>
                                            <input type="text" id="lastname" name="lastname" class="form-control input-lg">
                                        </div>
                                    </div>

                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="code">کد ملی:</label>
                                            <input type="text" id="code" name="code" class="form-control input-lg">
                                        </div>
                                    </div>

                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="mobile">شماره موبایل:</label>
                                            <input type="text" id="mobile" name="mobile" class="form-control input-lg">
                                        </div>
                                    </div>

                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="access">دسترسی:</label>
                                            <select id="access" name="access" class="form-control input-lg">
                                                <option value="">ادمین</option>
                                                <option value="">حسابرس</option>
                                                <option value="">وارد کننده اطلاعات کاربر</option>
                                                <option value="">تائید کننده ی هویت و تراکنش</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-actions right">
                                        <button type="submit" class="btn yellow-crusta">افزودن مدیر</button>
                                        <button type="reset" class="btn default">انصراف</button>
                                    </div>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Top Transactions List --}}
                    <div class="col-lg-6 col-xs-12 col-sm-12">

                        <!-- BEGIN Portlet PORTLET-->
                        <div class="portlet light">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-list font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold">لیست</span>
                                    <span class="caption-helper">کاربران صرافی</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light">
                                        <thead>
                                        <tr>
                                            <th> نام </th>
                                            <th> نام خانوادگی </th>
                                            <th> کد ملی</th>
                                            <th> شماره موبایل</th>
                                            <th>دسترسی</th>
                                            <th>وضعیت</th>
                                            <th> تاریخ عضویت</th>
                                        </tr>
                                        </thead>
                                        {{--@foreach($rates['euro']['list'] as $rate)--}}
                                        <tr>
                                            <td class="font-blue-chambray">محمد</td>
                                            <td class="font-blue-chambray">پرهام</td>
                                            <td class="bold">00125487458</td>
                                            <td>0999999999</td>
                                            <td class="font-red-haze bold">ادمین</td>
                                            <td class="font-green-haze bold">فعال</td>
                                            <td>{{ jdate('now')->format('%d %B %y') }}</td>
                                        </tr>

                                        <tr>
                                            <td class="font-blue-chambray">عماد</td>
                                            <td class="font-blue-chambray">قربانی نیا</td>
                                            <td class="bold">0013564478</td>
                                            <td>09999908033</td>
                                            <td class="font-red-haze bold">حسابرس</td>
                                            <td class="font-green-haze bold">فعال</td>
                                            <td>{{ jdate('now')->format('%d %B %y') }}</td>
                                        </tr>

                                        <tr>
                                            <td class="font-blue-chambray">مسعود</td>
                                            <td class="font-blue-chambray">امجدی</td>
                                            <td class="bold">1640113886</td>
                                            <td>09148401824</td>
                                            <td class="font-red-haze bold">تائید کننده هویت و تراکنش</td>
                                            <td class="font-green-haze bold">فعال</td>
                                            <td>{{ jdate('now')->format('%d %B %y') }}</td>
                                        </tr>

                                        <tr>
                                            <td class="font-blue-chambray">پوریا</td>
                                            <td class="font-blue-chambray">پهلوانی</td>
                                            <td class="bold">00125458748</td>
                                            <td>09126587458</td>
                                            <td class="font-red-haze bold">وارد کننده اطالاعات کاربر</td>
                                            <td class="font-green-haze bold">فعال</td>
                                            <td>{{ jdate('now')->format('%d %B %y') }}</td>
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
    </script>
@endsection
