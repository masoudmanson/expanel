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
                    {{-- Exchage Rate Setting Form --}}
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                        @include('partials.exAddUserForm')
                    </div>

                    {{-- Top Transactions List --}}
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                        @include('partials.exUsersTable')
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
