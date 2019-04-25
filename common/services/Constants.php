<?php
/**
 * Class Constants
 */

namespace common\services;


class Constants {
	public static $queue_map = [
		"chat" => "list_chat_message",
		"trace" => "list_trace_guest",
        "guest" => "list_guest_ops",
        "sms" => "list_sms_notices",
        "wechat" => "list_wechat_message"
	];

	public static $ignore_cmds = [ "ping","pong"  ];
	public static $chat_cmds = [ "chat" ];
	public static $wechat_cmds = [ "wechat_ask","wechat_reply" ];
	public static $guest_trace_ignore_cmds = [ "kf_connect","kf_close","guest_close" ];
	public static $guest_trace_cmds = [ "guest_in" ];

	public static $default_kf_avatar = "kf_default_avatar";
	public static $default_login_pwd = "••••••";

	public static $login_status_map = [
	    1 => "有效",
        0 => "无效"
    ];

    public static $online_status_map = [
        1 => "在线",
        0 => "下线"
    ];

    public static $kf_pop_name = "咨询客服";
}