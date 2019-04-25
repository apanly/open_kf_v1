<?php
namespace www\controllers;

use www\controllers\common\BaseController;

class IndexController extends BaseController {

    public function actionIndex(){
        return $this->render('index');
    }
}
