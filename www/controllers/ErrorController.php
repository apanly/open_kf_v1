<?php

namespace www\controllers;

use www\controllers\common\BaseController;
use Yii;
use yii\log\FileTarget;
use yii\web\Response;

class ErrorController extends BaseController
{
	public $enableCsrfValidation = false;

	public function actionError()
	{
		$error = Yii::$app->errorHandler->exception;

		if ($error) {
			$code = $error->getCode();
			$msg  = $error->getMessage();
			$file = $error->getFile();
			$line = $error->getLine();

			$time = microtime(true);
			$log  = new FileTarget();
			$log->logFile = Yii::$app->getRuntimePath() . '/logs/err.log';

			$err_msg = $msg . " [file: {$file}][line: {$line}][err code:$code.]" .
				"[url:{$_SERVER['REQUEST_URI']}][post:" . http_build_query($_POST) . "]";


			$log->messages[] = [
				$err_msg,
				1,
				'application',
				$time
			];
			$log->export();

		}


		$response = Yii::$app->response;
		$response->format = Response::FORMAT_JSON;
		$response->data   = [
			'msg'    => isset($msg) ? $msg : '',
			'code'   => isset($code) ? $code : -200,
			'data'   => [],
			'req_id' => uniqid()
		];

		return $response;
	}


}

