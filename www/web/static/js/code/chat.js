;
// 服务的客服标识
var kf_code = '';
// 服务的客服名称
var kf_name = '';
var kf_avatar = '';
var guest_name  ='';
var guest_avatar = "//kf.360zhishu.cn/static/images/logo_tiny.png";
// 是否已经连接过
var ws_connect_flag = false;
// Let the library know where WebSocketMain.swf is:
WEB_SOCKET_SWF_LOCATION = "WebSocketMain.swf";


var stkf_ws_service = {
    ws: null,
    connect: function (config) {
        var that = this;
        this.ws = new WebSocket(config.ws_url);
        this.ws.onopen = function (res) {
            //建立连接之后发送一个请求过去
            top.postMessage("connect", '*');
            $(".chat-footer .server_status .layui-badge").html("已连接");
        };
        this.ws.onmessage = function (res) {
            config.onMessage(res);
        };
        this.ws.onclose = function (res) {
            $(".chat-footer .server_status .layui-badge").removeClass("layui-bg-green");
            $(".chat-footer .server_status .layui-badge").html("已关闭");
        };
    },
    socketSend: function (msg) {
        this.ws.send(JSON.stringify(msg));
    }

};
var chat_box_ops = {
    showKFMessage:function( data ){
        var ele = $(".wrap_hide .kf_wrap").clone();
        ele.find(".chat-date").html(  data['date'] );
        ele.find(".chat-avatars img").attr(  "src", data.hasOwnProperty('f_avatar')?data['f_avatar']:kf_avatar );
        ele.find(".chat-message").html( data['content'] );

        $(".chat-box").append( ele );
        $(".chat-box").append( $(".wrap_hide .chat-sep").clone() );
        this.wordBottom();
    },
    showGuestMessage:function( msg ){
        var ele = $(".wrap_hide .guest_wrap").clone();
        ele.find(".chat-date").html(  moment().format("YYYY-MM-DD HH:mm:ss") );
        ele.find(".chat-avatars img").attr(  "src", guest_avatar );
        ele.find(".chat-message").html( msg );

        $(".chat-box").append( ele );
        $(".chat-box").append( $(".wrap_hide .chat-sep").clone() );
        this.wordBottom();
    },
    showSystemMessage:function (msg) {
        var ele = $(".wrap_hide .system_wrap").clone();
        ele.find(".chat-system").html( msg );
        $(".chat-box").append( ele );
    },
    // 滚动到最底端
    wordBottom:function() {
        var box = $(".chat-box");
        box.scrollTop(box[0].scrollHeight);
    },
};
var chat_ops = {
    init: function () {
        layui.use('layer');
        this.eventBind();
    },
    eventBind: function () {
        var that = this;
        this.config_params = eval( "(" + $(".wrap_hide input[name=params]").val() + ")" );
        var params = {
            ws_url: this.config_params['ws_url'],
            onMessage: function (res) {
                that.handlerMessage( res );
            }
        };

        kf_avatar = this.config_params['kf_avatar'];
        guest_avatar = this.config_params['guest_avatar'];
        stkf_ws_service.connect(params);


        $("#closeBtn").click(function () {
            top.postMessage("hide_chat", '*');
        });

        // 发送
        $(".chat-container #sendBtn").click(function () {
            if(  $(".chat-container #sendBtn").hasClass('active') ){
                that.sendMessage('');
            }
        });
    },
    handlerMessage: function (res) {
        var that = this;
        var data = eval("(" + res.data + ")");
        switch (data['cmd']) {
            // 已经被分配了客服
            case 'kf_link':
                kf_code = data.data.kf_code;
                kf_name = data.data.kf_name;
                kf_avatar = data.data.kf_avatar;
                chat_box_ops.showSystemMessage( kf_name + "非常高兴为您服务" );
                break;
            case 'rep_in':
                guest_name = "游客_" + data.data.guest_num;
                //到时候根据商家设置是否要强制打开
                if( 1 == that.config_params['auto_open'] ){
                    top.postMessage("open_chat", '*');
                }
                break;
            // 没有客服在线
            case 'no_kf':
                chat_box_ops.showKFMessage(data.data);
                break;
            case "system":
                chat_box_ops.showKFMessage(data.data);
                break;
            // 客服全忙
            case 'kf_busy':
                chat_box_ops.showSystem(data.data.msg);
                break;
            case 'kf_close_guest'://客服主动关闭服务窗口
                chat_box_ops.showKFMessage(data.data);
                var cIndex = layer.confirm('是否满意本次服务 ？', {
                    title: '服务质量',
                    icon: '6',
                    btn: [ '满意', '不满意'],
                    closeBtn:0
                }, function(){
                    that.sendCloseMessage( "满意" );
                    layer.close(cIndex);
                },function(){
                    that.sendCloseMessage( "不满意" );
                    layer.close(cIndex);
                });
                break;
            // 聊天数据
            case 'chat':
                chat_box_ops.showKFMessage(data.data);
                break;
            // 系统异常
            case 'error':
                chat_box_ops.showSystem(data.data.msg);
                break;
            case "ping":
                stkf_ws_service.socketSend({ "cmd":"pong" });
                break;
        }
    },
    sendMessage: function (inMsg) {
        var that = this;
        if ('' == inMsg) {
            var input = $("#textarea").val();
        } else {
            var input = inMsg;
        }

        chat_box_ops.showGuestMessage( input );

        $("#textarea").val('');

        stkf_ws_service.socketSend({
            cmd: 'chat',
            data: {
                f_name: guest_name,
                f_avatar: guest_avatar,
                f_code: that.config_params['uuid'],
                f_source:'guest',
                to_code: kf_code,
                to_name: kf_name,
                to_avatar: kf_avatar,
                content: input
            }
        });

        $(".chat-container #sendBtn").removeClass('active');
    },
    sendCloseMessage:function( msg ){
        var that = this;
        stkf_ws_service.socketSend({
            cmd: 'guest_close',
            data: {
                f_name: guest_name,
                f_avatar: guest_avatar,
                f_code: that.config_params['uuid'],
                f_source:'guest',
                to_code: kf_code,
                to_name: kf_name,
                to_avatar: kf_avatar,
                content: "对您的服务评价：" + msg
            }
        });
        $("#closeBtn").click();
    }
};

$(document).ready(function () {
    chat_ops.init();

    // 输入监听
    $(".chat-container #textarea").keyup(function (event) {
        var len = $(this).val().length;
        if (len == 0) {
            $(".chat-container #sendBtn").removeClass('active');
        } else if (len > 0 && !$("#sendBtn").hasClass('active')) {
            $(".chat-container #sendBtn").addClass('active');
        }
    });

    //输入enter健也可以发送
    $(document).keydown(function (event) {
        if (event.keyCode == 13) {
            $(".chat-container #sendBtn").click();
            return false;
        }
    });

    //目标网址加载完JS会调用这个方法通过iframe.contentWindow.postMessage('{}', '*');
    window.addEventListener('message', function (event) {
        var json_data =  eval('(' + event.data + ')');
        var tmp_data = {
            f_name: "访客",
            f_avatar: guest_avatar,
            f_code: chat_ops.config_params['uuid'],
            content:json_data['kf_referer'],
            domain:json_data['kf_url'],
            ua:json_data['ua']
        };
        if ('open_chat' == json_data['cmd'] ) {
            if ( !ws_connect_flag ) {
                tmp_data['f_name'] = guest_name;
                stkf_ws_service.socketSend({
                    cmd: 'guest_connect',
                    data: tmp_data
                });
                ws_connect_flag = true;
            }
        }else if( "guest_in" ==  json_data['cmd'] ){
            stkf_ws_service.socketSend({
                cmd: 'guest_in',
                data: tmp_data
            });
        }
    }, false);
});
