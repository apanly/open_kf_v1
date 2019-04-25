<?php
use \common\components\GlobalUrlService;
?>
<div class="jumbotron">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="display-3">优秀的客服系统</h1>
                <p>我们的客服系统使用世界上最好的语言PHP进行开发，架构是Yii2 + GatewayWorker + Mysql + Redis 支持高并发</p>
                <p>支持PC + 手机H5 + 微信小程序 + 微信公众号</p>
                <p>浪子开源云客服交流群：<a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=fd865a667498c7256ae33d274ab97cfaa7f97ac7e23f061b9a37c4619ddef37e"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="浪子开源云客服交流群" title="浪子开源云客服交流群"></a></p>
                <p><?=Yii::$app->params['auth_busi'];?></p>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <img class="card-img-top"  style="width: 100%; display: block;" src="<?=GlobalUrlService::buildWwwStaticUrl("/images/auth/merge.png");?>">
                </div>
            </div>
        </div>

    </div>
</div>
<div class="row" style="padding: 0 5rem;">
    <div class="col-lg-4">
        <h2>整合简单，快速部署</h2>
        <p>您只需要一段js便可以使您的网站拥有客服功能，为您的会员提供最优服务。</p>
    </div>
    <div class="col-lg-4">
        <h2>用世界上最好的语言编写</h2>
        <p>系统采用 Yii2 + GatewayWorker 编写，性能强悍，完全满足您的企业咨询需求。</p>
    </div>
    <div class="col-lg-4 d-none">
        <h2>提供源码，随心所欲</h2>
        <p>您不需为购买的客服坐席到期而烦恼，也无需为您的数据安全担心。自己搭建，控制权在自己。</p>
    </div>
    <div class="col-lg-4">
        <h2>Saas多商户客服系统</h2>
        <p>您不需为购买的客服坐席到期而烦恼，也无需为您的数据安全担心。</p>
    </div>
</div>
<div class="row" style="padding: 0 5rem;">
    <div class="col-lg-12">
        <hr/>
    </div>
    <div class="col-lg-4">
        <div class="card mb-4 box-shadow">
            <div class="card-header">
                开源版本
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title text-center text-success">¥ 0.00</h1>
                <ul>
                    <li>获取开源V1版全部的源码</li>
                    <li>技术架构：Yii2 + GatewayWorker + Mysql  </li>
                    <li>QQ群交流， 不提供技术支持</li>
                    <li>仅供学习参考使用，不可商用</li>
                    <li>功能包含：</li>
                    <li>1. 提供商家和客服后台</li>
                    <li>2. 游客聊天</li>
                    <li>3. 提供来路和浏览器统计</li>
                    <li>4. 商家后台添加客服</li>
                    <li>5. 支持PC + 手机端</li>
                    <li style="visibility: hidden;">&nbsp;</li>
                    <li style="visibility: hidden;">&nbsp;</li>
                    <li style="visibility: hidden;">&nbsp;</li>
                    <li style="visibility: hidden;">&nbsp;</li>
                    <li style="visibility: hidden;">&nbsp;</li>
                    <li style="visibility: hidden;">&nbsp;</li>
                </ul>
                <button type="button" data-toggle="modal" data-target="#pop_auth" class="btn btn-lg btn-block btn-outline-primary">获取开源V1版本</button>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card mb-4 box-shadow">
            <div class="card-header">
                单商户收费版本
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title text-center text-success">¥ 1299.00</h1>
                <ul>
                    <li>获取单商户收费全部的源码</li>
                    <li>技术架构：Yii2 + GatewayWorker + Mysql  </li>
                    <li>专门商业服务群，提供技术支持</li>
                    <li>授权可商用</li>
                    <li>功能包含：</li>
                    <li>1. 提供商家和客服后台</li>
                    <li>2. 游客聊天</li>
                    <li>3. 提供来路、浏览器、操作系统、设备、访问量统计</li>
                    <li>4. 留言功能</li>
                    <li>5. 商家后台添加客服</li>
                    <li>6. 支持PC + 手机端 + 微信小程序</li>
                    <li style="visibility: hidden;">&nbsp;</li>
                    <li style="visibility: hidden;">&nbsp;</li>
                    <li style="visibility: hidden;">&nbsp;</li>
                    <li style="visibility: hidden;">&nbsp;</li>
                </ul>
                <button type="button"  data-toggle="modal" data-target="#pop_auth" class="btn btn-lg btn-block btn-outline-primary">获取授权</button>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card mb-4 box-shadow">
            <div class="card-header">
                多商户高并发收费版本
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title text-center text-success">¥ 3499.00</h1>
                <ul>
                    <li>获取多商户高并发收费全部的源码</li>
                    <li>技术架构：Yii2 + GatewayWorker + Mysql + Redis </li>
                    <li>专门商业服务群，提供技术支持</li>
                    <li>授权可商用、会持续更新</li>
                    <li>功能包含：</li>
                    <li>1. 提供商家和客服后台</li>
                    <li>2. 游客聊天，支持游客编号</li>
                    <li>3. 提供来路、浏览器、操作系统、设备、访问量统计</li>
                    <li>4. 留言功能</li>
                    <li>5. 商家后台添加客服</li>
                    <li>6. 定制化设置商户配置（自动弹出、浮层名称、商户名称）</li>
                    <li>7. 支持PC + 手机端 + 微信小程序 + 微信公众号</li>
                </ul>
                <button type="button"  data-toggle="modal" data-target="#pop_auth" class="btn btn-lg btn-block btn-outline-primary">获取授权</button>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <hr/>
    </div>
    <div class="col-lg-12">
        <img src="<?=GlobalUrlService::buildWwwStaticUrl("/images/example/screen_3.png");?>" class="img-fluid">
        <img src="<?=GlobalUrlService::buildWwwStaticUrl("/images/example/screen_1.png");?>" class="img-fluid">
        <img src="<?=GlobalUrlService::buildWwwStaticUrl("/images/example/screen_2.jpg");?>" class="img-fluid">
    </div>
</div>

<div class="modal fade" id="pop_auth" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">联系方式
                    <a class="btn btn-success mb-3 mb-md-0 ml-md-3" target="_blank" href="<?=Yii::$app->params['auth_domain'];?>">授权官方网站</a></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-group">
                    <div class="card">
                        <img class="card-img-top" src="<?=GlobalUrlService::buildWwwStaticUrl("/images/auth/qq.png");?>">
                        <div class="card-body">
                            <h5 class="card-title">QQ群</h5>
                            <p class="card-text">加入QQ群咨询群主</p>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top" src="<?=GlobalUrlService::buildWwwStaticUrl("/images/auth/wechat_fwh.png");?>">
                        <div class="card-body">
                            <h5 class="card-title">微信公众号</h5>
                            <p class="card-text">关注公众号获得即时更新通知</p>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top" src="<?=GlobalUrlService::buildWwwStaticUrl("/images/auth/wechat_my.png");?>">
                        <div class="card-body">
                            <h5 class="card-title">个人微信</h5>
                            <p class="card-text">加个人微信咨询商业版本</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?=Yii::$app->params['auth_busi'];?>
            </div>
        </div>
    </div>
</div>
<script>
    <!--ST客服代码-->
    (function () {
        var _stkf_code = document.createElement("script");
        _stkf_code.src = "//v1.stkf.test/code/index";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(_stkf_code, s);
    })();
</script>