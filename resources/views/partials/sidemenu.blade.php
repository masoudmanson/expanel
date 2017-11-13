<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li id="dashboard-li" class="nav-item ">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">داشبورد</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li id="statistic-li" class="nav-item">
                <a href="{{ route('rates.index') }}" class="nav-link nav-toggle">
                    <i class="icon-shuffle"></i>
                    <span class="title">نرخ ارز</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li id="transactions-li" class="nav-item">
                <a href="{{ route('history.index') }}" class="nav-link nav-toggle">
                    <i class="icon-note"></i>
                    <span class="title">تراکنش ها</span>
                    <span class="selected"></span>
                </a>
            </li>

            {{--<li id="transactions-li" class="nav-item  ">--}}
                {{--<a href="javascript:;" class="nav-link nav-toggle">--}}
                    {{--<i class="icon-note"></i>--}}
                    {{--<span class="title">تراکنش ها</span>--}}
                    {{--<span class="arrow"></span>--}}
                    {{--<span class="selected"></span>--}}
                {{--</a>--}}
                {{--<ul class="sub-menu">--}}
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="{{ route('transactions.index') }}" class="nav-link ">--}}
                            {{--<span class="title">تراکنش های در انتظار تائید امروز</span>--}}
                        {{--</a>--}}

                    {{--</li>--}}
                    {{--<li class="nav-item">--}}
                        {{--<a href="{{ route('factors.index') }}" class="nav-link ">--}}
                            {{--<span class="title">تراکنش های بسته بندی شده</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item  ">--}}
                        {{--<a href="{{ route('history.index') }}" class="nav-link">--}}
                            {{--<span class="title">تاریخچه ی تراکنش ها</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}

            <li id="users-li" class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user-follow"></i>
                    <span class="title">کاربران</span>
                    <span class="arrow"></span>
                    <span class="selected"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{ route('indexExhouse') }}" class="nav-link ">
                        {{--<a href="users/exhouseUsers" class="nav-link ">--}}
                            <span class="title">صرافی پاسارگاد</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        {{--<a href="javascript:;" class="nav-link " disabled="disabled">--}}
                        <a href="{{ route('indexOther') }}" class="nav-link ">
                            <span class="title"  disabled="disabled">در انتظار تائید</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ route('indexFanap') }}" class="nav-link ">
                        {{--<a href="/users/fanapUsers" class="nav-link ">--}}
                            <span class="title" disabled="disabled"> فناپ</span>
                        </a>
                    </li>
                    {{--<li class="nav-item  ">--}}
{{--                        <a href="{{ route('indexFanap') }}" class="nav-link ">--}}
                        {{--<a href="javascript:;" class="nav-link ">--}}
                            {{--<span class="title font-grey-mint">بانک پاسارگاد</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                </ul>
            </li>

            {{--<li id="settings-li" class="nav-item">--}}
                {{--<a href="{{ route('settings') }}" class="nav-link nav-toggle">--}}
                {{--<a href="javascript:;" class="nav-link font-grey-mint nav-toggle">--}}
                    {{--<i class="icon-settings font-grey-mint"></i>--}}
                    {{--<span class="title">تنظیمات</span>--}}
                    {{--<span class="selected"></span>--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->

<script>
    $(window).load(function(){
        $("{{ "#".$li."-li" }}").addClass('active start open');
    });
</script>