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
			<?php echo \Yii::$app->view->renderFile("@www/modules/merchant/views/stat/tab.php", ['current' => 'os']); ?>
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
        <div class="columns-24">
            <table class="table-1">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>日期</th>
                    <th>OS</th>
                    <th>总次数</th>
                </tr>
                </thead>
                <tbody>
				<?php if($data):?>
					<?php foreach($data as $_item):?>
                        <tr>
                            <td class="text-center"><?=$_item['id'];?></td>
                            <td><?=$_item['date'];?> </td>
                            <td>
                                <a class="color-theme" target="_blank" href="<?=GlobalUrlService::buildMerchantUrl("/stat/trace",[ 'client_os' => $_item['client_os'] ]);?>">
									<?=$_item['client_os'];?>
                                </a>
                            </td>
                            <td><?=$_item['total_number'];?> </td>
                        </tr>
					<?php endforeach;?>
				<?php else:?>
                    <tr><td colspan="4">暂无数据</td></tr>
				<?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="row-in">
        <div class="columns-24 text-right">
            <?php echo \Yii::$app->view->renderFile("@www/modules/merchant/views/common/pagination.php",[
                'pages' => $pages,
                'url' => '/stat/os',
                'search_conditions' => $search_conditions,
                'current_page_count' => count($data)
            ]);?>
        </div>
    </div>
</div>