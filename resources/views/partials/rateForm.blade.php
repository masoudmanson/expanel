<form role="form" action="/rates" method="post" id="rateForm{{ $type }}" data-id="{{ $type }}" class="rateForm">{{-- onsubmit="return rateFormValidation(this, {{ $type }})">--}}
    {{ csrf_field() }}
    <div class="form-body">
        <div class="form-group">
            <input type="text" name="rate" class="form-control input-lg rateFormRate">
            <input type="hidden" name="currency_id" value="{{ $type }}">
        </div>
    </div>

    <div class="form-actions right">
        <button type="reset" class="btn default">انصراف</button>
        <button type="submit" class="btn yellow-crusta">تنظیم</button>
    </div>
    <br>
</form>