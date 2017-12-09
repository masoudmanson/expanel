@extends('layouts.dashboard')

@section('title')
    پنل صرافی | کاربران صرافی
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
                <h1 class="page-title"> لیست کاربران صرافی </h1>

                <div class="row widget-row">
                    <div class="col-md-3 col-xs-12">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">کل کاربران</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-yellow-casablanca icon-user"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">نفر</span>
                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                          data-value="{{ $users_count }}">0</span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-9 col-xs-12">

                        {{-- Search in Transactions --}}
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="fa fa-search font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold">جستجو</span>
                                    <span class="caption-helper">در لیست کاربران</span>
                                </div>
                            </div>
                            <div class="portlet-body pt5">
                                <div class="row">
                                    <div class="form-body col-xs-9 col-sm-10">
                                        <div class="form-group mb0">
                                            <input class="form-control input-lg searchForm" data-target=".tableContentWrapper" data-url="/search/users/exhouse" placeholder="جستجو کنید" type="text">
                                        </div>
                                    </div>
                                    <div class="form-actions right col-xs-2 col-sm-1">
                                        <button class="btn green btn-lg fullWidth searchBtn">بیاب</button>
                                    </div>
                                    <div class="form-actions right col-xs-1 col-sm-1">
                                        <a href="{{ route('indexExhouse') }}" class="btn grey btn-lg fullWidth">همه</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- End Search in transactions --}}
                    </div>

                </div>

                <div class="row ">
                    {{-- Top Transactions List --}}
                    <div class="col-xs-12 col-sm-12" id="ajax-transaction-list">
                        @include('partials.exUsersTable', ['users' => $users])
                    </div>
                </div>

                <div class="row">
                    {{-- Exchage Rate Setting Form --}}
                    @include('partials.exAddUserForm')
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#exUser-form').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            });
        });
    </script>
@endsection
