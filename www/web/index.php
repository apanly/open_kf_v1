<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../../common/config/main-local.php',
    require __DIR__ . '/../config/main.php',
    require __DIR__ . '/../config/main-local.php'
);
/*定义版本号变量*/
if(file_exists("/data/www/release_version/version_stkf")){
    define("RELEASE_VERSION",trim( trim(file_get_contents("/data/www/release_version/version_stkf")) ));
}else{
    define("RELEASE_VERSION",time());
}

(new yii\web\Application($config))->run();
