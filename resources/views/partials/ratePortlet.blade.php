<!-- BEGIN Portlet PORTLET-->
<div class="portlet light exchange-rate">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="icon-shuffle font-yellow-crusta"></i>
            <span class="caption-subject bold font-yellow-crusta uppercase"> تنظیم نرخ تبدیل ارز </span>
        </div>
        <ul class="nav nav-tabs">
            <li class="@if($type == 'lira') active @endif">
                <a href="{{ Request::fullUrlWithQuery(['type' => 'lira', 'page' => 1]) }}" data-target="#portlet_tab2, #table_tab2" class="rateTabsLink"> لیر ترکیه ₺ </a>
            </li>
            <li class="@if($type == 'euro') active @endif">
                <a href="{{ Request::fullUrlWithQuery(['type' => 'euro', 'page' => 1]) }}" data-target="#portlet_tab1, #table_tab1" class="rateTabsLink"> یورو € </a>
            </li>
        </ul>
    </div>
    <div class="portlet-body">
        <div class="tab-content">
            @if($type == 'euro')
                <div class="tab-pane active" id="portlet_tab1">
                    <div class="row">
                        <div class="col-xs-6 exchange-cols">
                            <p>زمان اخرین تغییر: </p>
                            {{--<div class="font-grey-silver server-time">بارگزاری ... </div>--}}
                            <div class="font-grey-silver ">{{$euro_last_set_time}}</div>
                        </div>

                        <div class="col-xs-6  exchange-cols">
                            <p>نرخ کنونی یورو: </p>
                            <div class="font-yellow-gold">{{ number_format($top_widget['euro_last_rate']) }} <small>ریال</small></div>
                        </div>
                    </div>
                    <br>
                    <div>
                        <h4>تنظیم نرخ تبدیل <b>یورو €</b> به <b>ریال</b></h4>
                        <br>

                        @include('partials.rateForm', ['model' => 1])
                    </div>
                </div>
            @elseif($type == 'lira')
                <div class="tab-pane active" id="portlet_tab2">
                    <div class="row">
                        <div class="col-xs-6 exchange-cols">
                            <p>زمان اخرین تغییر: </p>
                            {{--<div class="font-grey-silver server-time">بارگزاری ... </div>--}}
                            <div class="font-grey-silver ">{{$lira_last_set_time}}</div>
                        </div>

                        <div class="col-xs-6  exchange-cols">
                            <p>نرخ کنونی لیره: </p>
                            <div class="font-yellow-gold">{{ number_format($top_widget['lira_last_rate']) }} <small>ریال</small></div>
                        </div>
                    </div>
                    <br>
                    <div>
                        <h4>تنظیم نرخ تبدیل <b>لیر ترکیه ₺</b> به <b>ریال</b></h4>
                        <br>
                        @include('partials.rateForm', ['model' => 2])
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>