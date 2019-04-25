<?php

namespace common\services;


use common\components\GlobalUrlService;
use common\models\guest\Guest;
use common\models\guest\GuestQueue;
use common\models\guest\GuestServiceLog;
use common\models\guest\GuestServicing;
use common\models\merchant\MerchantStaff;

class GuestDistribution extends  BaseService {

    /**
     * 用户上线后触发分配客服
     * @param $param
     * @return array
     */
    public static function customerDistribution($client_id, $message){
        // 随便找个客服给分配上去
        $staff_list = MerchantStaff::find()
            ->where([ "online_status" => 1] )
            ->asArray()->all();
        if( !$staff_list ){
            return [
                "code" => 201,
                "msg" => "暂无客服在线，请稍后再联系~~" ,
                "cmd" => "no_kf"
            ];
        }

        $staff_info = $staff_list[ array_rand( $staff_list ) ];
        $data = [
            "code" => 200,
            "data" => [
                "kf_code" => $staff_info['sn'],
                "kf_name" => $staff_info['nickname'],
                "kf_avatar" => GlobalUrlService::buildWwwStaticUrl( "/images/".$staff_info['avatar'] )
            ]
        ];
        return $data;
    }

    public static function guestIn($client_id, $message){
        $data = isset( $message['data'] )?$message['data']:[];
        $f_code = $data['f_code'];
        $connection =  GuestQueue::getDb();
        $transaction = $connection->beginTransaction();
        try {
            $guest_queue_info = GuestQueue::findOne([ 'f_code' => $f_code]);
            if ($guest_queue_info) {
                $model_guest_queue = $guest_queue_info;
            } else {
                $model_guest_queue = new GuestQueue();
                $model_guest_queue->f_name = $data['f_name'];
                $model_guest_queue->f_avatar = $data['f_avatar'];
                $model_guest_queue->f_code = $data['f_code'];
            }
            $model_guest_queue->f_clientid = $client_id;
            $flag = $model_guest_queue->save(0);
            if( !$flag ){
                throw new \Exception("保存游客失败~~");
            }

            $guest_info = Guest::findOne( [ 'f_code' => $f_code] );
            if( $guest_info ){
                $model_guest = $guest_info;
            }else{
                $model_guest = new Guest();
                $model_guest->f_name = $data['f_name'];
                $model_guest->f_avatar = $data['f_avatar'];
                $model_guest->f_code = $data['f_code'];
            }
            $model_guest->online_status = 1;
            $model_guest->f_clientid = $client_id;
            $model_guest->save(0);

            $transaction->commit();

            return true;
        }catch (\Exception $exception) {
            $except_data = [
                "code" => $exception->getCode(),
                "msg" => $exception->getMessage(),
                "line" => $exception->getLine(),
                "file" => $exception->getFile()
            ];
            $transaction->rollBack();
            return false;
        }
    }

    public static function guestClose( $client_id,$message ){
        $data = isset( $message['data'] )?$message['data']:[];
        if( $client_id ){
            GuestQueue::deleteAll(['f_clientid' => $client_id ]);
        }
        Guest::updateAll( [ "online_status" => 0 ],[ "f_code" => $data['f_code'] ] );
        $guest_servicing_info = GuestServicing::findOne([ "guest_code" =>  $data['f_code'] ]);
        if( $guest_servicing_info ){
            $guest_servicing_info->delete();
            GuestServiceLog::updateAll([ 'end_time' => date("Y-m-d H:i:s") ],[ "id" => $guest_servicing_info['service_log_id']  ]);
        }
    }

    public static function guestKfLink( $message ){
        $data = isset( $message['data'] )?$message['data']:[];
        $connection =  GuestQueue::getDb();
        $transaction = $connection->beginTransaction();
        try {
            GuestQueue::deleteAll([ "f_code" => $data["f_code"]  ]);
            Guest::updateAll([ "kf_code" => $data['to_code'] ],[ "f_code" => $data["f_code"] ] );
            //生产正在服务的客户
            $model_service_log = new GuestServiceLog();
            $model_service_log->guest_code = $data["f_code"];
            $model_service_log->guest_name = $data["f_name"];
            $model_service_log->guest_avatar = $data["f_avatar"];
            $model_service_log->guest_client_id = $message["client_id"];
            $model_service_log->guest_ip = $message["REMOTE_ADDR"];
            $model_service_log->kf_code = $data['to_code'];
            $model_service_log->begin_time = date("Y-m-d H:i:s");
            $model_service_log->save( 0 );

            $has_service = GuestServicing::findOne([ "guest_code" => $data["f_code"] ]);
            if( !$has_service ){
                $model_servicing = new GuestServicing();
                $model_servicing->guest_code = $data["f_code"];
                $model_servicing->guest_name = $data["f_name"];
                $model_servicing->guest_avatar = $data["f_avatar"];
                $model_servicing->guest_ip = $message["REMOTE_ADDR"];
                $model_servicing->guest_client_id = $message["client_id"];
                $model_servicing->kf_code = $data['to_code'];
                $model_servicing->service_log_id = $model_service_log->id;
                $model_servicing->save( 0 );
            }
            $transaction->commit();
        }catch (\Exception $exception){
            $except_data = [
                "code" => $exception->getCode(),
                "msg" => $exception->getMessage(),
                "line" => $exception->getLine(),
                "file" => $exception->getFile()
            ];
            $transaction->rollBack();
        }
    }
}