<?php
namespace common\components;

use yii\helpers\Url;

class GlobalUrlService {

	public static function buildWwwUrl(  $uri, $params = [] ){
		$path = Url::toRoute(array_merge([ $uri ], $params));
		$domain = \Yii::$app->params['domains']['www'];
		return $domain.$path;
	}

    public static function buildMerchantUrl(  $uri, $params = [] ){
        $path = Url::toRoute(array_merge([ $uri ], $params));
        $domain = \Yii::$app->params['domains']['merchant'];
        return $domain.$path;
    }


	public static function buildCsUrl($uri, $params = []){
		$path = Url::toRoute(array_merge([ $uri ], $params));
		$domain = \Yii::$app->params['domains']['cs'];
		return $domain.$path;
	}

	public static function buildWwwStaticUrl(  $uri, $params = [] ){
        $release_version = defined("RELEASE_VERSION") ? RELEASE_VERSION : time();
		$params = $params + [ "ver" => $release_version ];
		$path = Url::toRoute(array_merge([ $uri ], $params));
		$domain = \Yii::$app->params['domains']['www'];
		return $domain."/static".$path;
	}


    public static function buildNullUrl(){
    	return "javascript:void(0);";
	}
} 