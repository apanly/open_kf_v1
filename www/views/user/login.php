<?php
use \common\components\GlobalUrlService;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" href="<?=GlobalUrlService::buildWwwStaticUrl("/images/favicon.ico");?>" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title><?=Yii::$app->params["company"]["title"];?> -- 让交流更简单</title>
    <link href="<?=GlobalUrlService::buildWwwStaticUrl("/css/user/user.css");?>" rel="stylesheet">
</head>
<body>
<div class="wrap">
    <div class="mobile_nav">
        <div class="nav_box">
            <div class="logo"></div>
            <div class="icon_nav">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="nav_list">
            <p><a href="<?=GlobalUrlService::buildWwwUrl("/");?>">首页</a></p>
            <p><a href="<?=GlobalUrlService::buildWwwUrl("/user/login");?>">登录</a></p>
        </div>
    </div>

    <div class="user_box-wapper">
        <div class="user_main">
            <a href="javascript:void(0)" class="wappper"></a>
            <div class="user_top">
                <a href="<?=GlobalUrlService::buildWwwUrl("/");?>" class="home"><?=Yii::$app->params["company"]["title"];?></a>
                <span class="back-index"><a href="<?=GlobalUrlService::buildWwwUrl("/");?>">返回首页</a></span>
            </div>
            <div class="content">
                <div class="user_box-new" id="login">
                    <div class="login_content">
                        <h2>
                            账号密码登录
                        </h2>
                        <ul class="user_input pd-0">
                            <li>
                                <input type="text" class="input_box input_name" name="login_name" placeholder="请输入用户名">
                            </li>
                            <li>
                                <input type="password" class="input_box input_password" name="login_pwd" placeholder="请输入密码">
                            </li>
                        </ul>
                        <div class="user_button">
                            <a href="javascript:void(0);" class="btn_submit do_login">登录</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="user_bottom">
            <p class="copyright"><?=Yii::$app->params['company']['copyright'];?></p>
        </div>
    </div>


</div>
<script src="<?=GlobalUrlService::buildWwwStaticUrl("/plugins/jquery/jquery.min.js");?>"></script>
<script src="<?=GlobalUrlService::buildWwwStaticUrl("/js/user/login.js");?>"></script>    <!--百度统计代码-->

</body>
</html>
