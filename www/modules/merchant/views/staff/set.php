<?php

use \common\components\GlobalUrlService;
use \common\components\StaticService;


StaticService::includeAppJsStatic("/static/js/merchant/staff/set.js",\www\assets\MerchantAsset::className() );
?>
<div class="row">
    <div class="row-in">
        <div class="columns-24">
            <?php echo \Yii::$app->view->renderFile("@www/modules/merchant/views/staff/tab.php", ['current' => 'index']); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="row-in wrap_staff_set">
        <div class="columns-12 offset-6 mg-t30">
            <div class="row">
                <div class="row-in">
                    <div class="columns-6">
                        <label class="label-name right inline"><i class="mark">*</i>昵称</label>
                    </div>
                    <div class="columns-18">
                        <div class="input-wrap">
                            <input type="text" name="nickname" class="input-1" value="<?=isset( $info['nickname'] )?$info['nickname']:'';?>" placeholder="请输入客服昵称">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row-in">
                    <div class="columns-6">
                        <label class="label-name right inline"><i class="mark">*</i>登录用户名</label>
                    </div>
                    <div class="columns-18">
                        <div class="input-wrap">
                            <input type="text" name="login_name" class="input-1" value="<?=isset( $info['login_name'] )?$info['login_name']:'';?>" placeholder="请输入登录用户名，建议使用手机号码~~">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row-in">
                    <div class="columns-6">
                        <label class="label-name right inline"><i class="mark">*</i>登录密码</label>
                    </div>
                    <div class="columns-18">
                        <div class="input-wrap">
                            <input type="text" name="login_pwd" class="input-1" placeholder="请输入登录密码~~" value="<?=isset( $info['login_pwd'] )?$info['login_pwd']:'';?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row-in">
                    <p class="columns-6 offset-6">
                        <input type="hidden" name="id" value="<?=isset( $info['id'] )?$info['id']:0;?>">
                        <input type="button" value="保存" class="btn-small save">
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>