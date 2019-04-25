<?php
namespace common\services\wechat;


use common\components\HttpClient;
use common\models\wechat\WechatAccessToken;
use common\services\BaseService;

class WXRequestHelper extends  BaseService {
    private static $url = "https://api.weixin.qq.com/cgi-bin";
    private static $wechat_config  = [];

    public static function getAccessToken( ){
        $appid = self::$wechat_config['appid'];
        $date_now = date("Y-m-d H:i:s");
        $access_token_info = WechatAccessToken::find()->where([ 'appid' => $appid ])
            ->andWhere( [ '>','expired_time' , $date_now ] )
            ->limit(1)->one();
        if( $access_token_info ){
            return $access_token_info['access_token'];
        }

        $path = '/token?grant_type=client_credential&appid='.$appid.'&secret='.self::$wechat_config['app_key'];
        $res = self::send($path);

        $res_data = json_decode($res,true);
        if(isset($res_data['errcode']) && $res_data['errcode'] != 0){
            return '';
        }
        $model_access_token = new WechatAccessToken();
        $model_access_token->access_token = $res_data['access_token'];
        $model_access_token->appid = $appid;
        $model_access_token->expired_time = date("Y-m-d H:i:s",$res_data['expires_in'] + time() - 200 );
        $model_access_token->created_time = $date_now;
        $model_access_token->save( 0 );
        return $res_data['access_token'];
    }

    public static function send($path,$data=[],$method = "GET"){
        $request_url = self::$url.$path;
        if($method == "POST"){
            $res = HttpClient::post($request_url,$data);
        }else{
            $res = HttpClient::get($request_url,[]);
        }
        return $res;
    }

    public static function setConfig( $config_info ){
        self::$wechat_config = $config_info;
    }
}