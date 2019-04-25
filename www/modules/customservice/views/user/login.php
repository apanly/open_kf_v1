<?php
use \common\components\GlobalUrlService;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" href="<?=GlobalUrlService::buildWwwStaticUrl("/images/favicon.ico");?>" type="image/x-icon"/>
    <title><?=Yii::$app->params["company"]["title"];?>登录</title>
    <link href="<?=GlobalUrlService::buildWwwStaticUrl("/plugins/layui/css/layui.css");?>" rel="stylesheet">
    <link href="<?=GlobalUrlService::buildWwwStaticUrl("/css/cs/login.css");?>" rel="stylesheet">
</head>

<body>
<div class="login_box">
    <div class="login_l_img"><img src="<?=GlobalUrlService::buildWwwStaticUrl("/images/cs/login-img.png");?>" /></div>
    <div class="login">
        <div class="login_logo"><a href="javascript:void(0);"><img src="<?=GlobalUrlService::buildWwwStaticUrl("/images/logo_tiny.png");?>" /></a></div>
        <div class="login_name">
            <p><?=Yii::$app->params["company"]["title"];?>登录</p>
        </div>
        <div class="login-form">
            <input name="login_name" type="text" placeholder="请输入登录用户名~~" value=""  autocomplete="off">
            <input name="login_pwd" type="password"  placeholder="请输入登录密码~~" value="" autocomplete="off"/>
            <input value="登录" style="width:100%;" type="button" id="btn">
        </div>
    </div>
    <div class="copyright">
        <?=Yii::$app->params["company"]["copyright"];?>
    </div>
</div>
<script src="<?=GlobalUrlService::buildWwwStaticUrl("/plugins/jquery/jquery.min.js");?>"></script>
<script src="<?=GlobalUrlService::buildWwwStaticUrl("/plugins/layui/layui.js");?>"></script>
<script src="<?=GlobalUrlService::buildWwwStaticUrl("/js/cs/user/login.js");?>"></script>
</body>
</html>