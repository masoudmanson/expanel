{{--{{ dd($transaction) }}--}}
<div class="mt-element-list">
    <div class="mt-list-head list-simple font-white bg-red">
        <div class="list-head-title-container">
            <div class="list-date text-center">{{ jdate($transaction->payment_date)->format('%y %B %d  H:i:s') }}</div>
            <h3 class="list-title">{{ $transaction->uri }}</h3>
        </div>
    </div>
    <div class="mt-list-container list-simple">
        <ul>
            <li class="mt-list-item">
                <div class="list-icon-container">
                    <i class="icon-user"></i>
                </div>
                <div class="list-item-content">
                    <h3>
                        <p class="font-red-mint"><small class="font-grey-silver"> فرستنده: </small> {{ $transaction->firstname . ' ' . $transaction->lastname }}</p>
                    </h3>
                </div>
            </li>

            <li class="mt-list-item">
                <div class="list-icon-container">
                    <i class="icon-user"></i>
                </div>
                <div class="list-item-content">
                    <h3>
                        <p class="font-red-mint"><small class="font-grey-silver"> گیرنده: </small> {{ $transaction->f . ' ' . $transaction->l }}</p>
                    </h3>
                </div>
            </li>

            <li class="mt-list-item">
                <div class="list-icon-container">
                    <i class="icon-wallet"></i>
                </div>
                <div class="list-item-content">
                    <h3>
                        <p class="font-red-mint"><small class="font-grey-silver"> مبلغ ارسالی: </small> {{ number_format($transaction->premium_amount, 2) . ' ' . $transaction->currency }}</p>
                    </h3>
                </div>
            </li>

            <li class="mt-list-item">
                <div class="list-icon-container">
                    <i class="icon-wallet"></i>
                </div>
                <div class="list-item-content">
                    <h3>
                        <p class="font-red-mint"><small class="font-grey-silver"> مبلغ پرداختی: </small> {{ number_format($transaction->payment_amount) }} ريال</p>
                    </h3>
                </div>
            </li>

            <li class="mt-list-item">
                <div class="list-icon-container">
                    <i class="icon-shuffle"></i>
                </div>
                <div class="list-item-content">
                    <h3>
                        <p class="font-red-mint"><small class="font-grey-silver"> نرخ تبدیل ارز: </small> {{ number_format($transaction->exchange_rate) }} ريال</p>
                    </h3>
                </div>
            </li>

            <li class="mt-list-item">
                <div class="list-icon-container">
                    <i class="icon-calendar"></i>
                </div>
                <div class="list-item-content">
                    <h3>
                        <p class="font-red-mint"><small class="font-grey-silver"> وضعیت تراکنش: </small> مسعود امجدی</p>
                    </h3>
                </div>
            </li>

        </ul>
    </div>
</div>