<?php
use \common\components\GlobalUrlService;
use \common\components\StaticService;

StaticService::includeAppJsStatic("/static/plugins/highcharts/js/highcharts.js",www\assets\MerchantAsset::className());

StaticService::includeAppJsStatic( "/static/plugins/moment.js", www\assets\MerchantAsset::className() );

StaticService::includeAppCssStatic("/static/plugins/daterangepicker/daterangepicker.min.css",www\assets\MerchantAsset::className() );
StaticService::includeAppJsStatic( "/static/plugins/daterangepicker/jquery.daterangepicker.min.js", www\assets\MerchantAsset::className() );


StaticService::includeAppJsStatic("/static/js/merchant/default/chart.js",www\assets\MerchantAsset::className());
StaticService::includeAppJsStatic("/static/js/merchant/default/index.js",www\assets\MerchantAsset::className());
?>
<div class="row">
    <div class="row-in">
        <div class="columns-24">
            <div class="row chart_form_wrap">
                <div class="row-in">
                    <div class="columns-3">
                        <select class="select-1" name="custom_date">
                            <?php foreach( $custom_date as $_text => $_item ):?>
                                <option date_from="<?=$_item["date_from"];?>" date_to="<?=$_item["date_to"];?>"><?=$_text;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="columns-6">
                        <div class="input-wrap">
                            <input type="text" class="input-1 arrow" name="date_range_picker" value="">
                            <input type="hidden" class="input-1" name="date_from" value="2016-11-20">
                            <input type="hidden" class="input-1" name="date_to" value="2016-12-20">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="columns-12">
            <div class="box-1">
                <div class="row">
                    <div class="row-in">
                        <div class="columns-24" id="client_browser_chart">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns-12">
            <div class="box-1">
                <div class="row">
                    <div class="row-in">
                        <div class="columns-24" id="source_chart">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
