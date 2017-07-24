<form role="form" action="/rates" method="post">
    {{ csrf_field() }}
    <div class="form-body">
        <div class="form-group">
            <input type="number" name="rate" class="form-control input-lg">
            <input type="hidden" name="currency_id" value="{{ $type }}">
        </div>
    </div>

    <div class="form-actions right">
        <button type="button" class="btn default">انصراف</button>
        <button type="submit" class="btn yellow-crusta">تنظیم</button>
    </div>
    <br>
</form>