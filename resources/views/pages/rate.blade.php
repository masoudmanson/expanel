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
                    <div class="col-lg-6 col-xs-12 col-sm-12">
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
    <script>
        var serverTime = {{ time()*1000 }};
        console.log(serverTime);
        var localtime = +Date.now();
        console.log(localtime);
        var diff = serverTime - localtime;
        console.log(diff);

        function startTime() {
            var today = new Date(+Date.now() + diff);
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            $('.server-time').text(h + ":" + m + ":" + s);
            var t = setTimeout(startTime, 1000);
        }
        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }
            return i;
        }
    </script>
@endsection
