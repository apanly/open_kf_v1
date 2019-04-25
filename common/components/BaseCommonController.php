<?php

namespace common\components;

use Yii;

class BaseCommonController extends \yii\web\Controller{

    public $enableCsrfValidation = false;
    protected  $auth_merchant_cookie = "sass_kf_merchant";
    protected  $auth_cs_cookie = "sass_kf_cs";
    protected  $salt = "usPkIqUBR5pdddsTY2";
    public $page_size = 30;

    protected  function createMerchantLoginStatus( $info ){
        $params = [ $info['id'],$info['login_name'],$info['login_pwd'],$info['login_salt'],$info['sn'] ];
        $auth_token = $this->createAuthToken(  $params );
        $this->setCookie( $this->auth_merchant_cookie,$auth_token."#".$info['id']);
    }

    protected  function createCSLoginStatus( $info ){
        $params = [ $info['id'],$info['login_name'],$info['login_pwd'],$info['login_salt'],$info['sn'] ];
        $auth_token = $this->createAuthToken(  $params );
        $this->setCookie( $this->auth_cs_cookie,$auth_token."#".$info['id']);
    }

    protected function createAuthToken( array $info ){
        return md5($this->salt."-".implode("-",$info ) );
    }

    protected  function removeAuthToken( $cookie_name = "" ){
        if( empty($cookie_name) ){
            $cookie_name = $this->auth_merchant_cookie;
        }
        $this->removeCookie( $cookie_name );
    }

    protected function setCookie($name,$value,$expire = 0){
        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => $name,
            'value' => $value,
			'expire' => $expire
        ]));
    }

    protected  function getCookie($name,$default_val=''){
        $cookies = Yii::$app->request->cookies;
        return $cookies->getValue($name, $default_val);
    }


    protected function removeCookie($name){
        $cookies = Yii::$app->response->cookies;
        $cookies->remove($name);
    }


    protected  function renderJS($msg,$url = "/"){
        return $this->renderPartial("@www/views/layouts/js",['msg' => $msg,'location' => $url ]);
    }

    protected function renderJSON($data=[], $msg ="操作成功~~", $code = 200){

        $response = Yii::$app->response;
        $data = [
            "code" => $code,
            "msg"   =>  $msg,
            "data"  =>  $data,
            "req_id" =>  $this->geneReqId(),
        ];
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data= $data;
        return $response;
    }

    protected function renderErrorJSON($data = [], $msg = "操作失败~~", $code = -1){
        return $this->renderJSON($data,$msg,$code);
    }

    protected function renderJSONP($data=[], $msg ="ok", $code = 200) {

        $func = $this->get("jsonp","jsonp_func");


        echo $func."(".json_encode([
                "code" => $code,
                "msg"   =>  $msg,
                "data"  =>  $data,
                "req_id" =>  $this->geneReqId(),
            ]).")";


        return Yii::$app->end();
    }

    protected function renderNotFound() {
        $this->renderJSON([],$msg = "ObjectNotFound", -1);
    }


    protected function geneReqId() {
        return uniqid();
    }

    public function post($key, $default = "") {
        return Yii::$app->request->post($key, $default);
    }


    public function get($key, $default = "") {
        return Yii::$app->request->get($key, $default);
    }
} 