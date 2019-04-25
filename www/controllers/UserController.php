<?php
namespace www\controllers;

use common\components\GlobalUrlService;
use common\components\UtilHelper;
use common\models\merchant\Merchant;
use common\models\sms\SmsCaptcha;
use common\services\captcha\ValidateCode;
use common\services\MerchantService;
use www\controllers\common\BaseController;

class UserController extends BaseController {

	public function __construct($id, $module, array $config = []){
		parent::__construct($id, $module, $config);
		$this->layout = false;
	}

	public function actionLogin(){
	    if( \Yii::$app->request->isGet ){
	        if( $this->getCookie( $this->auth_merchant_cookie ) ){
	            return $this->redirect( GlobalUrlService::buildMerchantUrl("/") );
            }
            return $this->render('login');
        }
        $login_name = trim( $this->post("login_name","") );
        $login_pwd = trim( $this->post("login_pwd","") );

        if( mb_strlen($login_name,"utf-8") <= 0 ){
            return $this->renderErrorJSON([],"请输入正确的登录用户名~~");
        }

        $merchant_info = Merchant::find()->where([ 'login_name' => $login_name,'status' => 1 ])->one();
        if( !$merchant_info ){
            return $this->renderErrorJSON([],"请输入正确的用户名和密码-1~~");
        }

        if( !$merchant_info->verifyPassword($login_pwd)){
            return $this->renderErrorJSON([],"请输入正确的用户名和密码-2~~" );
        }

        $this->createMerchantLoginStatus( $merchant_info );

        return $this->renderJSON( [
            'url' => GlobalUrlService::buildWwwUrl("/merchant/default/index")
        ],"登录成功~~" );
    }

}
