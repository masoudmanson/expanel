<!-- BEGIN Portlet PORTLET-->
<div class="portlet light exchange-rate">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-user-follow font-yellow-crusta"></i>
            <span class="caption-subject bold font-yellow-crusta"> افزودن کاربر جدید </span>
        </div>
    </div>
    <div class="portlet-body">
        <form role="form" action="" method="post" id="rateForm" class="rateForm">
            {{ csrf_field() }}
            <div class="form-body">
                <div class="form-group">
                    <label for="firstname">نام:</label>
                    <input type="text" id="firstname" name="firstname" class="form-control input-lg">
                </div>
            </div>

            <div class="form-body">
                <div class="form-group">
                    <label for="lastname">نام خانوادگی:</label>
                    <input type="text" id="lastname" name="lastname" class="form-control input-lg">
                </div>
            </div>

            <div class="form-body">
                <div class="form-group">
                    <label for="code">کد ملی:</label>
                    <input type="text" id="code" name="code" class="form-control input-lg">
                </div>
            </div>

            <div class="form-body">
                <div class="form-group">
                    <label for="mobile">شماره موبایل:</label>
                    <input type="text" id="mobile" name="mobile" class="form-control input-lg">
                </div>
            </div>

            <div class="form-actions right">
                <button type="submit" class="btn yellow-crusta">افزودن</button>
                <button type="reset" class="btn default">انصراف</button>
            </div>
            <br>
        </form>
    </div>
</div>