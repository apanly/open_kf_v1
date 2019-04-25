<?php
/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */

//declare(ticks=1);
use \common\services\EventsDispatch;
use \common\services\GuestDistribution;
/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */


class BusiHandler{

    public static function onWorkerStart(  $worker ){

    }
	/**
	 * 当客户端连接时触发
	 * 如果业务不需此回调可以删除onConnect
	 * @param int $client_id 连接id
	 */
	public static function onConnect( $client_id ){
	}

	/**
	 * 当客户端发来消息时触发
	 * @param int $client_id 连接id
	 * @param mixed $message 具体消息
	 */
	public static function onMessage($client_id, $message){
		// 向所有人发送
		$message = json_decode($message, true);
		if( isset( $_SESSION['REMOTE_IP'] ) && isset( $_SERVER['REMOTE_ADDR'] ) ){
            $_SERVER['REMOTE_ADDR'] = $_SESSION['REMOTE_IP'];
        }
		$message = $message + $_SERVER;
		switch ($message['cmd']) {
			case "guest_in"://客户进来到页面
                EventsDispatch::guestIn( $client_id,$message );
                break;
			case "guest_connect"://客户链接,要分配客服
				EventsDispatch::guestConnect( $client_id,$message );
				break;
			case "guest_close":
				EventsDispatch::guestClose( $client_id,$message );
				break;
            case "kf_close_guest":
                EventsDispatch::kfCloseGuest( $client_id,$message );
                break;
			case "kf_connect"://客服上线了
				EventsDispatch::kfConnect( $client_id,$message );
				break;
			case "kf_close":
				EventsDispatch::kfClose( $client_id,$message );
				break;
			case "chat"://聊天
				EventsDispatch::chatMessage( $client_id,$message );
				break;
			case "pong":
				EventsDispatch::addChatHistory( $client_id,$message );
				break;
			case "ping":
				EventsDispatch::addChatHistory( $client_id,$message );
				break;
		}
	}

	/**
	 * 当用户断开连接时触发
	 * @param int $client_id 连接id
	 */
	public static function onClose($client_id){
        $data = [
            "cmd" => "guest_close",
            "data" => [
                "f_code" =>  $_SESSION['uid']
            ]
        ];

        if( isset( $_SESSION['REMOTE_IP'] ) && isset( $_SERVER['REMOTE_ADDR'] ) ){
            $_SERVER['REMOTE_ADDR'] = $_SESSION['REMOTE_IP'];
        }

        EventsDispatch::addChatHistory( $client_id,$data + $_SERVER );
        GuestDistribution::guestClose( $client_id,$data );
	}
}