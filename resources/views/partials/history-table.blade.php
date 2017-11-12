<table class="table table-hover table-light">
    <thead>
    <tr>
        @if($extraInfo['order'] == 'transactions.id')
            @if($extraInfo['option'] == 'ASC')
                <th>
                    <i class="font-red-haze fa fa-sort-amount-asc"></i>
                    <a href="{{ Request::fullUrlWithQuery(['order' => 'transactions.id', 'option' => 'DESC']) }}">شناسه</a>
                </th>
            @else
                <th>
                    <i class="font-red-haze fa fa-sort-amount-desc"></i>
                    <a href="{{ Request::fullUrlWithQuery(['order' => 'transactions.id', 'option' => 'ASC']) }}">شناسه</a>
                </th>
            @endif
        @else
            <th>
                <a href="{{ Request::fullUrlWithQuery(['order' => 'transactions.id', 'option' => 'ASC']) }}">شناسه</a>
            </th>
        @endif

        <th> فرستنده</th>

        <th>مبلغ ارز</th>

        @if($extraInfo['order'] == 'transactions.payment_amount')
            @if($extraInfo['option'] == 'ASC')
                <th>
                    <i class="font-red-haze fa fa-sort-amount-asc"></i>
                    <a href="{{ Request::fullUrlWithQuery(['order' => 'transactions.payment_amount', 'option' => 'DESC']) }}">مبلغ پرداختی</a>
                </th>
            @else
                <th>
                    <i class="font-red-haze fa fa-sort-amount-desc"></i>
                    <a href="{{ Request::fullUrlWithQuery(['order' => 'transactions.payment_amount', 'option' => 'ASC']) }}">مبلغ پرداختی</a>
                </th>
            @endif
        @else
            <th>
                <a href="{{ Request::fullUrlWithQuery(['order' => 'transactions.payment_amount', 'option' => 'ASC']) }}">مبلغ پرداختی</a>
            </th>
        @endif

        @if($extraInfo['order'] == 'transactions.exchange_rate')
            @if($extraInfo['option'] == 'ASC')
                <th>
                    <i class="font-red-haze fa fa-sort-amount-asc"></i>
                    <a href="{{ Request::fullUrlWithQuery(['order' => 'transactions.exchange_rate', 'option' => 'DESC']) }}">نرخ تبدیل</a>
                </th>
            @else
                <th>
                    <i class="font-red-haze fa fa-sort-amount-desc"></i>
                    <a href="{{ Request::fullUrlWithQuery(['order' => 'transactions.exchange_rate', 'option' => 'ASC']) }}">نرخ تبدیل</a>
                </th>
            @endif
        @else
            <th>
                <a href="{{ Request::fullUrlWithQuery(['order' => 'transactions.exchange_rate', 'option' => 'ASC']) }}">نرخ تبدیل</a>
            </th>
        @endif

        <th> مقصد</th>
        <th> گیرنده</th>
        <th> شماره تراکنش</th>

        @if($extraInfo['order'] == 'transactions.payment_date')
            @if($extraInfo['option'] == 'ASC')
                <th>
                    <i class="font-red-haze fa fa-sort-amount-asc"></i>
                    <a href="{{ Request::fullUrlWithQuery(['order' => 'transactions.payment_date', 'option' => 'DESC']) }}">تاریخ</a>
                </th>
            @else
                <th>
                    <i class="font-red-haze fa fa-sort-amount-desc"></i>
                    <a href="{{ Request::fullUrlWithQuery(['order' => 'transactions.payment_date', 'option' => 'ASC']) }}">تاریخ</a>
                </th>
            @endif
        @else
            <th>
                <a href="{{ Request::fullUrlWithQuery(['order' => 'transactions.payment_date', 'option' => 'ASC']) }}">تاریخ</a>
            </th>
        @endif

        <th> عملیات</th>
    </tr>
    </thead>

    @foreach($transactions as $transaction)
        <tr id="trans_{{ $transaction->id }}">
            <td class="font-blue-chambray">{{ $transaction->id }}</td>
            <td class="font-blue-chambray">{{ $transaction->sender_fname . ' ' . $transaction->sender_lname }}</td>
            <td class="font-green-haze">{{ number_format($transaction->premium_amount, 2) . ' ' . $transaction->currency }}</td>
            <td class="font-red-haze bold">{{ number_format($transaction->payment_amount, 2) }} ريال</td>
            <td>{{ number_format($transaction->exchange_rate) }} ريال</td>
            <td class="font-blue-dark">{{ $transaction->country }}</td>
            <td class="font-blue-chambray">{{ $transaction->bnf_fname . ' ' . $transaction->bnf_lname }}</td>
            <td class="bold font-dark">{{ $transaction->uri }}</td>
            <td>{{($transaction->payment_date)?jdate($transaction->payment_date)->format('%y %B %d , H:i:s'):'پرداخت نشده است' }}</td>
            <td>
                <a data-target="#transShowModal" data-toggle="modal"
                   class="btn btn-circle btn-outline btn-sm yellow-gold transShowLinks"
                   data-id="{{ $transaction->id }}"
                   data-modal="transShowModal"
                   data-url="/transactions/">
                    <i class="icon-eye"></i> مشاهده
                </a>
            </td>

        </tr>
    @endforeach
</table>
<br>
{{--{{ $transactions->links() }}--}}
{{ $transactions->appends(Request::query())->render() }}