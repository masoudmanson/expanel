@extends('layouts.dashboard')

@section('title')
    پنل صرافی | تنظیم نرخ ارز
@endsection

@section('content')

    @include('partials.header')

    <div class="clearfix"></div>

    <!-- BEGIN CONTAINER -->
    <div class="page-container">

    @include('partials.sidemenu', array('li' => 'statistic'))

    <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" style="min-height: 700px;">
                <h1 class="page-title"> نرخ تبدیل ارز </h1>
                <div class="row">
                    {{-- Exchage Rate Setting Form --}}
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                        @include('partials.ratePortlet')
                    </div>

                    {{-- Top Transactions List --}}
                    <div class="col-lg-6 col-xs-12 col-sm-12" id="ajax-transaction-list">
                        @include('partials.rateTables')
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
