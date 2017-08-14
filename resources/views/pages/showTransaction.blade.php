@extends('layouts.dashboard')

@section('title')
    پنل صرافی | نمایش فاکتور
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
                <h1 class="page-title"> لیست تراکنش های بسته شماره 655 </h1>

                <div class="row widget-row">
                    <div class="col-md-3">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">تعداد تراکنش های این بسته تراکنشی</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-casablanca icon-book-open"></i>
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
                            <h4 class="widget-thumb-heading">مجموع مبلغ این بسته تراکنشی</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-haze icon-book-open"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">ريال</span>
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
                    {{-- Today's Transactions List --}}
                    <div class="col-lg-12">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold">لیست</span>
                                    <span class="caption-helper">تراکنش های بسته ی شماره 655</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light">
                                        <thead>
                                        <tr>
                                            <th> فرستنده</th>
                                            <th> مبلغ</th>
                                            <th>وضعیت</th>
                                            <th> مقصد</th>
                                            <th> گیرنده</th>
                                            <th> شماره تراکنش</th>
                                            <th> تاریخ</th>
                                            <th> عملیات</th>
                                        </tr>
                                        </thead>

                                        @foreach($transactions as $transaction)
                                            <tr id="trans_{{ $transaction->id }}">
                                                <td class="font-blue-chambray">{{ $transaction->sender_fname . ' ' . $transaction->sender_lname }}</td>
                                                <td class="font-yellow-crusta bold">{{ number_format($transaction->premium_amount, 2) . ' ' . $transaction->currency }}</td>
                                                <td class="font-red-mint bold">@lang('index.'.$transaction->fanex_status)</td>
                                                <td class="font-blue-dark">{{ $transaction->country }}</td>
                                                <td class="font-blue-dark">{{ $transaction->bnf_fname . ' ' . $transaction->bnf_lname }}</td>
                                                <td class="bold font-dark">{{ $transaction->uri }}</td>
                                                <td>{{ jdate($transaction->payment_date)->format('%y %B %d , H:i:s') }}</td>
                                                <td>
                                                    <a data-target="#transShowModal" data-toggle="modal"
                                                       class="btn btn-circle btn-outline btn-sm yellow-gold transShowLinks"
                                                       data-id="{{ $transaction->id }}">
                                                        <i class="icon-eye"></i> مشاهده تراکنش
                                                    </a>

                                                    <a href="#" data-target="#transConfirmModal" data-toggle="modal"
                                                       data-user="{{ $transaction->sender_fname . ' ' . $transaction->sender_lname }}"
                                                       data-userID="{{ $transaction->sender_identity_number or 'ندارد' }}"
                                                       data-userMobile="{{ $transaction->sender_mobile or 'ندارد' }}"
                                                       class="btn btn-circle btn-outline btn-sm yellow-crusta transConfirmLinks">
                                                        <i class="icon-user-follow"></i> احراز هویت و تائید تراکنش
                                                    </a>

                                                </td>

                                            </tr>
                                        @endforeach
                                    </table>
                                    <br>
                                    {{ $transactions->links() }}
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
