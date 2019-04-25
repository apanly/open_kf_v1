<?php

use \common\components\StaticService;
use \common\components\GlobalUrlService;
use \common\components\DataHelper;

StaticService::includeAppJsStatic("/plugins/web-socket-js/swfobject.js", \www\assets\CSAsset::className());
StaticService::includeAppJsStatic("/plugins/web-socket-js/web_socket.js", \www\assets\CSAsset::className());
StaticService::includeAppJsStatic("/static/js/cs/index.js", \www\assets\CSAsset::className());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?= Yii::$app->params["company"]["title"]; ?></title>
    <link rel="icon" href="<?= GlobalUrlService::buildWwwStaticUrl("/images/favicon.ico"); ?>" type="image/x-icon"/>
    <link href="<?= GlobalUrlService::buildWwwStaticUrl("/plugins/layui/css/layui.css"); ?>" rel="stylesheet">
    <link href="<?= GlobalUrlService::buildWwwStaticUrl("/css/cs/chat.css"); ?>" rel="stylesheet">
</head>
<body>
<header class="service-header">
    <div class="service-log">
        <img src="<?= GlobalUrlService::buildWwwStaticUrl("/images/logo_tiny.png"); ?>">
    </div>
    <div class="service-title">客服工作台</div>
    <div class="service-status layui-text" style="height: 60px;line-height: 60px;color: #FFFFFF;">
        客服服务连接状态：<span class="layui-badge"></span>
    </div>
    <div class="service-info">
        <i class="layui-icon layui-icon-friends"></i>
        <span class="kefu"><?= DataHelper::encode($info['nickname']); ?></span>
        <span class="login-out">
            <a class="layui-text layui-btn layui-btn-danger layui-btn-sm"
               href="<?= GlobalUrlService::buildCsUrl( "/user/logout"); ?>">退出</a>
        </span>
    </div>
</header>
<div class="layui-row service-content">
    <div class="layui-col-xs1 service-menu">
        <div class="kefu-info">

            <button class="layui-btn layui-btn-danger onwork" <?php if( $info['online_status'] ):?>  style="display: none;" <?php endif;?> >开始上班</button>
            <button class="layui-btn layui-btn-danger offline" <?php if( !$info['online_status'] ):?>  style="display: none;" <?php endif;?>>我下班啦</button>
<!--            <img src="--><?//= GlobalUrlService::buildPicStaticUrl("avatar", $info['avatar']); ?><!--"/>-->
<!--            <span class="status online"></span>-->
<!--            <span class="user-status">在线</span>-->
        </div>
        <div class="now-chat active">
            <i class="layui-icon layui-icon-dialogue"></i>
            <span>当前会话</span>
        </div>
    </div>

    <div class="layui-col-xs2 visitor-list" id="visitor-list">

    </div>
    <div class="layui-col-xs2 visitor-list" id="queue-list" style="display: none"></div>

    <div class="layui-col-xs7 service-chat-box">
        <div class="chat-container">
            <div class="layui-row chat-header" id="now-chat-box">
                <div id="reLink" style="display: none;">
                    <i class="layui-icon layui-icon-release"></i>
                    <span>转接当前会话</span>
                </div>
                <div id="closeChat">
                    <i class="layui-icon layui-icon-close"></i>
                    <span>关闭当前会话</span>
                </div>
            </div>
            <div class="layui-row chat-header" id="pre-link-box" style="display: none">
                <div id="takeCare">
                    <i class="layui-icon layui-icon-dialogue"></i>
                    <span>接待访客</span>
                </div>
            </div>

            <div class="layui-row chat-body" id="chat-area">
                <!--接待中心-->
            </div>
            <div class="layui-row chat-footer">
                <div class="text-holder">
                    <textarea id="textarea" placeholder="请输入"></textarea>
                </div>
                <div class="send-bar">
                    <div class="tool-box">
                        <i class="layui-icon layui-icon-face-smile" id="face" style="display: none;"></i>
                        <i class="layui-icon layui-icon-picture" id="image" style="display: none;"></i>
                    </div>
                    <div class="send-btn-div">
                        <input type="button" value="发送" class="send-input active" id="sendBtn" style="float: right;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-col-xs2 service-bar">
        <div class="layui-tab" style="margin: 0">
            <ul class="layui-tab-title">
                <li class="layui-this">用户信息</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <div class="message" style="margin-top: 16px">
                        <p>
                            <label>昵称：</label>
                            <input disabled="disabled" class="message-input" value="" id="nickname">
                        </p>
                    </div>
                    <div class="message" style="margin-top: 16px;display: none;">
                        <p>
                            <label>游客标示：</label>
                            <input disabled="disabled" class="message-input" value="" id="guest_code">
                        </p>
                    </div>
                    <div class="message" style="margin-top: 16px">
                        <p>
                            <label>IP地址：</label>
                            <input disabled="disabled" class="message-input" value="" id="ip_addr">
                        </p>
                    </div>
                    <div class="message" style="margin-top: 16px">
                        <p>
                            <label>地址：</label>
                            <input disabled="disabled" class="message-input" value="" id="address">
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 常用语 -->
<div class="layui-row" id="word" style="display: none">
    <div class="layui-col-xs12">
        <table class="layui-table">
            <thead>
            <tr>
                <th>内容</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>测试的</td>
                <td style="cursor: pointer;color: #01AAED" data-content="测试的" onclick="sendWord(this)"> 发送</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- 常用语 -->

<!-- 转接提示层 -->
<div class="layui-form" id="change-box" style="display: none">
    <div class="layui-form-item" style="margin-top: 20px">
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title" id="change-group-title">

            </ul>
            <div class="layui-tab-content" id="relink-tab">

            </div>
        </div>
    </div>
</div>
<!-- 转接提示层 -->
<div class="hide_wrap hidden" style="display: none;">
    <input type="hidden" name="ws" value="<?= $ws; ?>">
    <input type="hidden" name="info" value='<?= json_encode($info); ?>'>
    <!--游客头像列表-->
    <div class="visitor-card" id="xx-">
        <img src="" class="head-msg">
        <div class="msg">
            <p>
                <span class="name">xx</span>
                <span class="visitor-card-time">2019-04-02 16:51:41</span>
            </p>
            <p style="position: relative;"><span class="count" style="display: none;">0</span></p>
        </div>
    </div>
    <!--游客聊天内容wrap-->
    <div class="chat-box" id="ct-xxx" style="display: none;"></div>
    <!--游客聊天内容模板-->
    <div class="clearfloat guest_wrap">
        <div class="author-name">
            <small class="chat-date">2019-04-01 22:39:00</small>
        </div>
        <div class="right">
            <div class="chat-message">你好哇哈哈哈</div>
            <div class="chat-avatars"><img src=""></div>
        </div>
    </div>
    <!--客服聊天内容模板-->
    <div class="clearfloat my_wrap">
        <div class="author-name">
            <small class="chat-date">2019-04-02 16:51:48</small>
        </div>
        <div class="left">
            <div class="chat-avatars">
                <img src="http://whisper_v2.kefu.test/static/common/images/customer.png">
            </div>
            <div class="chat-message">dddd</div>
        </div>
    </div>
    <!--chat sep-->
    <div class="chat-sep" style="clear:both"></div>
</div>
<script src="<?= GlobalUrlService::buildWwwStaticUrl("/plugins/jquery/jquery.min.js"); ?>"></script>
<script src="<?= GlobalUrlService::buildWwwStaticUrl("/plugins/layui/layui.js"); ?>"></script>
<script src="<?= GlobalUrlService::buildWwwStaticUrl("/plugins/moment.js"); ?>"></script>
<script src="<?= GlobalUrlService::buildWwwStaticUrl("/plugins/web-socket-js/swfobject.js"); ?>"></script>
<script src="<?= GlobalUrlService::buildWwwStaticUrl("/plugins/web-socket-js/web_socket.js"); ?>"></script>
<script src="<?= GlobalUrlService::buildWwwStaticUrl("/js/cs/default/index.js"); ?>"></script>
</body>
</html>