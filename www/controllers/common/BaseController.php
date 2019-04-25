<?php
namespace www\controllers\common;

use common\components\BaseCommonController;
use Yii;

class BaseController extends BaseCommonController {

    protected $allowAllAction = []; //在这里面的就不用检查合法性


    public function __construct($id, $module, $config = []){
        parent::__construct($id, $module, $config = []);
        $view = Yii::$app->view;
        $view->params['id'] = $id;
    }

    public function beforeAction($action){
        return true;
    }


	protected  function renderJS($msg,$url = "/"){
		return $this->renderPartial("@www/views/layouts/js",['msg' => $msg,'location' => $url ]);
	}

    protected function geneReqId(){
        return uniqid();
    }

    public function post($key, $default = ""){
        return Yii::$app->request->post($key, $default);
    }


    public function get($key, $default = ""){
        return Yii::$app->request->get($key, $default);
    }

}


