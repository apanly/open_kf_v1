<?php
require_once __DIR__."/yii_console.php";
use \Workerman\Worker;
use \GatewayWorker\BusinessWorker;

// bussinessWorker 进程
$busi_worker = new BusinessWorker();
// worker名称
$busi_worker->name = 'STKF_Work';
// bussinessWorker进程数量
$busi_worker->count = 4;
// 服务注册地址
$busi_worker->registerAddress = '127.0.0.1:1238';

//设置处理业务的类为MyEvent
$busi_worker->eventHandler = "BusiHandler";

$busi_worker->onWorkerStart = function(){

};

$busi_worker->onWorkerStop = function(){

};
// 设置业务超时时间10秒
$busi_worker->processTimeout = 3;
// 业务超时回调，可以把超时日志保存到自己想要的地方
$busi_worker->processTimeoutHandler = function($trace_str, $exeption) {
	//file_put_contents('/your/path/process_timeout.log', $trace_str, FILE_APPEND);
	//错误信息丢进redis，redis 通过job 获取写入数据库
	// 返回假，让进程重启，避免进程继续无限阻塞
	return false;
};

// 如果不是在根目录启动，则运行runAll方法
if( !defined('GLOBAL_START') )  {
	Worker::runAll();
}
