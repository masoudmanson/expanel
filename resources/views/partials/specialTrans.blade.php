<div class="row number-stats margin-bottom-30">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="stat-left">
            <div class="stat-chart">
                <div id="sparkline_bar"></div>
            </div>
            <div class="stat-number">
                <div class="title" style="padding-bottom: 5px"> جمع پرداختی های <span class="perName">امروز</span>
                    <small>(ریال)</small>
                </div>
                <div class="number">{{ number_format($today['sum']) }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="stat-right">
            <div class="stat-chart">
                <div id="sparkline_bar2"></div>
            </div>
            <div class="stat-number">
                <div class="title" style="padding-bottom: 5px"> تعداد تراکنش های <span class="perName">امروز</span> </div>
                <div class="number">{{ number_format($today['count']) }}</div>
            </div>
        </div>
    </div>
</div>
<div class="table-scrollable table-scrollable-borderless">
    @if(count($today['special']) > 0)
        <table class="table table-hover table-light">
            <thead>
            <tr>
                <th> کاربر</th>
                <th> مبلغ</th>
                <th> نرخ تبدیل</th>
                <th> تاریخ</th>
            </tr>
            </thead>
            @foreach($today['special'] as $special_tran)
                <tr>
                    <td class="font-blue-chambray">{{ $special_tran->sender_fname . ' ' . $special_tran->sender_lname }}</td>
                    <td class="font-red-haze bold">{{ number_format($special_tran->premium_amount) . ' ' . $special_tran->currency }}</td>
                    <td>{{ number_format($special_tran->exchange_rate) }} ریال</td>
                    <td>{{ jdate($special_tran->payment_date)->format('%y %B %d , H:i:s') }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <h4 class="font-grey-silver text-center">تراکنشی برای نمایش وجود ندارد</h4>
    @endif
</div>