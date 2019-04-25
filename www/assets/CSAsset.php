<?php

namespace www\assets;

use common\components\GlobalUrlService;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CSAsset extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [];
	public $js = [];

	public function registerAssetFiles($view){
		$this->css = [
			GlobalUrlService::buildWwwUrl( "/static/bootstrap/v4/css/bootstrap.min.css" ),
			GlobalUrlService::buildWwwUrl( "/static/plugins/font-awesome/css/font-awesome.css" ),
			GlobalUrlService::buildWwwUrl( "/static/css/cs/common.css" ),
		];

		$this->js = [
			GlobalUrlService::buildWwwUrl("/static/plugins/jquery/jquery.min.js" ),
				GlobalUrlService::buildWwwUrl("/static/bootstrap/v4/js/bootstrap.min.js" ),
		];

		parent::registerAssetFiles($view);
	}
}
