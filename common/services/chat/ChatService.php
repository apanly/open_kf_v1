<?php
namespace common\services\chat;

use apanly\BrowserDetector\Browser;
use apanly\BrowserDetector\Device;
use apanly\BrowserDetector\Os;
use common\components\UtilHelper;
use common\models\ChatHistory;
use common\models\GuestTrace;
use common\services\BaseService;
use common\services\Constants;

class ChatService extends BaseService {
	public static function addHistory( $data ){
		$cmd = isset( $data['cmd'] )?$data['cmd']:'';
		$f_data = isset( $data['data'] )?$data['data']:[];
		if( !$f_data ){
			return true;
		}
		if( !in_array( $cmd,Constants::$chat_cmds  )){
			return true;
		}

		$tmp_source = 0;
		if( isset( $f_data['f_source'] ) ){
		    if( $f_data['f_source'] == "guest" ){
                $tmp_source = 1;
            }elseif ( $f_data['f_source'] == "kefu" ){
                $tmp_source = 2;
            }elseif ( $f_data['f_source'] == "system" ){
                $tmp_source = 3;
            }
        }
		$model_chat_history = new ChatHistory();
		$model_chat_history->cmd = $cmd;
		$model_chat_history->f_name = isset( $f_data['f_name'] )?$f_data['f_name']:'';
		$model_chat_history->f_avatar = isset( $f_data['f_avatar'] )?$f_data['f_avatar']:'';
		$model_chat_history->f_code = isset( $f_data['f_code'] )?$f_data['f_code']:'';
		$model_chat_history->content = isset( $f_data['content'] )?$f_data['content']:'';
		$model_chat_history->to_name = isset( $f_data['to_name'] )?$f_data['to_name']:'';
		$model_chat_history->to_code = isset( $f_data['to_code'] )?$f_data['to_code']:'';
		$model_chat_history->to_avatar = isset( $f_data['to_avatar'] )?$f_data['to_avatar']:'';
        $model_chat_history->source = $tmp_source;
		$model_chat_history->save( 0 );
		return true;
	}

	public static function addTrace( $data ){
		$cmd = isset( $data['cmd'] )?$data['cmd']:'';
		$f_data = isset( $data['data'] )?$data['data']:[];
		if( !$f_data ){
			return true;
		}
        if( in_array( $cmd , Constants::$guest_trace_ignore_cmds + Constants::$ignore_cmds ) ){
            return false;
        }

		$model_guest_trace = new GuestTrace();
		$model_guest_trace->cmd = $cmd;

		$model_guest_trace->f_clientid = isset( $f_data['client_id'] )?$f_data['client_id']:'';
		$model_guest_trace->f_code = isset( $f_data['f_code'] )?$f_data['f_code']:'';
		$model_guest_trace->ua = isset( $f_data['ua'] )?$f_data['ua']:'';
		$model_guest_trace->ip = isset( $data['REMOTE_ADDR'] )?$data['REMOTE_ADDR']:'';
		$model_guest_trace->referer = isset( $f_data['content'] )?$f_data['content']:'';
		$model_guest_trace->talk_url = isset( $f_data['domain'] )?$f_data['domain']:'';
		//增加几个来源统计
        $tmp_source = 'direct';
        if( $model_guest_trace->referer ){
            $tmp_source = parse_url( $model_guest_trace->referer ,PHP_URL_HOST );
            if( stripos($tmp_source,"www.google.") !== false ){
                $tmp_source = "www.google.com";
            }
        }
        $model_guest_trace->source = $tmp_source;
        if( $model_guest_trace->ua ){
            $tmp_browser = new Browser( $model_guest_trace->ua );
            $tmp_os = new Os( $model_guest_trace->ua );
            $tmp_device = new Device( $model_guest_trace->ua );

            $model_guest_trace->client_browser = $tmp_browser->getName()?$tmp_browser->getName():'';
            $model_guest_trace->client_browser_version = $tmp_browser->getVersion()?$tmp_browser->getVersion():'';
            $model_guest_trace->client_os = $tmp_os->getName()?$tmp_os->getName():'';
            $model_guest_trace->client_os_version = $tmp_os->getVersion()?$tmp_os->getVersion():'';
            $model_guest_trace->client_device = $tmp_device->getName()?$tmp_device->getName():'';
            if( $model_guest_trace->client_device == "unknown" && UtilHelper::isPC() ){
                $model_guest_trace->client_device = "pc";
            }
        }
		$model_guest_trace->save( 0 );
		return true;
	}

}