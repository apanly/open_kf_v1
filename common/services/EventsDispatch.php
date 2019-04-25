<?php

namespace common\services;

use common\services\chat\ChatService;
use GatewayWorker\Lib\Gateway;

class EventsDispatch{

    public static function guestIn( $client_id,$message ){
        self::addChatHistory( $client_id,$message );
        $data = isset( $message['data'] )?$message['data']:[];
        if( !$data  ){
            Gateway::closeClient($client_id);
            return;
        }

        if( !GuestDistribution::guestIn( $client_id,$message ) ){
            $err_data = [
                "cmd" => "error",
                "data" => [
                    "content" => "请重新刷新页面进行客服沟通~~"
                ]
            ];
            Gateway::sendToClient( $client_id, json_encode( $err_data ) );
            return ;
        }
        //将系统生成的$client_id 和  用户uuid绑定起来
        Gateway::bindUid(  $client_id ,$data['f_code'] );
        //getUidByClientId 由于目前么有这个方法，我们自己用$_SESSION 来存储
        $_SESSION['uid'] = $data['f_code'];

        //给游客一个编号，一天有效。
        $guest_num = MerchantService::getGuestNumer($data['f_code'] );

        $rep_guest_in = [
            "cmd" => "rep_in",
            "data" => [
                "guest_num" => $guest_num
            ]
        ];
        Gateway::sendToClient( $client_id, json_encode( $rep_guest_in ) );
    }
	/**
	 * 访客初始化
	 * @param $message
	 * @param $client_id
	 */
	public static function guestConnect($client_id,$message){
		//写入客户表，表示来了一个客户
		self::addChatHistory( $client_id,$message );

		//尝试分配一个客服
		$kf_info = GuestDistribution::customerDistribution( $client_id,$message );
		if( $kf_info['code'] != 200 ){
            Gateway::sendToClient($client_id, json_encode([
                'cmd' => $kf_info['cmd'],
                'data' => [
                    'content' => $kf_info['msg'],
                    'date' => date("Y-m-d H:i:s")
                ]
            ]));
            return;
        }

        //发给游客 安排了 客服
        Gateway::sendToClient($client_id, json_encode([
            'cmd' => "kf_link",
            'data' => $kf_info['data']
        ]));

        //发给客服 准备接客啦
		$kf_code = $kf_info['data']['kf_code'];
        $kf_clients = Gateway::getClientIdByUid( $kf_code );
        $kf_client_id = $kf_clients?$kf_clients[0]:'';
        if( $kf_client_id ){
            Gateway::sendToClient( $kf_client_id , json_encode([
                'cmd' => "guest_link",
                'data' => [
                    "msg" => "有客户来了，接活了~~"
                ]
            ]));
        }

        //更新相关表，例如guest，guest_queue
        $queue_data = $message + [ "client_id" => $client_id ] ;
        $queue_data['cmd'] = "kf_link";
        $queue_data['data']['to_code'] = $kf_info['data']['kf_code'];
        $queue_data['data']['to_name'] = $kf_info['data']['kf_name'];
        $queue_data['data']['to_avatar'] = $kf_info['data']['kf_avatar'];

        GuestDistribution::guestKfLink( $queue_data );

        return;
	}

	public static function guestClose($client_id,$message){
		//self::addChatHistory( $client_id,$message );
		Gateway::closeClient( $client_id );
		//要给客服发评价
        self::chatMessage( $client_id ,$message );
	}

    public static function kfCloseGuest($client_id,$message){
	    //如果通过code还可以找到游客还在线就发给他
        if( isset( $message['data']['to_code'] ) ) {
            $clients = Gateway::getClientIdByUid($message['data']['to_code']);
            if( $clients ){
                self::chatMessage( $client_id ,$message );
                return;
            }
        }
        //模拟游客关闭
        self::simGuestClose( $message );
    }

    //模拟游客关闭
    public static function simGuestClose( $message ){
	    $client_id = null;
        $chat_msg = $message;
        $chat_msg['cmd'] = "sim_guest_close";
        $chat_msg['data']['f_code'] = $message['data']['to_code'];
        $chat_msg['data']['f_name'] = $message['data']['to_name'];
        $chat_msg['data']['f_avatar'] = $message['data']['to_avatar'];
        $chat_msg['data']['to_code'] = $message['data']['f_code'];
        $chat_msg['data']['to_name'] = $message['data']['f_name'];
        $chat_msg['data']['to_avatar'] = $message['data']['f_avatar'];
        $chat_msg['data']['content'] = "游客已断线，强制关闭";
        //处理收尾工作
        GuestDistribution::guestClose( $client_id,$chat_msg );
        //记录聊天历史中
        self::chatMessage( $client_id ,$chat_msg );
    }


	public static function kfConnect($client_id,$message){
		self::addChatHistory( $client_id,$message );
		$data = isset( $message['data'] )?$message['data']:[];
		//写入客户表，表示来了一个客户
		//将客服登录系统的sn 和 系统生成的$client_id 绑定
		Gateway::bindUid(  $client_id ,$data['f_code'] );
		$_SESSION['uid'] = $data['f_code'];
	}

	public static function kfClose($client_id,$message){
		self::addChatHistory( $client_id,$message );
		Gateway::closeClient( $client_id );
	}
	/**
	 * 聊天事件
	 * @param $message
	 */
	public static function chatMessage( $client_id,$message ){

		//转发给对应的客服或者游客
        if( isset( $message['data'] ) &&  isset( $message['data']['to_code'] ) ){
            $clients = Gateway::getClientIdByUid( $message['data']['to_code'] );
            $client_id = $clients?$clients[0]:'';
            if( $client_id ){

                if( isset( $message['data']['f_source'] ) &&  $message['data']['f_source'] == "guest" ){
                    $message['data']['f_ip'] = isset( $message['REMOTE_ADDR'] )?$message['REMOTE_ADDR']:'';
                }

                $chat_msg = $message;
                $chat_msg['data']['date'] = date("Y-m-d H:i:s");

                unset( $chat_msg['REMOTE_ADDR']);
                unset( $chat_msg['REMOTE_PORT']);
                unset( $chat_msg['GATEWAY_ADDR']);
                unset( $chat_msg['GATEWAY_PORT']);
                unset( $chat_msg['GATEWAY_CLIENT_ID']);
                Gateway::sendToClient( $client_id, json_encode($chat_msg) );
            }
        }else{
            $chat_msg = $message;
            $chat_msg['data']['date'] = date("Y-m-d H:i:s");
            $chat_msg['data']['f_code'] = '';
            $chat_msg['data']['f_avatar'] = '';
            $chat_msg['data']['f_name'] = '';
            $chat_msg['data']['to_code'] = $message['data']['f_code'];
            $chat_msg['data']['to_avatar'] = $message['data']['f_avatar'];
            $chat_msg['data']['to_name'] = $message['data']['f_name'];
            $chat_msg['data']['content'] = "留言成功，我们会尽快联系您的~~";
            unset( $chat_msg['REMOTE_ADDR']);
            unset( $chat_msg['REMOTE_PORT']);
            unset( $chat_msg['GATEWAY_ADDR']);
            unset( $chat_msg['GATEWAY_PORT']);
            unset( $chat_msg['GATEWAY_CLIENT_ID']);
            //回复留言，如果是来源小程序或者微信消息，那么就不能回复，因为此次的client_id = f_code
            $reply_flag = !( isset( $message['data']['f_name'] ) && mb_stripos( $message['data']['f_name'],"微信" ) !== false );
            if( $reply_flag ){
                Gateway::sendToClient( $client_id, json_encode($chat_msg) );
            }
        }

        //写入队列，队列慢慢入库
        self::addChatHistory( $client_id,$message );
	}

	public static function addChatHistory( $client_id,$message ){
		echo "client_id:{$client_id},message:".json_encode( $message )."\r\n";
		if( in_array( $message['cmd'],[ "ping","pong" ] ) ){
			return true;
		}

		if( in_array( $message['cmd'] ,Constants::$chat_cmds ) ){
            ChatService::addHistory( $message );
        }

        if( in_array( $message['cmd'] , Constants::$guest_trace_cmds ) ){
            ChatService::addTrace( $message + [ "client_id" => $client_id ] );
        }

        return true;
	}
}