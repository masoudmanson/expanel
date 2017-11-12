@if(count($users) > 0)
    <table class="table table-hover table-light">
        <thead>
        <tr>
            <th> ردیف</th>
            <th> نام</th>
            <th> نام خانوادگی</th>
            <th>شماره ملی</th>
            <th> شماره موبایل</th>
            <th> تاریخ</th>
            <th> عملیات</th>
        </tr>
        </thead>

        @foreach($users as $user)
            <tr id="">
                <td>1</td>
                <td class="font-blue-chambray">{{ $user->firstname }}</td>
                <td class="font-blue-chambray">{{ $user->lastname }}</td>
                <td class="font-yellow-crusta bold">{{ $user->identity_number }}</td>
                <td class="bold">{{ $user->mobile }}</td>
                <td>{{ jdate($user->created_at)->format('%y %B %d , H:i:s') }}</td>
                <td>
                    <a data-target="#fanapUserModal" data-toggle="modal"
                       class="btn btn-circle btn-outline btn-sm green-haze fanapUsersLinks"
                       data-id="{{ $user->id }}">
                        <i class="icon-user-follow"></i>مشاهده ی اطلاعات
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <br>
    {{ $users->links() }}

@else
    <h4 class="font-grey-silver text-center">کاربری برای نمایش وجود ندارد</h4>
@endif