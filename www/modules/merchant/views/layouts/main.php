<?php
use www\assets\MerchantAsset;
use \common\components\GlobalUrlService;
MerchantAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="<?=GlobalUrlService::buildWwwStaticUrl("/images/favicon.ico");?>" type="image/x-icon"/>
    <title><?=Yii::$app->params["company"]["title"];?> -- 商户后台</title>
    <?php $this->head() ?>
    <?php $this->beginBody() ?>
</head>
<body>
<div class="page_wrap">
    <div class="box_wrap">
        <div class="box_left_nav">
            <h1 class="logo-default">
                <a target="_blank" href="<?= GlobalUrlService::buildWwwUrl("/"); ?>">
                    <img src="<?= GlobalUrlService::buildWwwStaticUrl("/images/logo_tiny.png"); ?>" alt="<?= Yii::$app->params['company']['title']; ?>" class="tiny"/>
                    <img src="<?= GlobalUrlService::buildWwwStaticUrl("/images/logo.png"); ?>" alt="<?= Yii::$app->params['company']['title']; ?>" class="normal"/>
                </a>
            </h1>

            <h2 class="version">云客服</h2>
            <ul class="menu_list">
                <li class="dashboard">
                    <a href="<?= GlobalUrlService::buildMerchantUrl("/"); ?>">
                        <i class="icon_club">&#xe6c0;</i><span>仪表盘</span>
                    </a>
                </li>
                <li class="chat">
                    <a href="<?= GlobalUrlService::buildMerchantUrl("/chat/log"); ?>">
                        <i class="icon_club">&#xe61e;</i><span>日志</span>
                    </a>
                </li>
                <li class="stat">
                    <a href="<?= GlobalUrlService::buildMerchantUrl("/stat/trace"); ?>">
                        <i class="fa fa-pie-chart fa-lg"></i><span>统计</span>
                    </a>
                </li>
                <li class="staff">
                    <a href="<?= GlobalUrlService::buildMerchantUrl("/staff/index"); ?>">
                        <i class="icon_club">&#xe60b;</i><span>客服</span>
                    </a>
                </li>
                <li class="help">
                    <a href="<?= GlobalUrlService::buildMerchantUrl("/help/index"); ?>">
                        <i class="icon_club">&#xe624;</i><span>接入帮助</span>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="<?= GlobalUrlService::buildMerchantUrl("/help/cs"); ?>">
                        <i class="icon_club">&#xe60c;</i><span>客服工作台</span>
                    </a>
                </li>
            </ul>
            <span class="menu_switch"><i class="icon_club">&#xe602;</i><i class="icon_club arrow_left">&#xe60e;</i></span>
        </div>
        <div class="box_main">
            <div class="box_top">
                <div class="row">
                    <div class="row-in">
                        <div class="columns-24">
                            <div class="top_right hastips">
                                <a href="<?= GlobalUrlService::buildMerchantUrl("/notice/index") ?>" class="icon_club hide" data-tip="消息">
                                    <span class="icon_club icon1">&#xe60a;</span>
                                </a>

                                <a href="javascript:void(0);" class="icon_club user has-panel" data-panel="user_menu">
                                    <img src="<?= GlobalUrlService::buildWwwStaticUrl("/images/no-avatar.png"); ?>" alt="80*80"/>
                                </a>
                                <ul class="user_menu hide">
                                    <li class="user_profile border">
                                        <p class="icon_club user">
                                            <img src="<?= GlobalUrlService::buildWwwStaticUrl("/images/no-avatar.png"); ?>" alt="80*80"/>
                                        </p>
                                        <p class="t1">
                                            <label class="t2"><?= $this->params['current_user']["login_name"]; ?></label>
                                        </p>
                                        <p class="t3"><?= $this->params['current_user']["login_name"]; ?></p>
                                        <a href="<?= GlobalUrlService::buildMerchantUrl("/user/set"); ?>" class="user_edit hide" style="display: none;">编辑</a>
                                    </li>
                                    <li class="each border" style="display: none;">
                                        <a href="<?= GlobalUrlService::buildMerchantUrl("/user/pwd"); ?>"><i
  class="icon_club">&#xe610;</i>修改密码</a>
                                    </li>
                                    <li class="each">
                                        <a href="<?= GlobalUrlService::buildMerchantUrl("/user/logout"); ?>"><i class="icon_club">&#xe618;</i>退出</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content_wrap">
                <?php echo $content ?>
            </div>
        </div>
    </div>
    <div class="footer_wrap">
        <div class="inner">
            <?= Yii::$app->params['company']['copyright']; ?>
            &nbsp;&nbsp;|&nbsp;&nbsp;<?= Yii::$app->params['company']['phone']; ?>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
