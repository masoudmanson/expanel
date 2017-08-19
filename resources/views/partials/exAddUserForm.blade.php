<!-- BEGIN Portlet PORTLET-->
<div class="portlet light exchange-rate">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa-file-excel-o fa font-green-haze"></i>
            <span class="caption-subject bold font-green-haze"> ورود اطلاعات با فایل اکسل </span>
        </div>
    </div>
    <div class="portlet-body">
        <form role="form" action="{{ route('import-csv-excel') }}" method="post">
            {{ csrf_field() }}
            <div class="form-body">
                <div class="form-group">
                    <label for="excel">فایل Excel:</label>
                    <input id="excel" type="file">
                    <br>
                    <p class="help-block">لطفا فایل اکسل اطلاعات کاربران تائید شده ی صرافی را از فرم زیر وارد کنید تا کاربران به صورت اتوماتیک به سیستم افزوده شوند.</p>
                    <p class="help-block-error font-red-mint">در نظر داشته باشید که فرمت اکسل ورودی باید به صورت فایل نمونه باشد. به اسم ستون ها دقت نمائید. (
                        <a href="">دانلود فایل نمونه</a> )</p>
                </div>
            </div>

            <div class="form-actions right">
                <button type="submit" class="btn green-haze">افزودن</button>
                <button type="reset" class="btn default">انصراف</button>
            </div>
            <br>
        </form>
    </div>
</div>



<!-- BEGIN Portlet PORTLET-->
<div class="portlet light exchange-rate">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-user-follow font-yellow-crusta"></i>
            <span class="caption-subject bold font-yellow-crusta"> افزودن کاربر جدید </span>
        </div>
    </div>
    <div class="portlet-body">
        <form role="form" action="{{ route('ex-add-user') }}" method="post">
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