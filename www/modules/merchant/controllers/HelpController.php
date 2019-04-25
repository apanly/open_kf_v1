<?php

namespace www\modules\merchant\controllers;

use common\components\GlobalUrlService;
use www\modules\merchant\controllers\common\AuthController;

/**
 * Default controller for the `merchant` module
 */
class HelpController extends AuthController{

    public function actionIndex(){
        $merchant_sn = $this->current_user['sn'];
        $url = GlobalUrlService::buildWwwUrl("/code/index");
        $url_cs = GlobalUrlService::buildCsUrl("/default/index" );
        $url = str_replace("https:","",$url);
        $url = str_replace("http:","",$url);
        return $this->render('index',[ "url" => $url,"url_cs" => $url_cs ]);
    }

    public function actionCs(){
        $url_cs = GlobalUrlService::buildCsUrl("/default/index" );
        return $this->redirect( $url_cs );
    }
}
