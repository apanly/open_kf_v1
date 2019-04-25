<?php

namespace www\modules\customservice\controllers;

use common\components\GlobalUrlService;
use common\models\ChatHistory;
use common\models\guest\GuestServicing;
use www\modules\customservice\controllers\common\AuthController;


class DefaultController extends AuthController {
    public function actionIndex(){
        $info = [
            "id" => $this->current_user['id'],
            "sn" => $this->current_user['sn'],
            "nickname" => $this->current_user['nickname'],
            "avatar" =>  $this->current_user['avatar'] ,
            "online_status" =>  $this->current_user['online_status'] ,
            "avatar_url" => GlobalUrlService::buildWwwStaticUrl("/images/".$this->current_user['avatar'] )
        ];

        return $this->render('index',[
            "info" => $info,
            "ws" => \Yii::$app->params['websocket']
        ]);
    }

    public function actionGetServicing(){
        $servicing_list = GuestServicing::find()->where([ "kf_code" => $this->current_user['sn'] ])->orderBy([ "id" => SORT_DESC ])->all();
        $data = [];
        if( $servicing_list ){
            foreach( $servicing_list as $_item ){
                $data[] = [
                    "f_code" => $_item['guest_code'],
                    "f_name" => $_item['guest_name'],
                    "f_avatar" => $_item['guest_avatar'],
                    "f_ip" => $_item['guest_ip'],
                    "date" => $_item['created_time'],
                    "content" => ""
                ];
            }
        }
        return $this->renderJSON( $data );
    }

    public function actionChatLog(){
        $guest_code = trim( $this->get("guest_code","") );
        $list = ChatHistory::find()
            ->andWhere([ 'OR',[ "f_code" => $guest_code ],[ "to_code" => $guest_code ] ])
            ->orderBy([ "id" => SORT_DESC ])->limit( 10 )->all();
        $data = [];
        if( $list ){
            foreach( $list as $_item ){
                $data[] = [
                    "f_name" => $_item['f_name'],
                    "f_code" => $_item['f_code'],
                    "f_avatar" => $_item['f_avatar'],
                    "to_name" => $_item['to_name'],
                    "to_code" => $_item['to_code'],
                    "to_avatar" => $_item['to_avatar'],
                    "content" => $_item['content'],
                    "date" => $_item['created_time'],
                    "f_source" => $_item['source']
                ];
            }
        }

        return $this->renderJSON( array_reverse( $data ) );
    }
}
