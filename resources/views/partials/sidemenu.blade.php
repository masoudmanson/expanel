<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li id="dashboard-li" class="nav-item ">
                <a href="javascript:;" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">داشبورد</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li id="statistic-li" class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="title">آمار</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <span class="title">آمار دانلود ها</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <span class="title">آمار پست ها</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li id="posts-li" class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-note"></i>
                    <span class="title">پست ها</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <span class="title">ارسال پست جدید</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <span class="title">لیست پست ها</span>
                            <span class="badge badge-danger">2</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li id="gallery-li" class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-picture"></i>
                    <span class="title">گالری</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <span class="title">ارسال عکس</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <span class="title">ارسال فیلم</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <span class="title">ارسال صدا</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <span class="title">لیست گالری</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li id="settings-li" class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">تنظیمات</span>
                    <span class="arrow"></span>
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