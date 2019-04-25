<?php
use \common\components\StaticService;
use \common\components\GlobalUrlService;
StaticService::includeAppCssStatic("/static/plugins/datetimepicker/jquery.datetimepicker.min.css",www\assets\MerchantAsset::className() );
StaticService::includeAppJsStatic( "/static/plugins/datetimepicker/jquery.datetimepicker.full.min.js", www\assets\MerchantAsset::className() );

StaticService::includeAppJsStatic("/static/js/merchant/stat/search.js",www\assets\MerchantAsset::className() );

?>
<div class="row">
    <div class="row-in">
        <div class="columns-24">
            <?php echo \Yii::$app->view->renderFile("@www/modules/merchant/views/stat/tab.php", ['current' => 'trace']); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="row-in">
        <form id="search_conditions">
            <div class="columns-4">
                <div class="row">
                    <div class="row-in">
                        <div class="columns-6">
                            <label class="label-name inline">日期</label>
                        </div>
                        <div class="columns-18">
                            <div class="input-wrap">
                                <div class="input-wrap">
                                    <input type="text" class="input-1" placeholder="开始日期" name="date_from" value="<?=$search_conditions['date_from'];?>" data-date-format="yyyy-mm-dd" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="columns-3">
                <div class="row">
                    <div class="row-in">
                        <div class="columns-4 text-left">
                            <label class="label-name inline">至</label>
                        </div>
                        <div class="columns-20">
                            <div class="input-wrap">
                                <input type="text" name="date_to" class="input-1" placeholder="结束日期" value="<?=$search_conditions['date_to'];?>" data-date-format="yyyy-mm-dd" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="columns-5">
                <input type="submit" value="搜索" class="do btn-tiny">
            </div>
        </form>

    </div>
</div>
<div class="row">
    <div class="row-in">
        <div class="title-3a">
            <div class="columns-16">
                <p>搜索结果：共<?=$pages['total_count'];?>条</p>
            </div>
        </div>
        <div class="columns-24">
            <table class="table-1">
                <thead>
                <tr>
                    <th width="6%">序号</th>
                    <th>目标URL</th>
                    <th width="18%">来源</th>
                    <th width="12%">UUID</th>
                    <th width="4%">操作系统</th>
                    <th width="6%">浏览器</th>
                    <th width="6%">设备</th>
                    <th width="10%">IP</th>
                    <th width="10%">地址</th>
                    <th width="12%">时间</th>
                </tr>
                </thead>
                <tbody>
                <?php if($list):?>
                    <?php foreach($list as $_item):?>
                        <tr class="centered">
                            <td><?=$_item['id'];?></td>
                            <td><?=$_item['talk_url'];?> </td>
                            <td><?=$_item['referer'];?> </td>
                            <td><?=$_item['f_code'];?></td>
                            <td><?=$_item['client_os'];?></td>
                            <td><?=$_item['client_browser'];?></td>
                            <td><?=$_item['client_device'];?></td>
                            <td><?=$_item['ip'];?></td>
                            <td><?=$_item['ip_desc'];?></td>
                            <td><?=$_item['created_time'];?></td>
                        </tr>
                    <?php endforeach;?>
                <?php else:?>
                    <tr><td colspan="10">暂无数据</td></tr>
                <?php endif;?>
                </tbody>
            </table>
        </div>
        <div class="columns-24 text-right">
            <?php echo \Yii::$app->view->renderFile("@www/modules/merchant/views/common/pagination.php",[
                'pages' => $pages,
                'url' => '/stat/trace',
                'search_conditions' => $search_conditions,
                'current_page_count' => count($list)
            ]);?>
        </div>
    </div>
</div>