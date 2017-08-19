<table class="table table-hover table-light">
    <thead>
    <tr>
        @if($extraInfo['order'] == 'transactions.id')
            <th data-option="{{ $extraInfo['option'] }}" data-url="/history" data-order="transactions.id" class="orderBy"><i class="font-red-haze fa fa-{{ ($extraInfo['option'] == 'ASC') ? 'sort-amount-asc' : 'sort-amount-desc' }}"></i> شناسه </th>
        @else
            <th data-option="ASC" data-url="/history" data-order="transactions.id" class="orderBy"> شناسه <small class="font-red"></small></th>
        @endif

        <th> فرستنده</th>

        @if($extraInfo['order'] == 'premium_amount')
            <th data-option="{{ $extraInfo['option'] }}" data-url="/history" data-order="premium_amount" class="orderBy"><i class="font-red-haze fa fa-{{ ($extraInfo['option'] == 'ASC') ? 'sort-amount-asc' : 'sort-amount-desc' }}"></i> مبلغ </th>
        @else
            <th data-option="ASC" data-url="/history" data-order="premium_amount" class="orderBy"> مبلغ <small class="font-red"></small></th>
        @endif

        @if($extraInfo['order'] == 'transactions.exchange_rate')
            <th data-option="{{ $extraInfo['option'] }}" data-url="/history" data-order="transactions.exchange_rate" class="orderBy"><i class="font-red-haze fa fa-{{ ($extraInfo['option'] == 'ASC') ? 'sort-amount-asc' : 'sort-amount-desc' }}"></i> نرخ تبدیل </th>
        @else
            <th data-option="ASC" data-url="/history" data-order="transactions.exchange_rate" class="orderBy"> نرخ تبدیل <small class="font-red"></small></th>
        @endif

        <th> مقصد</th>
        <th> گیرنده</th>
        <th> شماره تراکنش</th>

        @if($extraInfo['order'] == 'transactions.payment_date')
            <th data-option="{{ $extraInfo['option'] }}" data-url="/history" data-order="transactions.payment_date" class="orderBy"><i class="font-red-haze fa fa-{{ ($extraInfo['option'] == 'ASC') ? 'sort-amount-asc' : 'sort-amount-desc' }}"></i> تاریخ </th>
        @else
            <th data-option="ASC" data-url="/history" data-order="transactions.payment_date" class="orderBy"> تاریخ <small class="font-red"></small></th>
        @endif

        <th> عملیات</th>
    </tr>
    </thead>

    @foreach($transactions as $transaction)
        <tr id="trans_{{ $transaction->id }}">
            <td class="font-blue-chambray">{{ $transaction->id }}</td>
            <td class="font-blue-chambray">{{ $transaction->sender_fname . ' ' . $transaction->sender_lname }}</td>
            <td class="font-red-haze bold">{{ number_format($transaction->premium_amount, 2) . ' ' . $transaction->currency }}</td>
            <td>{{ number_format($transaction->exchange_rate) }} ريال</td>
            <td class="font-blue-dark">{{ $transaction->country }}</td>
            <td class="font-blue-chambray">{{ $transaction->bnf_fname . ' ' . $transaction->bnf_lname }}</td>
            <td class="bold font-dark">{{ $transaction->uri }}</td>
            <td>{{ jdate($transaction->payment_date)->format('%y %B %d , H:i:s') }}</td>
            <td>
                <a data-target="#transShowModal" data-toggle="modal"
                   class="btn btn-circle btn-outline btn-sm yellow-gold transShowLinks"
                   data-id="{{ $transaction->id }}">
                    <i class="icon-eye"></i> مشاهده
                </a>
            </td>

        </tr>
    @endforeach
</table>
<br>
{{ $transactions->links() }}