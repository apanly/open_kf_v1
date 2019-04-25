<?php
use \common\components\GlobalUrlService;
use \common\components\DataHelper;
use \common\components\StaticService;

StaticService::includeAppCssStatic("/static/plugins/highlight/default.min.css",\www\assets\MerchantAsset::className() );
StaticService::includeAppJsStatic("/static/plugins/highlight/highlight.min.js",\www\assets\MerchantAsset::className() );
StaticService::includeAppJsStatic("/static/js/merchant/help/index.js",\www\assets\MerchantAsset::className() );

?>
<div class="row">
    <div class="row-in">
        <div class="columns-24">
            <?php echo \Yii::$app->view->renderFile("@www/modules/merchant/views/help/tab.php", ['current' => 'index']); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="row-in">
        <div class="columns-24">
            <div class="box-3">
                <div class="row">
                    <div class="row-in">
                        <div class="title-3">
                            <div class="columns-24"><h2>接入帮助</h2></div>
                        </div>
                        <div class="columns-24">
                            <div class="text-wrap-1" style="font-size: 16px;">
                                <p>在您要接入的网站内<?=DataHelper::encode('</body>');?>前添加如下的代码：</p>
                                <p class="color-success">
                                    <pre>
                                    <code class="html">
<?php
$code = <<<EOT
<script>
    <!--ST客服代码-->
    (function () {
        var _stkf_code = document.createElement("script");
        _stkf_code.src = "{$url}";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(_stkf_code, s);
    })();
</script>
                                    
EOT;
echo DataHelper::encode( $code );
?>
                                    </code>
                                    </pre>
                                </p>
                                <p class="mg-t15">
                                    客服登录地址：<a class="color-theme" target="_blank" href="<?=$url_cs;?>"><?=$url_cs;?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>