<?php

namespace www\modules\merchant\controllers\common;

use common\components\BaseCommonController;
use common\components\GlobalUrlService;
use common\models\merchant\Merchant;
use Yii;

class AuthController extends BaseCommonController {
    public $current_user  ;
    public $ignore_url = [];


    public function __construct($id, $module, $config = []){
        parent::__construct($id, $module, $config = []);
        $view = Yii::$app->view;
        $view->params['id'] = $id;
        $this->layout = "main";
    }

    public function beforeAction($action) {
        $is_login = $this->checkLoginStatus();

        if(!$is_login) {
            if (Yii::$app->request->isAjax) {
                $this->renderJSON([], "未登录,请返回用户中心", -302);
            } else {
                $this->redirect( GlobalUrlService::buildWwwUrl("/user/login"));
            }
            return false;
        }

        return true;
    }

    protected function checkLoginStatus(){

        $request = Yii::$app->request;
        $cookies = $request->cookies;
        $auth_cookie = $cookies->get( $this->auth_merchant_cookie );

        if(!$auth_cookie){
            return false;
        }
        list( $auth_token,$merchant_id) = explode("#",$auth_cookie);

        if( !$auth_token || !$merchant_id){
            return false;
        }
        if($merchant_id && preg_match("/^\d+$/",$merchant_id)){
            $merchant_info = Merchant::findOne([ 'id' => $merchant_id,'status' => 1 ]);
            if(!$merchant_info){
                $this->removeAuthToken();
                return false;
            }

            $params = [ $merchant_info['id'],$merchant_info['login_name'],$merchant_info['login_pwd'],$merchant_info['login_salt'],$merchant_info['sn'] ];
            if($auth_token != $this->createAuthToken( $params )){
                $this->removeAuthToken();
                return false;
            }
            $this->current_user = $merchant_info;
            $view = Yii::$app->view;
            $view->params['current_user'] = $merchant_info;
            return true;
        }
        return false;
    }

}