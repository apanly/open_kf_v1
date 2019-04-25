<?php
namespace common\services\sms;


use common\components\HttpClient;
use common\models\sms\SmsHistory;
use common\services\Constants;
use common\services\ListService;


class SmsService {
    public static function send($mobile, $content,$channel = '',$ip = '',$sign='',$extra_params = [] ) {
        if(!$channel) {
            $channel = 'default';
        }

        if(is_array($mobile))
            $mobile = implode(',',$mobile);
        $sms_to_send = [
            'mobile' =>$mobile,
            'content' => $content,
            'ip' => $ip,
            'channel' => $channel,
            'sign' => $sign,
            'biz_queue_id' => isset( $extra_params['biz_queue_id'] )?$extra_params['biz_queue_id']:0
        ];
        ListService::unshift( Constants::$queue_map['sms'],$sms_to_send);
        self::Log(sprintf("DO Insert Queue %s\t mobile:%s , content: %s ",date('Y-m-d H:i:s'),$mobile,$content ));
    }


    public static function doSend($mobile, $content,$channel = 'default',$ip='',$sign='',$extra_params = []  ) {

        if(!self::recent_history_check($ip)) {
            return false;
        }
        $sign = $sign ? $sign : '云客服';
        $log_mobile = $mobile;
        if(is_array($mobile)) {
            foreach($mobile as $k=>$v) {
                if(!self::_is_mobile($v)) {
                    unset($mobile[$k]);
                }
            }
        } else {
            if(!self::_is_mobile($mobile)) {
                $mobile = '';
            }
        }
        if(empty($mobile)) {
            self::Log(json_encode($log_mobile)." is not mobile,no mobile number,quit.");
            return false;
        }

        $status = 1;
        $return_msg = '提交成功';
        $taskid = 0;

		$data = [
			'userid'    =>  752,
			"account"   =>  "1067999行业",
			"password"  =>  "123456999",
		];

        if( $channel == "ad" ){
			$data = [
				'userid'    =>  753,
				"account"   =>  "106888营销",
				"password"  =>  "123456888"
			];
		}
		$data['mobile'] = is_array($mobile) ? implode(',',$mobile) : $mobile;//发信发送的目的号码.多个号码之间用半角逗号隔
		$data['content'] = strval( "【{$sign}】" .$content);
		$data['action'] =  "send";

		$ret = HttpClient::post("http://114.55.149.72:8888/sms.aspx",$data);
		$decode = simplexml_load_string ($ret);
		if($decode instanceof \SimpleXMLElement) {
			$taskid = $decode->taskID;
		}

        /***
         * 记录到数据库
         */
        $sms_word_count = mb_strlen($content."【{$sign}】",'UTF-8');
        self::addSmsHistory($mobile,$content,$channel,$ip,$status,$return_msg,$taskid,$sms_word_count,$extra_params);
        self::Log(sprintf("%s\t mobile:%s , content: %s , send by %s, result : %s",date('Y-m-d H:i:s'),json_encode($mobile),$content,$channel,$ret ));
        return true;
    }


    public static function addSmsHistory($mobile,$content,$channel = 'nbark',$ip='',$status=1,$return_msg='',$taskid=0,$chars=0,$extra_params = [] ){
        $biz_queue_id = isset( $extra_params['biz_queue_id'] )?$extra_params['biz_queue_id']:0;
        $date_now = date("Y-m-d H:i:s");
        $model_sms_history = new SmsHistory();
        $model_sms_history->mobile = $mobile;
        $model_sms_history->content = $content;
        $model_sms_history->channel = $channel;
        $model_sms_history->status = $status;
        $model_sms_history->return_msg = $return_msg;
        $model_sms_history->taskid = $taskid;
        $model_sms_history->queue_id = $biz_queue_id;
        $model_sms_history->ip = $ip;
        $model_sms_history->send_number = ceil($chars/70);
        $model_sms_history->created_time = $date_now;
        $model_sms_history->save(0);
    }

    private static function _is_mobile($mobile)
    {
        return preg_match('/1\d{10}$/',$mobile);
    }

    public static function Log($txt)
    {
        $log = \Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'sms_'.date("Y-m-d").'.log';
        file_put_contents($log, '[' . date('Y-m-d H:i:s') .']'. $txt."\n",FILE_APPEND);
    }

    private static function recent_history_check($ip){
        if($ip) {
            $time = time();
            $hash_key = sprintf("SMS:send:%s:%s",date('Hi',$time),$ip);
            \Yii::$app->list_001->incr($hash_key);
            \Yii::$app->list_001->setTimeout($hash_key,600);
            $total = 0;
            for($i=4;$i>=0;$i--)
            {
                $hash_key = sprintf("SMS:send:%s:%s",date('Hi',$time-60*$i),$ip);
                $total = $total + intval(\Yii::$app->list_001->get($hash_key));
            }
            if($total >= 60)
            {
                return false;
            }
        }
        return true;
    }
}