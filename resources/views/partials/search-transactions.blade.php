<table class="table table-hover table-light">
    <thead>
    <tr>
        <th> فرستنده</th>
        <th> مبلغ</th>
        <th>وضعیت</th>
        <th> مقصد</th>
        <th> گیرنده</th>
        <th> شماره تراکنش</th>
        <th> تاریخ</th>
        <th> عملیات</th>
    </tr>
    </thead>

    @foreach($transactions as $transaction)
        <tr id="trans_{{ $transaction->id }}">
            <td class="font-blue-chambray">{{ $transaction->sender_fname . ' ' . $transaction->sender_lname }}</td>
            <td class="font-yellow-crusta bold">{{ number_format($transaction->premium_amount, 2) . ' ' . $transaction->currency }}</td>
            <td class="font-red-mint bold">@lang('index.'.$transaction->fanex_status)</td>
            <td class="font-blue-dark">{{ $transaction->country }}</td>
            <td class="font-blue-dark">{{ $transaction->bnf_fname . ' ' . $transaction->bnf_lname }}</td>
            <td class="bold font-dark">{{ $transaction->uri }}</td>
            <td>{{ jdate($transaction->payment_date)->format('%y %B %d , H:i:s') }}</td>
            <td>
                <a data-target="#transShowModal" data-toggle="modal"
                   class="btn btn-circle btn-outline btn-sm yellow-gold transShowLinks"
                   data-id="{{ $transaction->id }}">
                    <i class="icon-eye"></i> مشاهده
                </a>

                <a data-target="#transConfirmModal" data-toggle="modal"
                   data-user="{{ $transaction->sender_fname . ' ' . $transaction->sender_lname }}"
                   data-userID="{{ $transaction->sender_identity_number or 'ندارد' }}"
                   data-userMobile="{{ $transaction->sender_mobile or 'ندارد' }}"
                   data-uri="{{ $transaction->uri }}"
                   class="btn btn-circle btn-outline btn-sm yellow-crusta transConfirmLinks"
                   data-id="{{ $transaction->id }}">
                    <i class="icon-user-follow"></i> احراز هویت و تائید تراکنش
                </a>

            </td>

        </tr>
    @endforeach
</table>
<br>

{{ $transactions->links() }}