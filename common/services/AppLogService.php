<?php

namespace common\services;


use common\components\UtilHelper;
use common\models\log\AppErrorLogs;

class AppLogService extends BaseService {


    public static function addErrorLog($appid,$uri,$err_msg){

        $model_app_logs = new AppErrorLogs();
        $model_app_logs->app_name = $appid;
        $model_app_logs->request_uri = $uri;
        $model_app_logs->content = $err_msg;
        $model_app_logs->ip = UtilHelper::getClientIP();
        $model_app_logs->ua = isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:"";
        $model_app_logs->cookies = var_export($_COOKIE,true);
        $model_app_logs->created_time = date("Y-m-d H:i:s");
        $model_app_logs->save(0);
        return true;
    }
} 