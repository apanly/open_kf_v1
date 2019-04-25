<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace www\assets;

use common\components\GlobalUrlService;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MerchantAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [];

    public function registerAssetFiles($view){
        $this->css = [
            GlobalUrlService::buildWwwStaticUrl("/css/merchant/common_default.css"),
            GlobalUrlService::buildWwwStaticUrl("/css/merchant/scrollbar.min.css"),
            GlobalUrlService::buildWwwStaticUrl("/plugins/font-awesome/css/font-awesome.min.css"),
        ];

        $this->js = [
            GlobalUrlService::buildWwwStaticUrl('/plugins/jquery/jquery.min.js'),
            GlobalUrlService::buildWwwStaticUrl('/plugins/jquery/jquery.mCustomScrollbar.min.js'),
            GlobalUrlService::buildWwwStaticUrl('/plugins/jquery/jquery.mousewheel.min.js'),
            GlobalUrlService::buildWwwStaticUrl('/js/merchant/core.min.js'),
            GlobalUrlService::buildWwwStaticUrl('/js/merchant/common.js')
        ];
        parent::registerAssetFiles($view);
    }
}
