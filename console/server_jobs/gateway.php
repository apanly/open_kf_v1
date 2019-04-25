<?php
//https://blog.csdn.net/thy38/article/details/54090242 参考文章
require_once __DIR__."/yii_console.php";

use \GatewayWorker\Gateway;
use \Workerman\Worker;

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
$gateway->startPort = 4000;
// 服务注册地址
$gateway->registerAddress = '127.0.0.1:1238';

//心跳间隔
$gateway->pingInterval = 15;
//客户端连续$pingNotResponseLimit次$pingInterval时间内不回应心跳则断开链接
$gateway->pingNotResponseLimit = 2;
//心跳数据
$gateway->pingData = '{"cmd":"ping"}';

//$merchant_info = \common\models\merchant\Merchant::find()->where([ 'id' => 1 ])->asArray()->one();
//var_export( $merchant_info );

//http://doc3.workerman.net/640187  透过nginx/apache代理如何获取客户端真实ip ?
$gateway->onConnect = function($connection) {
    $connection->onWebSocketConnect = function($connection , $http_header)  {
        if( isset( $_SERVER['HTTP_X_REAL_IP'] ) ){
            $_SESSION['REMOTE_IP'] = $_SERVER['HTTP_X_REAL_IP'];
        }
    };
};

// 如果不是在根目录启动，则运行runAll方法
if( !defined('GLOBAL_START') )  {
	Worker::runAll();
}


