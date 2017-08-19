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
                <td class="font-blue-chambray">{{ $user->firstname }}</td>
                <td class="font-blue-chambray">{{ $user->lastname }}</td>
                <td class="font-yellow-crusta bold">{{ $user->identity_number }}</td>
                <td class="bold">{{ $user->mobile }}</td>
                <td>{{ jdate($user->created_at)->format('%y %B %d , H:i:s') }}</td>
                <td class="font-red-mint bold">احراز نشده</td>
                <td>
                    <a data-target="#transConfirmModal" data-toggle="modal"
                       class="btn btn-circle btn-outline btn-sm green-haze transConfirmLinks"
                       data-id="76">
                        <i class="icon-check"></i> تائید کاربر
                    </a>

                    <a data-target="#transRejectModal" data-toggle="modal"
                       class="btn btn-circle btn-outline btn-sm red-haze transRejectLinks"
                       data-id="345">
                        <i class="icon-close"></i> رد کردن کاربر
                    </a>

                    <a href="#" disabled="disabled"
                       class="btn btn-circle btn-outline btn-sm grey">
                        <i class="icon-user-follow"></i> احراز هویت
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