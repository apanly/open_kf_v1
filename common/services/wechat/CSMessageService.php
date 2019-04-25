<?php
namespace common\services\wechat;
use common\services\BaseService;
use common\services\MerchantService;

class CSMessageService extends BaseService {
    public static function sendMsg( $appid = '',$openid,$content ){
        $wechat_config = MerchantService::getWechatConfig( $appid );
        WXRequestHelper::setConfig( $wechat_config );
        $access_token = WXRequestHelper::getAccessToken();
        $url = "/message/custom/send?access_token=".$access_token;
        $data = [
            "touser" => $openid,
            "msgtype" => "text",
            "text" =>  [
                "content" => $content
            ]
        ];
        $ret = WXRequestHelper::send( $url,json_encode( $data,JSON_UNESCAPED_UNICODE), 'POST' );
    }
}