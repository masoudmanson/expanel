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
            <th>وضعیت</th>
            <th> عملیات</th>
        </tr>
        </thead>

        @foreach($users as $user)
            <tr id="">
                <td>{{ $user->id }}</td>
                <td class="font-blue-chambray">{{ $user->firstname_latin }}</td>
                <td class="font-blue-chambray">{{ $user->lastname_latin }}</td>
                <td class="font-yellow-crusta bold">{{ $user->identity_number or 'ندارد' }}</td>
                <td class="bold">{{ $user->mobile or 'ندارد' }}</td>
                <td>{{ jdate($user->created_at)->format('%y %B %d , H:i:s') }}</td>
                <td class="font-red-mint bold">احراز نشده</td>
                <td>
                    <a data-target="#transConfirmModal" data-toggle="modal"
                       class="btn btn-circle btn-outline btn-sm green-haze transConfirmLinks"
                       data-url="/users/authorization/"
                       data-user="{{ $user->firstname_latin . ' ' . $user->lastname_latin }}"
                       data-userID="{{ $user->identity_number or 'ندارد' }}"
                       data-userMobile="{{ $user->mobile or 'ندارد' }}"
                       data-id="{{ $user->id }}">
                        <i class="icon-user-follow"></i> تائید کاربر
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