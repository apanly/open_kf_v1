<?php

namespace www\modules\customservice\controllers;

use common\components\GlobalUrlService;
use common\models\merchant\MerchantStaff;
use www\modules\customservice\controllers\common\AuthController;

class UserController extends AuthController {
    public function actionLogin(){
        if( \Yii::$app->request->isGet ){
            if( $this->checkLoginStatus() ){
                return $this->redirect( GlobalUrlService::buildCsUrl( $this->merchant_info['sn'],"/default/index" ) );
            }
            return $this->render('login');
        }

        $login_name = trim( $this->post("login_name","") );
        $login_pwd = trim( $this->post("login_pwd","") );

        if( mb_strlen($login_name,"utf-8") <= 0 ){
            return $this->renderErrorJSON([],"请输入正确的登录用户名~~");
        }

        $staff_info = MerchantStaff::find()->where([
            'login_name' => $login_name,'status' => 1
        ])->one();
        if( !$staff_info ){
            return $this->renderErrorJSON([],"请输入正确的用户名和密码-1~~");
        }

        if( !$staff_info->verifyPassword($login_pwd)){
            return $this->renderErrorJSON([],"请输入正确的用户名和密码-2~~" );
        }

        $this->createCSLoginStatus( $staff_info );
        return $this->renderJSON( [
            'url' => GlobalUrlService::buildCsUrl("/default/index")
        ],"登录成功~~" );

    }

    public function actionSetStatus(){
        $status = $this->post("status","onwork");
        $this->setOnlineStatus( $this->current_user, ( $status == "onwork")?true:false );
        return $this->renderJSON();
    }

    public function actionLogout(){
        $this->setOnlineStatus( $this->current_user,false );
        $this->removeAuthToken( $this->auth_cs_cookie );
        return $this->redirect( GlobalUrlService::buildCsUrl($this->merchant_info['sn'],"/user/login") );
    }

    private function setOnlineStatus( $info,$online_flag = true ){
        if( $online_flag ){
            $info->online_status = 1;
        }else{
            $info->online_status = 0;
        }
        $info->last_active_time = date("Y-m-d H:i:s");
        $info->save( 0 );
    }
}
