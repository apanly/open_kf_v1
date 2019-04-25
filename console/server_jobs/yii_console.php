<?php
//https://blog.csdn.net/thy38/article/details/54090242 参考文章
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

$current_dir = __DIR__;
$root_path = realpath( __DIR__."/../../" );

require $root_path . '/vendor/autoload.php';
require $root_path . '/vendor/yiisoft/yii2/Yii.php';
require $root_path . '/common/config/bootstrap.php';
require $root_path . '/console/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
	require $root_path . '/common/config/main.php',
	require $root_path . '/common/config/main-local.php',
	require $root_path . '/console/config/main.php',
	require $root_path . '/console/config/main-local.php'
);

$application = new yii\console\Application($config);
//$exitCode = $application->run();
//exit($exitCode);
$application->init();
