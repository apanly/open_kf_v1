<?php

use yii\helpers\Html;
use www\assets\AppAsset;
use \common\components\GlobalUrlService;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1" />
    <title><?=Yii::$app->params["company"]["title"];?> -- 让交流更简单</title>
    <link rel="icon" href="<?=GlobalUrlService::buildWwwStaticUrl("/images/favicon.ico");?>" type="image/x-icon"/>
    <meta name="description" content="">
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="javascript:void(0);" style="height: 40px;padding: 0;">
        <img class="rounded-circle" src="<?=GlobalUrlService::buildWwwStaticUrl("/images/logo.png");?>" title="<?=Yii::$app->params["company"]["title"];?>" style="height: 40px;" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="javascript:void(0);">首页</a>
            </li>
        </ul>
        <a class="btn btn-primary" href="<?=GlobalUrlService::buildWwwUrl("/user/login");?>">登录</a>
        <a class="btn btn-success mb-3 mb-md-0 ml-md-3" target="_blank" href="<?=Yii::$app->params['auth_domain'];?>">授权官方网站</a>
    </div>
</nav>
<div class="container-fluid" style="margin-top: 56px;min-height: 600px; padding: 0;" >
    <?= $content ?>
</div>

<footer class="text-muted" style="color: #6c757d!important;">
    <hr>
    <div class="container">
        <p><?=Yii::$app->params['company']['copyright'];?></p>
    </div>
</footer>
<script src="<?=GlobalUrlService::buildWwwUrl("/static/plugins/jquery/jquery.min.js" );?>"></script>
<!--IE8只能支持jQuery1.9-->
<!--[if lte IE 8]>
<script src="<?= GlobalUrlService::buildWwwStaticUrl("/plugins/jquery/jquery_1_9.min.js"); ?>"></script>
<![endif]-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
