@extends('layouts.dashboard')

@section('title')
    پنل صرافی | لیست فاکتورها
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
                        <span> &nbsp;در حال احراز هویت، لطفا شکیبا باشید ... </span>
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
                                <form role="form" action="">
                                    <div class="row">
                                        <div class="form-body col-xs-9 col-sm-10">
                                            <div class="form-group">
                                                <input class="form-control input-lg" placeholder="جستجو کنید" type="text">
                                            </div>
                                        </div>
                                        <div class="form-actions right col-xs-3 col-sm-2">
                                            <button type="submit" class="btn green btn-lg">بیاب</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- End Search in transactions --}}

                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold">لیست</span>
                                    <span class="caption-helper">تراکنش های در انتظار تائید</span>
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

                                        @foreach($payed_transactions as $transaction)
                                            <tr id="trans_{{ $transaction->id }}">
                                                <td class="font-blue-chambray">{{ $transaction->firstname . ' ' . $transaction->lastname }}</td>
                                                <td class="font-red-haze bold">{{ number_format($transaction->premium_amount, 2) . ' ' . $transaction->currency }}</td>
                                                <td>{{ number_format($transaction->exchange_rate) }} ريال</td>
                                                <td class="font-blue-dark">{{ $transaction->country }}</td>
                                                <td class="bold font-dark">{{ $transaction->uri }}</td>
                                                <td>{{ jdate($transaction->payment_date)->format('%y %B %d , H:i:s') }}</td>
                                                <td>
                                                    <a data-target="#transShowModal" data-toggle="modal"
                                                       class="btn btn-circle btn-outline btn-sm yellow-gold transShowLinks"
                                                       data-id="{{ $transaction->id }}">
                                                        <i class="icon-eye"></i> مشاهده
                                                    </a>

                                                    <a data-target="#transConfirmModal" data-toggle="modal"
                                                       data-user="{{ $transaction->firstname . ' ' . $transaction->lastname }}"
                                                       data-uri="{{ $transaction->uri }}"
                                                       class="btn btn-circle btn-outline btn-sm green-haze transConfirmLinks"
                                                       data-id="{{ $transaction->id }}">
                                                        <i class="icon-check"></i> تائید
                                                    </a>

                                                    <a data-target="#transRejectModal" data-toggle="modal"
                                                       data-user="{{ $transaction->firstname . ' ' . $transaction->lastname }}"
                                                       data-uri="{{ $transaction->uri }}"
                                                       class="btn btn-circle btn-outline btn-sm red-haze transRejectLinks"
                                                       data-id="{{ $transaction->id }}">
                                                        <i class="icon-close"></i> رد کردن
                                                    </a>

                                                    <a href="#" data-target="#ajax" data-toggle="modal"
                                                       class="btn btn-circle btn-outline btn-sm yellow-crusta">
                                                        <i class="icon-user-follow"></i> احراز هویت
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </table>
                                    <br>
                                    {{ $payed_transactions->links() }}
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
