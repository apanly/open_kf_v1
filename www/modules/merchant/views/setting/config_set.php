<?php

use \common\components\GlobalUrlService;
use \common\components\DataHelper;
use \common\components\StaticService;
use \common\services\Constants;
StaticService::includeAppJsStatic("/static/plugins/qiniu/plupload/moxie.min.js",www\assets\MerchantAsset::className());
StaticService::includeAppJsStatic("/static/plugins/qiniu/plupload/plupload.full.min.js",www\assets\MerchantAsset::className());
StaticService::includeAppJsStatic("/static/plugins/qiniu/plupload/zh_CN.js",www\assets\MerchantAsset::className());

StaticService::includeAppJsStatic("/static/plugins/qiniu/qiniu.min.js",www\assets\MerchantAsset::className());
StaticService::includeAppJsStatic("/static/plugins/qiniu/upload_qiniu.js",www\assets\MerchantAsset::className());
StaticService::includeAppJsStatic("/static/js/merchant/setting/config_set.js", \www\assets\MerchantAsset::className());

?>
<div class="row">
    <div class="row-in">
        <div class="columns-24">
            <?php echo \Yii::$app->view->renderFile("@www/modules/merchant/views/setting/tab.php", ['current' => 'index']); ?>
        </div>
        <div class="columns-12 offset-6 mg-t30 wrap_config_set">

            <div class="row">
                <div class="row-in">
                    <div class="columns-6">
                        <label class="label-name right inline"><i class="mark">*</i>商户名称</label>
                    </div>
                    <div class="columns-18">
                        <div class="input-wrap">
                            <input type="text" name="title" class="input-1" placeholder="请输入商户名称~" value="<?=( $info && isset( $info['title'] )?DataHelper::encode($info['title']):"" );?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row pic-wrap">
                <div class="row-in">
                    <div class="columns-6">
                        <label class="label-name right inline"><i class="mark">*</i>商户Logo</label>
                    </div>
                    <div class="columns-18 pic_logo_wrap">
                        <div class="pic-2 pull-left">
                            <div class="add-2 pull-left " id="config_logo_upload_container">
                                <i class="icon_club">&#xe60f;</i>
                                <input type="file" id="config_logo" name="pic" accept="image/png, image/jpeg, image/jpg,image/gif">
                            </div>
                            <?php if( $info && isset( $info['logo'] ) ):?>
                                <span class="pic-each" data="<?=$info['logo'];?>">
                                    <img src="<?=GlobalUrlService::buildPicStaticUrl( "avatar",$info['logo'],[ "w" => 120,"h" => 120 ] );;?>"/><span class="icon_club del"><i></i>&#xe612;</span>
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
                    <div class="columns-18">
                        <div class="input-wrap">
                            <input type="text" name="hello_world" class="input-1" placeholder="请输入客服欢迎语~~" value="<?=( $info && isset( $info['hello_world'] )?DataHelper::encode($info['hello_world']):"" );?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="row-in">
                    <div class="columns-6">
                        <label class="label-name right inline">浮层名称</label>
                    </div>
                    <div class="columns-18">
                        <div class="input-wrap">
                            <input type="text" name="pop_name" class="input-1" placeholder="请输入浮层名称~~" value="<?=( ( $info && isset( $info['pop_name'] ) && $info['pop_name'] ) ?DataHelper::encode($info['pop_name']):Constants::$kf_pop_name );?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row-in">
                    <div class="columns-6">
                        <label class="label-name right inline">
                            自动弹开
                        </label>
                    </div>
                    <div class="columns-18">
                        <div class="radio-wrap">
                            <input type="radio" class="radio-1" name="auto_open" id="auto_open_0" <?php if( !$info ||   $info['auto_open'] == 0 ):?> checked <?php endif;?> value="0">
                            <label for="auto_open_0">否</label>
                            <input type="radio" class="radio-1" name="auto_open" id="auto_open_1" <?php if( $info && isset( $info['auto_open'] ) &&  $info['auto_open'] == 1 ):?> checked <?php endif;?>  value="1">
                            <label for="auto_open_1">是</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="row-in">
                    <p class="columns-6 offset-6"><input type="button" value="保存" class="btn-small save"></p>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="hide wrap_hidden" >
    <div class="display_image">
        <span class="pic-each" data="">
            <img src=""/><span class="icon_club del"><i></i>&#xe612;</span>
        </span>
    </div>
</div>