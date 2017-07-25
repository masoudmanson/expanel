<!-- BEGIN Portlet PORTLET-->
<div class="portlet light exchange-rate">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="icon-shuffle font-yellow-crusta"></i>
            <span class="caption-subject bold font-yellow-crusta uppercase"> تنظیم نرخ تبدیل ارز </span>
        </div>
        <ul class="nav nav-tabs">
            <li>
                <a href="#portlet_tab2" data-toggle="tab"> لیر ترکیه ₺ </a>
            </li>
            <li class="active">
                <a href="#portlet_tab1" data-toggle="tab"> یورو € </a>
            </li>
        </ul>
    </div>
    <div class="portlet-body">
        <div class="tab-content">

            <div class="row">
                <div class="col-xs-6 exchange-cols">
                    <p>زمان کنونی سرور: </p>
                    <div id="server-time" class="font-grey-silver">بارگزاری ... </div>
                </div>

                <div class="col-xs-6  exchange-cols">
                    <p>نرخ کنونی ارز: </p>
                    <div class="font-yellow-gold">{{$top_widget['my_last_rate']}}</div>
                </div>
            </div>
            <br>

            <div class="tab-pane active" id="portlet_tab1">
                <div>
                    <h4>تنظیم نرخ تبدیل <b>یورو €</b> به <b>ریال</b></h4>
                    <br>

                    @include('partials.rateForm', ['type' => 1])
                </div>
            </div>
            <div class="tab-pane" id="portlet_tab2">
                <div>
                    <h4>تنظیم نرخ تبدیل <b>لیر ترکیه ₺</b> به <b>ریال</b></h4>
                    <br>

                    @include('partials.rateForm', ['type' => 2])
                </div>
            </div>
        </div>
    </div>
</div>