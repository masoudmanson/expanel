<!-- BEGIN Portlet PORTLET-->
<div class="portlet light">
    <div class="portlet-title tabbable-line">
        <div class="caption caption-md">
            <i class="icon-bar-chart font-yellow-casablanca"></i>
            <span class="caption-subject font-yellow-casablanca bold">لیست</span>
            <span class="caption-helper">نرخ های اخیر</span>
        </div>
        <ul class="nav nav-tabs">
            <li>
                <a href="#table_tab2" data-toggle="tab"> لیر ترکیه ₺ </a>
            </li>
            <li class="active">
                <a href="#table_tab1" data-toggle="tab"> یورو € </a>
            </li>
        </ul>
    </div>
    <div class="portlet-body">
        <div class="tab-content">
            <div class="tab-pane active" id="table_tab1">
                <div class="row number-stats margin-bottom-30">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="stat-left">
                            <div class="stat-chart">
                                <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                <div id="sparkline_bar"></div>
                            </div>
                            <div class="stat-number">
                                <div class="title" style="padding-bottom: 5px"> بیشترین نرخ یورو
                                    <small>(ریال)</small>
                                </div>
                                <div class="number  font-red-haze">{{ number_format($rates['euro']['max']) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="stat-right">
                            <div class="stat-chart">
                                <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                <div id="sparkline_bar2"></div>
                            </div>
                            <div class="stat-number">
                                <div class="title" style="padding-bottom: 5px"> کمترین نرخ یورو
                                    <small>(ریال)</small>
                                </div>
                                <div class="number font-blue-soft">{{ number_format($rates['euro']['min']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-scrollable table-scrollable-borderless">
                    @if(count($rates['euro']['list']) > 0)
                        <table class="table table-hover table-light">
                            <thead>
                            <tr>
                                <th> ارز</th>
                                <th> نرخ تبدیل</th>
                                {{--<th> زمان استفاده شده </th>--}}
                                <th> تاریخ تنظیم</th>
                                <th> IP</th>
                            </tr>
                            </thead>
                            @foreach($rates['euro']['list'] as $rate)
                                <tr>
                                    <td class="font-blue-chambray">یورو €  </td>
                                    <td class="font-red-haze bold">{{ number_format($rate->rate) }} ریال</td>
                                    {{--<td></td>--}}
                                    <td>{{ jdate($rate->created_at)->format('%y/%m/%d , H:i:s') }}</td>
                                    <td>{{ $rate->ip }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <h4 class="font-grey-silver text-center">نرخی برای نمایش وجود ندارد</h4>
                    @endif
                </div>
            </div>
            <div class="tab-pane" id="table_tab2">
                <div class="row number-stats margin-bottom-30">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="stat-left">
                            <div class="stat-chart">
                                <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                <div id="sparkline_bar"></div>
                            </div>
                            <div class="stat-number">
                                <div class="title" style="padding-bottom: 5px"> بیشترین نرخ
                                    <small>(ریال)</small>
                                </div>
                                <div class="number  font-red-haze">{{ number_format($rates['lira']['max']) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="stat-right">
                            <div class="stat-chart">
                                <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                <div id="sparkline_bar2"></div>
                            </div>
                            <div class="stat-number">
                                <div class="title" style="padding-bottom: 5px"> کمترین نرخ
                                    <small>(ریال)</small>
                                </div>
                                <div class="number font-blue-soft">{{ number_format($rates['lira']['min']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-scrollable table-scrollable-borderless">
                    @if(count($rates['lira']['list']) > 0)
                        <table class="table table-hover table-light">
                            <thead>
                            <tr>
                                <th> ارز</th>
                                <th> نرخ تبدیل</th>
                                {{--<th> زمان استفاده شده </th>--}}
                                <th> تاریخ تنظیم</th>
                                <th> IP</th>
                            </tr>
                            </thead>
                            @foreach($rates['lira']['list'] as $rate)
                                <tr>
                                    <td class="font-blue-chambray">لیره ₺</td>
                                    <td class="font-red-haze bold">{{ number_format($rate->rate) }} ریال</td>
                                    {{--<td></td>--}}
                                    <td>{{ jdate($rate->created_at)->format('%y/%m/%d , H:i:s') }}</td>
                                    <td>{{ $rate->ip }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <h4 class="font-grey-silver text-center">نرخی برای نمایش وجود ندارد</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>