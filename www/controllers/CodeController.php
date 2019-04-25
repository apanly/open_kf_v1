<?php
namespace www\controllers;

use common\components\DataHelper;
use common\components\GlobalUrlService;
use common\components\UtilHelper;
use common\models\merchant\Merchant;
use common\models\merchant\MerchantConfig;
use common\services\chat\ChatService;
use common\services\Constants;
use common\services\EventsDispatch;
use common\services\MerchantService;
use www\controllers\common\BaseController;

class CodeController extends BaseController {

	public function __construct($id, $module, $config = []){
		parent::__construct($id, $module, $config = []);
		$this->layout = false;
	}

    public function actionIndex(){
		header('Content-type: text/javascript');

		$iframe_url = GlobalUrlService::buildWwwUrl( "/code/chat" );

		$uuid = UtilHelper::gene_guid()."_".time();
        return $this->render("index.js",[
        	"iframe_url" => $iframe_url,
			"uuid" => md5($uuid),
            "is_pc" => UtilHelper::isPC()?"1":"0"
		]);
    }

    public function actionChat(){
		$ws_url = \Yii::$app->params['websocket'];
		$uuid = $this->get("uuid","");
		$data = json_encode( [
			"ws_url" => $ws_url,
			"uuid" => $uuid,
			"guest_avatar" => GlobalUrlService::buildWwwStaticUrl("/images/".Constants::$default_kf_avatar ),
            "kf_avatar" => GlobalUrlService::buildWwwStaticUrl("/images/".Constants::$default_kf_avatar )
		] );
		return $this->render("chat_mini",[
		    "params" => $data
        ]);
	}
}
