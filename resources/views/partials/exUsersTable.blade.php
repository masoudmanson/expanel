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
            @if(count($users) > 0)
                <table class="table table-hover table-light">
                    <thead>
                    <tr>
                        <th> نام </th>
                        <th> نام خانوادگی </th>
                        <th> کد ملی</th>
                        <th> شماره موبایل</th>
                        <th> تاریخ عضویت</th>
                    </tr>
                    </thead>
                    @foreach($users as $user)
                    <tr>
                        <td class="font-blue-chambray">{{ $user->firstname }}</td>
                        <td class="font-blue-chambray">{{ $user->lastname }}</td>
                        <td class="font-red-haze bold">{{ $user->identity_number }}</td>
                        <td>{{ $user->mobile }}</td>
                        <td>{{ jdate($user->created_at)->format('%d %B %y') }}</td>
                    </tr>
                    @endforeach
                </table>
                <br>
                {{ $users->links() }}
            @else
                <h4 class="font-grey-silver text-center">کاربری برای نمایش وجود ندارد</h4>
            @endif
        </div>
    </div>
</div>