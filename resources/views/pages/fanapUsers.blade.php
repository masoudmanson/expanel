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

                        {{-- Search in Fanap Users --}}
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="fa fa-search font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold">جستجو</span>
                                    <span class="caption-helper">در لیست کاربران</span>
                                </div>
                            </div>
                            <div class="portlet-body pt5">
                                <div class="row">
                                    <div class="form-body col-xs-12 col-md-6 col-lg-8 pl0">
                                        <div class="form-group lg-mb0">
                                            <input class="form-control input-lg searchForm" data-target=".tableContentWrapper" data-url="/search/users/fanap" placeholder="جستجو کنید" type="text">
                                        </div>
                                    </div>
                                    <div class="form-actions right col-xs-6 col-md-3 col-lg-2 p0">
                                        <button type="submit" class="btn green btn-lg fullWidth searchBtn">بیاب</button>
                                    </div>
                                    <div class="form-actions right col-xs-6 col-md-3 col-lg-2 pr0">
                                        <a href="{{ route('indexFanap') }}" class="btn grey btn-lg fullWidth">همه</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Search in Fanap Users --}}
                    </div>

                </div>

                <div class="row">
                    {{-- Fanap Users List --}}
                    <div class="col-lg-12">

                        <div class="portlet light tableContentWrapper">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold">لیست</span>
                                    <span class="caption-helper">کاربران تائید شده</span>
                                </div>
                                <div class="actions">
                                    <a href="{{route('admin.fanapUsers.excel')}}" class="btn btn-circle green btn-outline btn-sm">
                                        <i class="fa fa-file-excel-o"></i> Excel </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable table-scrollable-borderless">
                                    <div class="col-xs-12 col-sm-12" id="ajax-transaction-list">
                                        @include('partials.fanapUsersTable', ['users' => $users])
                                    </div>
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
