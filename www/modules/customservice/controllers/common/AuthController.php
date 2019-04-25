<?php

namespace www\modules\customservice\controllers\common;

use common\components\BaseCommonController;
use common\components\GlobalUrlService;
use common\models\merchant\Merchant;
use common\models\merchant\MerchantStaff;
use Yii;

class AuthController extends BaseCommonController {
    public $current_user  ;
    public $merchant_info ;
    protected  $allowAllAction = [
        "cs/user/login"
    ];

    public function __construct($id, $module, $config = []){
        parent::__construct($id, $module, $config = []);
        $view = Yii::$app->view;
        $view->params['id'] = $id;
        $this->layout = false;
    }

    public function beforeAction($action) {

        $is_login = $this->checkLoginStatus();

        if ( !$is_login &&  !in_array( $action->getUniqueId(), $this->allowAllAction ) ) {
            if (Yii::$app->request->isAjax) {
                $this->renderJSON([], "未登录,请返回用户中心", -302);
            } else {
                $this->redirect( GlobalUrlService::buildCsUrl("/user/login"));
            }
            return false;
        }

        return true;
    }

    protected function checkLoginStatus(){

        $request = Yii::$app->request;
        $cookies = $request->cookies;
        $auth_cookie = $cookies->get( $this->auth_cs_cookie );

        if(!$auth_cookie){
            return false;
        }
        list( $auth_token,$staff_id) = explode("#",$auth_cookie);

        if( !$auth_token || !$staff_id){
            return false;
        }
        if($staff_id && preg_match("/^\d+$/",$staff_id)){
            $staff_info = MerchantStaff::find()
                ->where([ 'id' => $staff_id,'status' => 1  ])
                ->one();
            if(!$staff_info){
                $this->removeAuthToken( $this->auth_cs_cookie );
                return false;
            }

            $params = [ $staff_info['id'],$staff_info['login_name'],$staff_info['login_pwd'],$staff_info['login_salt'],$staff_info['sn'] ];
            if($auth_token != $this->createAuthToken( $params )){
                $this->removeAuthToken( $this->auth_cs_cookie );
                return false;
            }
            $this->current_user = $staff_info;
            $view = Yii::$app->view;
            $view->params['current_user'] = $staff_info;
            return true;
        }
        return false;
    }

}