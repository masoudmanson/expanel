<!-- BEGIN Portlet PORTLET-->
<div class="portlet light">
    <div class="portlet-title tabbable-line">
        <div class="caption caption-md">
            <i class="icon-list font-yellow-casablanca"></i>
            <span class="caption-subject font-yellow-casablanca bold">لیست</span>
            <span class="caption-helper">کاربران صرافی</span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-scrollable table-scrollable-borderless">
            {{--@if(count($rates['euro']['list']) > 0)--}}
                <table class="table table-hover table-light">
                    <thead>
                    <tr>
                        <th> نام </th>
                        <th> نام خانوادگی </th>
                        <th> کد ملی</th>
                        <th> شماره موبایل</th>
                        <th>وضعیت</th>
                        <th> تاریخ عضویت</th>
                    </tr>
                    </thead>
                    {{--@foreach($rates['euro']['list'] as $rate)--}}
                    <tr>
                        <td class="font-blue-chambray">مسعود</td>
                        <td class="font-blue-chambray">امجدی</td>
                        <td class="font-red-haze bold">1640113886</td>
                        <td>09148401824</td>
                        <td class="font-red-haze bold">تائید شده</td>
                        <td>{{ jdate('now')->format('%d %B %y') }}</td>
                    </tr>

                    <tr>
                        <td class="font-blue-chambray">عماد</td>
                        <td class="font-blue-chambray">قربانی نیا</td>
                        <td class="font-red-haze bold">0013564478</td>
                        <td>09999908033</td>
                        <td class="font-red-haze bold">تائید شده</td>
                        <td>{{ jdate('now')->format('%d %B %y') }}</td>
                    </tr>
                    {{--@endforeach--}}
                </table>
                <br>
                {{--{{ $rates['euro']['list']->links() }}--}}
            {{--@else--}}
                {{--<h4 class="font-grey-silver text-center">کاربری برای نمایش وجود ندارد</h4>--}}
            {{--@endif--}}
        </div>
    </div>
</div>