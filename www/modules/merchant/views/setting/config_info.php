<?php
use \common\components\GlobalUrlService;
use \common\components\DataHelper;
use \common\components\StaticService;
use \common\services\Constants;
StaticService::includeAppCssStatic("/static/plugins/fancy/jquery.fancybox.css",www\assets\MerchantAsset::className());
StaticService::includeAppJsStatic("/static/plugins/fancy/jquery.fancybox.pack.js",www\assets\MerchantAsset::className());

StaticService::includeAppJsStatic("/static/js/merchant/setting/index.js",\www\assets\MerchantAsset::className() );

?>
<div class="row">
    <div class="row-in">
        <div class="columns-24">
            <?php echo \Yii::$app->view->renderFile("@www/modules/merchant/views/setting/tab.php", ['current' => 'index']); ?>
        </div>
        <div class="columns-12 offset-6 mg-t30">
            <div class="row">
                <div class="row-in">
                    <div class="columns-6">
                        <label class="label-name right inline">商户名称</label>
                    </div>
                    <div class="columns-18">
                        <label class="label-name left inline"><?=( $info && isset( $info['title'] )?DataHelper::encode($info['title']):"" );?></label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="row-in">
                    <div class="columns-6">
                        <label class="label-name right inline">商户Logo</label>
                    </div>
                    <div class="columns-18 ">
                        <div class="pic-1 pull-left">
                            <?php if( $info && isset( $info['logo'] ) ):?>
							<span class="pic-each">
                                <a class="gallary_fancy" rel="gallary_fancy" href="<?=GlobalUrlService::buildPicStaticUrl( "avatar",$info['logo'],[ "w" => 180 ] );?>">
								<img src="<?=GlobalUrlService::buildPicStaticUrl( "avatar",$info['logo'],[ "w" => 120,"h" => 120 ] );?>" class="avatar">
                                </a>
                            </span>
                            <?php endif;?>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="row-in">
                    <div class="columns-6">
                        <label class="label-name right inline">商户欢迎语</label>
                    </div>
                    <div class="columns-18"><?=( $info && isset( $info['hello_world'] )?DataHelper::encode($info['hello_world']):"" );?></div>
                </div>
            </div>

            <div class="row">
                <div class="row-in">
                    <div class="columns-6">
                        <label class="label-name right inline">自动弹出</label>
                    </div>
                    <div class="columns-18"><?=( $info && isset( $info['auto_open'] ) && $info['auto_open'] == 1 )?"是":"否" ;?></div>
                </div>
            </div>

            <div class="row">
                <div class="row-in">
                    <div class="columns-6">
                        <label class="label-name right inline">浮层名称</label>
                    </div>
                    <div class="columns-18"><?=( ( $info && isset( $info['pop_name'] ) && $info['pop_name'] )?DataHelper::encode($info['pop_name']):Constants::$kf_pop_name );?></div>
                </div>
            </div>

            <div class="row">
                <div class="row-in">
                    <p class="columns-6 offset-6">
                        <a class="btn-small" href="<?=GlobalUrlService::buildMerchantUrl("/setting/config-set");?>">编辑</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
