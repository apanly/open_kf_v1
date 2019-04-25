<?php
namespace common\services;


use common\components\HttpClient;

class QiniuUploadService extends BaseService{
	public function getConfig(){
		return \Yii::$app->params['upload']['qiniu_config'];
	}

	public function getUploadKey($key, $bucket = "vincentguo-pic2"){

		$config = $this->getConfig();
		$auth   = new \Qiniu\Auth($config['ak'], $config['sk']);

		if (!empty($config['bucket'])) {
			$bucket = $config['bucket'];
		}
		return $auth->uploadToken($bucket, $key);
	}


}