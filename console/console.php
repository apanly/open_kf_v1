<?php
//https://blog.csdn.net/thy38/article/details/54090242 参考文章
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

use \GatewayWorker\Gateway;
use \Workerman\Worker;


$current_dir = __DIR__;
$root_path = realpath( __DIR__."/../" );

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


// gateway 进程，这里使用Text协议，可以用telnet测试
$gateway = new Gateway("Websocket://0.0.0.0:8282");
// gateway名称，status方便查看
$gateway->name = 'STKF_GateWay';
// gateway进程数
$gateway->count = 4;
// 本机ip，分布式部署时使用内网ip
$gateway->lanIp = '127.0.0.1';
// 内部通讯起始端口，假如$gateway->count=4，起始端口为4000
// 则一般会使用4000 4001 4002 4003 4个端口作为内部通讯端口
$gateway->startPort = 2900;
// 服务注册地址
$gateway->registerAddress = '127.0.0.1:1238';

$merchant_info = \common\models\merchant\Merchant::find()->where([ 'id' => 1 ])->asArray()->one();
var_export( $merchant_info );
Worker::runAll();


