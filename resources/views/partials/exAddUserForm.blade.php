<div class="col-md-6 col-xs-12">
    <div class="portlet light exchange-rate">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa-file-excel-o fa font-green-haze"></i>
                <span class="caption-subject bold font-green-haze"> ورود اطلاعات با فایل اکسل </span>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::open(array('route' => 'import-csv-excel','method'=>'POST','files'=>'true')) !!}
            <div class="form-body">
                <div class="form-group">
                    {!! Form::label('sample_file','فایل Excel:',['class'=>'col-md-3']) !!}
                    {!! Form::file('sample_file', array('class' => 'form-control')) !!}
                    {!! $errors->first('sample_file', '<p class="alert alert-danger">:message</p>') !!}
                    <br>
                    <p class="help-block">لطفا فایل اکسل اطلاعات کاربران تائید شده ی صرافی را از فرم زیر وارد کنید تا کاربران به صورت اتوماتیک به سیستم افزوده شوند.</p>
                    <p class="help-block-error font-red-mint">در نظر داشته باشید که فرمت اکسل ورودی باید به صورت فایل نمونه باشد. به اسم ستون ها دقت نمائید. (
                        <a href="{{ asset('images/users.xls') }}">دانلود فایل نمونه</a> )</p>
                </div>
            </div>
            <div class="form-actions right">
                {!! Form::submit('افزودن',['class'=>'btn green-haze']) !!}
                {!! Form::reset('انصراف',['class'=>'btn default']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="col-md-6 col-xs-12">
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
                        <input type="text" id="code" name="identity_number" class="form-control input-lg">
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
</div>