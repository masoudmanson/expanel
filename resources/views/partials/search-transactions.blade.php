<table class="table table-hover table-light">
    <thead>
    <tr>
        @if($extraInfo['order'] == 'transactions.id')
            <th data-option="{{ $extraInfo['option'] }}" data-url="/transactions" data-order="transactions.id" class="orderBy"><i class="font-red-haze fa fa-{{ ($extraInfo['option'] == 'ASC') ? 'sort-amount-asc' : 'sort-amount-desc' }}"></i> شناسه </th>
        @else
            <th data-option="ASC" data-url="/transactions" data-order="transactions.id" class="orderBy"> شناسه <small class="font-red"></small></th>
        @endif

        <th> فرستنده</th>

        @if($extraInfo['order'] == 'premium_amount')
            <th data-option="{{ $extraInfo['option'] }}" data-url="/transactions" data-order="premium_amount" class="orderBy"><i class="font-red-haze fa fa-{{ ($extraInfo['option'] == 'ASC') ? 'sort-amount-asc' : 'sort-amount-desc' }}"></i> مبلغ </th>
        @else
            <th data-option="ASC" data-url="/transactions" data-order="premium_amount" class="orderBy"> مبلغ <small class="font-red"></small></th>
        @endif

        {{--<th> مبلغ</th>--}}
        <th>وضعیت</th>
        <th> مقصد</th>
        <th> گیرنده</th>
        <th> شماره تراکنش</th>

        @if($extraInfo['order'] == 'transactions.payment_date')
            <th data-option="{{ $extraInfo['option'] }}" data-url="/transactions" data-order="transactions.payment_date" class="orderBy"><i class="font-red-haze fa fa-{{ ($extraInfo['option'] == 'ASC') ? 'sort-amount-asc' : 'sort-amount-desc' }}"></i> تاریخ </th>
        @else
            <th data-option="ASC" data-url="/transactions" data-order="transactions.payment_date" class="orderBy"> تاریخ <small class="font-red"></small></th>
        @endif

        <th> عملیات</th>
    </tr>
    </thead>

    @foreach($payed_transactions as $transaction)
        <tr id="trans_{{ $transaction->id }}">
            <td class="font-blue-chambray">{{ $transaction->id }}</td>
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

{{ $payed_transactions->links() }}