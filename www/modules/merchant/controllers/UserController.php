<?php

namespace www\modules\merchant\controllers;
use common\components\GlobalUrlService;
use www\modules\merchant\controllers\common\AuthController;

class UserController extends AuthController{

    public function actionLogout(){
        $this->removeAuthToken( $this->auth_merchant_cookie );
        return $this->redirect( GlobalUrlService::buildWwwUrl("/") );
    }
}
