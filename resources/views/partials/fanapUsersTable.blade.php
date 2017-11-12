@if(count($users) > 0)
    <table class="table table-hover table-light">
        <thead>
        <tr>
            <th> شناسه فناپ</th>
            <th> نام</th>
            <th> نام خانوادگی</th>
            <th>شماره ملی</th>
            <th> شماره موبایل</th>
            <th> تاریخ</th>
            <th> عملیات</th>
        </tr>
        </thead>

        @foreach($users as $user)
            <tr id="{{ $user->id }}">
                <td>{{ $user->id }}</td>
                <td class="font-blue-chambray">{{ ($user->firstname)?$user->firstname:"ندارد" }}</td>
                <td class="font-blue-chambray">{{ ($user->lastname)?$user->lastname:"ندارد" }}</td>
                <td class="@if(($user->identity_number)) font-yellow-crusta bold @endif">{{ ($user->identity_number)?$user->identity_number:"ندارد" }}</td>
                <td class="@if(($user->mobile)) bold @endif">{{ ($user->mobile)?$user->mobile:"ندارد" }}</td>
                <td>{{ jdate($user->created_at)->format('%y %B %d , H:i:s') }}</td>
                <td>
                    <a data-target="#fanapUserModal" data-toggle="modal"
                       class="btn btn-circle btn-outline btn-sm green-haze ajaxModalLinks"
                       data-id="{{ $user->id }}"
                       data-modal="fanapUserModal"
                       data-url="/users/fanapUsers/">
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