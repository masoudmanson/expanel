<form role="form" action="/rates" method="post" id="rateForm{{ $model }}" data-id="{{ $model }}" class="rateForm">{{-- onsubmit="return rateFormValidation(this, {{ $model }})">--}}
    {{ csrf_field() }}
    <div class="form-body">
        <div class="form-group">
            <input type="text" name="rate" class="form-control input-lg rateFormRate">
            <input type="hidden" name="currency_id" value="{{ $model }}">
            <input type="hidden" name="product_id" value="{{ $product_id }}">
        </div>
    </div>

    <div class="form-actions right">
        <button type="reset" class="btn default">انصراف</button>
        <button type="submit" class="btn yellow-crusta">تنظیم</button>
    </div>
    <br>
</form>