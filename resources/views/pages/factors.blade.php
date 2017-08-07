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

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" style="min-height: 700px;">
                <h1 class="page-title"> لیست فاکتورها </h1>

                <div class="row widget-row">
                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">تعداد فاکتورهای تائید نشده</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-casablanca icon-book-open"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">فاکتور</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="{{ number_format($top_widget['factors_unaccepted_count']) }}">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">تعداد فاکتورهای تائید شده</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-haze icon-book-open"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">فاکتور</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="{{ number_format($top_widget['factors_accepted_count']) }}">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">ساعت</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-lemon icon-clock"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">الان</span>
                                    <span class="widget-thumb-body-stat server-time"></span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">تاریخ</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue-hoki icon-calendar"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">امروز</span>
                                    <span class="widget-thumb-body-stat">{{ jdate('now')->format('%d %B %Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>
                </div>

                <div class="row">
                    {{-- Pending Factors List --}}
                    <div class="col-lg-12">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart font-green-haze"></i>
                                    <span class="caption-subject font-green-haze bold">لیست</span>
                                    <span class="caption-helper">فاکتورهای در انتظار تائید</span>
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
                                            <th> شماره فاکتور</th>
                                            <th> تعداد تراکنش ها</th>
                                            <th> مجموع مبلغ</th>
                                            <th>وضعیت</th>
                                            <th> تاریخ</th>
                                            <th> عملیات</th>
                                        </tr>
                                        </thead>

                                        @foreach($transactions as $transaction)
                                            <tr id="trans_{{ $transaction->id }}">
                                                <td>{{ $transaction->id }}</td>
                                                <td class="bold font-dark">{{ $transaction->uri }}</td>
                                                <td class="font-blue-chambray">{{ $transaction->user_id }}</td>
                                                <td>{{ number_format($transaction->exchange_rate) }} ريال</td>
                                                <td class="font-red-haze bold">@lang('index.'.$transaction->fanex_status)</td>
                                                <td>{{ jdate($transaction->payment_date)->format('%y %B %d , H:i:s') }}</td>
                                                <td>
                                                    <a href="factors/1" class="btn btn-circle btn-outline btn-sm yellow-gold">
                                                        <i class="icon-eye"></i> مشاهده فاکتور
                                                    </a>

                                                    <a data-target="#transConfirmModal" data-toggle="modal"
                                                       data-user="{{ $transaction->firstname . ' ' . $transaction->lastname }}"
                                                       data-uri="{{ $transaction->uri }}"
                                                       class="btn btn-circle btn-outline btn-sm green-haze transConfirmLinks"
                                                       data-id="{{ $transaction->id }}">
                                                        <i class="icon-check"></i> تائید
                                                    </a>

                                                    <a data-target="#transConfirmModal" data-toggle="modal"
                                                       data-user="{{ $transaction->firstname . ' ' . $transaction->lastname }}"
                                                       data-uri="{{ $transaction->uri }}"
                                                       class="btn btn-circle btn-outline btn-sm green-haze transConfirmLinks"
                                                       data-id="{{ $transaction->id }}">
                                                        <i class="icon-check"></i> خروجی اکسل
                                                    </a>

                                                    <a data-target="#transConfirmModal" data-toggle="modal"
                                                       data-user="{{ $transaction->firstname . ' ' . $transaction->lastname }}"
                                                       data-uri="{{ $transaction->uri }}"
                                                       class="btn btn-circle btn-outline btn-sm red-flamingo transConfirmLinks"
                                                       data-id="{{ $transaction->id }}">
                                                        <i class="icon-check"></i> خروجی PDF
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Done factors List --}}
                    <div class="col-lg-12">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold">لیست</span>
                                    <span class="caption-helper">فاکتورهای تائید شده</span>
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
                                            <th> شماره فاکتور</th>
                                            <th> تعداد تراکنش ها</th>
                                            <th> مجموع مبلغ</th>
                                            <th>وضعیت</th>
                                            <th> تاریخ</th>
                                            <th> عملیات</th>
                                        </tr>
                                        </thead>

                                        @foreach($transactions_done as $transaction)
                                            <tr id="trans_{{ $transaction->id }}">
                                                <td>{{ $transaction->id }}</td>
                                                <td class="bold font-dark">{{ $transaction->uri }}</td>
                                                <td class="font-blue-chambray">{{ $transaction->user_id }}</td>
                                                <td>{{ number_format($transaction->exchange_rate) }} ريال</td>
                                                <td class="font-red-haze bold">@lang('index.'.$transaction->fanex_status)</td>
                                                <td>{{ jdate($transaction->payment_date)->format('%y %B %d , H:i:s') }}</td>
                                                <td>
                                                    <a href="factors/1" class="btn btn-circle btn-outline btn-sm yellow-gold">
                                                        <i class="icon-eye"></i> مشاهده فاکتور
                                                    </a>

                                                    <a data-target="#transConfirmModal" data-toggle="modal"
                                                       data-user="{{ $transaction->firstname . ' ' . $transaction->lastname }}"
                                                       data-uri="{{ $transaction->uri }}"
                                                       class="btn btn-circle btn-outline btn-sm green-haze transConfirmLinks"
                                                       data-id="{{ $transaction->id }}">
                                                        <i class="icon-check"></i> خروجی اکسل
                                                    </a>

                                                    <a data-target="#transConfirmModal" data-toggle="modal"
                                                       data-user="{{ $transaction->firstname . ' ' . $transaction->lastname }}"
                                                       data-uri="{{ $transaction->uri }}"
                                                       class="btn btn-circle btn-outline btn-sm red-flamingo transConfirmLinks"
                                                       data-id="{{ $transaction->id }}">
                                                        <i class="icon-check"></i> خروجی PDF
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </table>
                                    <br>
                                    {{ $transactions_done->links() }}
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
