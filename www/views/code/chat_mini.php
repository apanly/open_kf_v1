<?php

use \common\components\GlobalUrlService;
use \common\services\Constants;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?=Yii::$app->params["company"]["title"];?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="<?= GlobalUrlService::buildWwwStaticUrl("/plugins/layui/css/layui.css"); ?>">
    <link rel="stylesheet" href="<?= GlobalUrlService::buildWwwStaticUrl("/css/code/chat_mini.css"); ?>">
</head>
<body>
<div class="chat-container" id="app">
    <div class="layui-row chat-header">
        <div class="layui-col-xs2 chat-header-avatar">
            <img src="<?=GlobalUrlService::buildWwwStaticUrl( "/images/".Constants::$default_kf_avatar );?>" class="agent-avatar"/>
        </div>
        <div class="layui-col-xs7 chat-header-title">
            <?=Yii::$app->params["company"]["title"];?> 为您服务
        </div>
        <div class="layui-col-xs3 chat-header-tool" id="closeBtn">
            <i class="layui-icon layui-icon-down"></i>
        </div>
    </div>
    <div class="layui-row chat-body">
        <div class="chat-box">
            <div class="wrap_ad" style="margin: 0 auto 16px;border: 1px solid #DDE5ED; padding: 5px;font-size: 12px;text-align: center;word-wrap: break-word;overflow: hidden;display: none;">
                <a target="_blank" href="javascript:void(0);">
                    <img style="max-width: 100%;" src="">
                </a>
            </div>
        </div>
    </div>
    <div class="layui-row chat-footer">
        <div class="text-holder">
            <textarea id="textarea" placeholder="请反馈您的问题，我们会尽快回复~~"></textarea>
        </div>
        <div class="send-bar">
            <div class="tool-box">
                <i class="layui-icon layui-icon-face-smile" id="face" style="display: none;"></i>
                <i class="layui-icon layui-icon-picture" id="image" style="display: none;"></i>
                <span class="server_status">服务连接状态：<span class="layui-badge layui-bg-green">已连接</span></span>
            </div>
            <div class="send-btn-div">
                <input type="button" value="发送" class="send-input" id="sendBtn" style="float: right;">
            </div>
        </div>
    </div>
    <div class="layui-row copyright">
        <div class="layui-col-md12 layui-col-xs12">
            <a href="<?=\Yii::$app->params['auth_domain'];?>" target="_blank"><?=\Yii::$app->params['company']['title'];?>提供软件支持</a>
        </div>
    </div>
</div>

<div class="wrap_hide" style="display: none;">
    <input type="hidden" name="params" value='<?=$params;?>'>
    <div class="clearfloat guest_wrap">
        <div class="author-name">
            <small class="chat-date">xxx</small>
        </div>
        <div class="right">
            <div class="chat-message">xxx</div>
            <div class="chat-avatars">
                <img src="">
            </div>
        </div>
    </div>
    <div class="clearfloat kf_wrap">
        <div class="author-name">
            <small class="chat-date">xxx</small>
        </div>
        <div class="left">
            <div class="chat-avatars">
                <img src=""></div>
            <div class="chat-message">xxx</div>
        </div>
    </div>
    <div class="clearfloat system_wrap">
        <div class="author-name">
            <small class="chat-system">xxx</small>
        </div>
    </div>
    <div style="clear:both" class="chat-sep"></div>
</div>

<script src="<?= GlobalUrlService::buildWwwStaticUrl("/plugins/jquery/jquery.min.js"); ?>"></script>
<!--IE8只能支持jQuery1.9-->
<!--[if lte IE 8]>
<script src="<?= GlobalUrlService::buildWwwStaticUrl("/plugins/jquery/jquery_1_9.min.js"); ?>"></script>
<![endif]-->
<script src="<?= GlobalUrlService::buildWwwStaticUrl("/plugins/layui/layui.js"); ?>"></script>
<script src="<?= GlobalUrlService::buildWwwStaticUrl("/plugins/moment.js"); ?>"></script>
<script src="<?= GlobalUrlService::buildWwwStaticUrl("/plugins/web-socket-js/swfobject.js"); ?>"></script>
<script src="<?= GlobalUrlService::buildWwwStaticUrl("/plugins/web-socket-js/web_socket.js"); ?>"></script>
<script src="<?= GlobalUrlService::buildWwwStaticUrl("/js/code/chat.js"); ?>"></script>
</body>
</html>