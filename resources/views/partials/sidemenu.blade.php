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

            <li id="posts-li" class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-note"></i>
                    <span class="title">تراکنش ها</span>
                    <span class="arrow"></span>
                    <span class="selected"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{ route('factors') }}" class="nav-link ">
                            <span class="title">فاکتور گیری</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ route('transactions') }}" class="nav-link ">
                            <span class="title">لیست تراکنش ها</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li id="settings-li" class="nav-item  ">
                <a href="{{ route('settings') }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">تنظیمات</span>
                    <span class="selected"></span>
                </a>
            </li>
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