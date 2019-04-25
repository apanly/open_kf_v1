<?php
namespace common\services\lvb;
use common\services\BaseService;

class LVBTecentService extends  BaseService {
    /**
     * 获取推流地址
     * 如果不传key和过期时间，将返回不含防盗链的url
     * @param domain 您的推流域名
     *        streamId 您用来区别不同推流地址的唯一流ID
     *        key 安全密钥
     *        time 过期时间 sample 2016-11-12 12:00:00
     * @return String url */

    public static function getPushUrl($domain, $stream_id, $key = null, $time = null){
        if($key && $time){
            $tx_time = strtoupper( base_convert(strtotime($time),10,16));
            $tx_secret = md5($key.$stream_id.$tx_time);
            $ext_str = "?".http_build_query([
                    "txSecret"=> $tx_secret,
                    "txTime"=> $tx_time
                ]);
        }
        return "rtmp://".$domain."/live/".$stream_id.( isset($ext_str) ? $ext_str : "");
    }



    /**
     * 获取播放地址
     * @param domain 您的播放域名
     *        streamId 您用来区别不同推流地址的唯一流ID
     * @return String url */

    public static function getPlayUrl($domain, $stream_id){
        $data = [
            "rtmp://".$domain."/live/".$stream_id,
            "http://".$domain."/live/".$stream_id.".flv",
            "http://".$domain."/live/".$stream_id.".m3u8"
        ];
        return $data[1];
    }
}