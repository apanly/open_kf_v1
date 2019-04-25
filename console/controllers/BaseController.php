<?php
namespace console\controllers;


class BaseController extends  \yii\console\Controller {

    public function echoLog($msg){
        echo date("Y-m-d H:i:s")." ".$msg."\r\n";
        return true;
    }
} 