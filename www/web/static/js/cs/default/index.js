;
// Let the library know where WebSocketMain.swf is:
WEB_SOCKET_SWF_LOCATION = "WebSocketMain.swf";

var stkf_ws_service = {
    ws: null,
    connect: function (config) {
        this.ws = new WebSocket(config.ws_url);
        this.ws.onopen = function (res) {
            console.log('stkf_kf 已建立连接');
            $(".service-header .service-status .layui-badge").addClass("layui-bg-green");
            $(".service-header .service-status .layui-badge").html("已连接");
            cs_index_ops.kfConnect();
        };
        this.ws.onmessage = function (res) {
            config.onMessage(res);
        };
        this.ws.onclose = function (res) {
            $(".service-header .service-status .layui-badge").removeClass("layui-bg-green");
            $(".service-header .service-status .layui-badge").html("已关闭");
            console.log('stkf_kf 已关闭');
        };
    },
    socketSend: function (msg) {
        this.ws.send(JSON.stringify(msg));
    }

};

var chat_box_ops = {
    geneLogMessage:function( guest_code,chat_log_list ){
        var html_ = '';
        var sep_ele  = $(".hide_wrap .chat-sep").clone();
        for( idx in chat_log_list ){
            var f_data = chat_log_list[ idx ];
            if( f_data['f_source'] == 1 ){
                var tmp_guest_ele = $(".hide_wrap .guest_wrap").clone();
                tmp_guest_ele.find(".author-name").html( f_data['date'] );
                tmp_guest_ele.find(".chat-message").html( f_data['content'] );
                tmp_guest_ele.find(".chat-avatars img").attr( "src",f_data['f_avatar'] );
                html_  = html_ + tmp_guest_ele.prop("outerHTML");
                //$("#chat-area #ct-" + guest_code).append( tmp_guest_ele );
            }else if( f_data['f_source'] == 2 ){
                var kf_ele = $(".hide_wrap .my_wrap").clone();
                kf_ele.find(".author-name").html( f_data['date'] );
                kf_ele.find(".chat-message").html( f_data['content'] );
                kf_ele.find(".chat-avatars img").attr( "src",f_data['f_avatar'] );
                //$("#chat-area #ct-" + guest_code).append( kf_ele );
                html_ = html_ + kf_ele.prop("outerHTML");
            }
            html_ = html_ + sep_ele.prop("outerHTML");
            //$("#chat-area #ct-" + guest_code).append( $(".hide_wrap .chat-sep").clone() );
        }
        html_ = html_ + $("#chat-area #ct-" + guest_code).html();
        $("#chat-area #ct-" + guest_code).html( html_ );
        this.wordBottom();
    },
    wordBottom:function () {    // 滚动到最底端
        var box = $(".chat-box");
        box.scrollTop(box[0].scrollHeight);
    }
};

var cs_index_ops = {
    init:function(){
        this.info = eval("("+$(".hide_wrap input[name=info]").val()+")");
        this.active_guest_code = null;
        layui.use('layer');
        this.eventBind();
    },
    eventBind:function(){
        var that = this;
        var params = {
            ws_url: $(".hide_wrap input[name=ws]").val(),
            onMessage: function (res) {
                that.handlerMessage( res );
            }
        };
        stkf_ws_service.connect(params);

        // 发送
        $("#sendBtn").click(function () {
            that.kfSendMessage('');
        });

        $("#closeChat").click( function(){
            //发送关闭通知消息给游客
            var guest_target = $("#q-" + that.active_guest_code );
            var cIndex = layer.confirm('您确定要关闭 ' + guest_target.attr("data-name") + ' ？', {
                title: '警告',
                icon: '2',
                btn: ['确定', '再想想']
            }, function(){
                stkf_ws_service.socketSend({
                    cmd: 'kf_close_guest',
                    data: {
                        to_name: guest_target.attr("data-name"),
                        to_code: guest_target.attr("data-id"),
                        to_avatar: "",
                        f_code: that.info['sn'],
                        f_name: that.info['nickname'],
                        f_avatar: that.info['avatar_url'],
                        content: "客服服务完毕，期待下次为您服务~~",
                        f_source:"kefu"
                    }
                });

                layer.close(cIndex);
            }, function(){

            });

        } );

        $(".onwork").click( function(){
            that.setWorkStatus( "onwork" );
        } );
        $(".offline").click( function(){
            that.setWorkStatus( "offline" );
        } );

        that.getServicingList();
    },
    handlerMessage:function( res ){
        var that = this;
        var data = eval("(" + res.data + ")");
        var f_data = data['data'];
        switch (data['cmd']) {
            case "ping":
                stkf_ws_service.socketSend({ "cmd":"pong" });
                break;
            case "chat":
                that.showGuestMessage( f_data );
                break;
            case "guest_close"://游客关闭
            case "sim_guest_close"://游客不在了，模拟关闭
                that.showGuestMessage( f_data );
                //头像职位灰色visitor-gray
                //$("#q-" + f_data['f_code'] ).remove();
                $("#q-" + f_data['f_code'] + " .head-msg" ).addClass( "visitor-gray" );
                break;
        }
    },
    kfConnect:function(){
        var tmp_data = {
            f_name: this.info['nickname'],
            f_avatar: this.info['avatar_url'],
            f_code: this.info['sn'],
            domain:window.location.href,
        };
        stkf_ws_service.socketSend({
            cmd: 'kf_connect',
            data: tmp_data
        });
    },
    selectChatBox:function(){
        var that = this;
        $("#visitor-list .visitor-card").unbind("click"); // 防止事件叠加
        $("#visitor-list .visitor-card").click( function(){
            $(this).removeClass('active').addClass('active').siblings().removeClass('active');
            var guest_code = $(this).attr("data-id");
            that.active_guest_code = guest_code;
            $("#ct-" + that.active_guest_code).show().siblings().hide();
            var tmp_select_target = $("#q-" + that.active_guest_code );
            $(".service-bar #nickname").val( tmp_select_target.attr("data-name") );
            $(".service-bar #ip_addr").val( tmp_select_target.attr("data-ip") );
            //$(".service-bar #guest_code").val( that.active_guest_code );
            that.getChatLog( guest_code );
        });
    },
    getServicingList:function(){
        var that = this;
        $.ajax({
            url: that.buildUrl("/default/get-servicing"),
            dataType:'json',
            success:function( res ){
                if( res.code != 200 ){
                    return;
                }
                for ( idx in res.data ){
                    that.showGuestMessage( res.data[ idx ] );
                }
            }
        });
    },
    getChatLog:function( guest_code ){
        //获取游客的聊天记录
        var that = this;
        if( that.chat_log_cache == undefined ){
            that.chat_log_cache = {};
        }

        if( that.chat_log_cache.hasOwnProperty( guest_code ) ){
            return;
        }
        $.ajax({
            url: that.buildUrl("/default/chat-log"),
            data:{
                guest_code:guest_code
            },
            dataType:'json',
            success:function( res ){
                that.chat_log_cache[ guest_code ] = 1;
                if( res.code != 200 ){
                    return;
                }
                chat_box_ops.geneLogMessage( guest_code,res.data);

            }
        });
    },
    buildUrl:function( path,params ){
        var url =  "/cs"  + path;
        var _paramUrl = '';
        if( params ){
            _paramUrl = Object.keys(params).map(function(k) {
                return [encodeURIComponent(k), encodeURIComponent(params[k])].join("=");
            }).join('&');
            _paramUrl = "?"+_paramUrl;
        }
        return url+_paramUrl
    },
    showGuestMessage:function( f_data ){
        var that = this;
        var tmp_ele_id = f_data['f_code'];
        if( $("#visitor-list").find(  "#q-" + tmp_ele_id ).size() < 1 ){
            var tmp_q_ele = $(".hide_wrap .visitor-card").clone();
            tmp_q_ele.attr("id","q-" + tmp_ele_id );
            tmp_q_ele.attr("data-id",tmp_ele_id );
            tmp_q_ele.attr("data-name",f_data['f_name'] );
            tmp_q_ele.attr("data-ip",f_data['f_ip'] );
            if( f_data.hasOwnProperty( "appid" ) ){
                tmp_q_ele.attr("data-appid",f_data['appid'] );
            }

            tmp_q_ele.find(".msg .name").html( f_data['f_name']);
            tmp_q_ele.find(".msg .visitor-card-time").html( f_data['date'] );
            tmp_q_ele.find(".head-msg").attr( "src",f_data['f_avatar']);
            $("#visitor-list").append( tmp_q_ele );
        }

        //有新消息来了就将头像变亮
        $("#q-" + tmp_ele_id + " .head-msg" ).remove( "visitor-gray" );
        //div 增加聊天内容
        if( $("#chat-area #ct-" + tmp_ele_id).size() < 1 ){
            var tmp_ct_ele = $(".hide_wrap .chat-box").clone();
            tmp_ct_ele.attr("id","ct-" + tmp_ele_id );
            $("#chat-area").append( tmp_ct_ele );
        }

        if( f_data['content'] ){
            var tmp_guest_ele = $(".hide_wrap .guest_wrap").clone();
            tmp_guest_ele.find(".author-name").html( f_data['date'] );
            tmp_guest_ele.find(".chat-message").html( f_data['content'] );
            tmp_guest_ele.find(".chat-avatars img").attr( "src",f_data['f_avatar'] );
            $("#chat-area #ct-" + tmp_ele_id).append( tmp_guest_ele );
            $("#chat-area #ct-" + tmp_ele_id).append( $(".hide_wrap .chat-sep").clone() );
        }
        that.selectChatBox();
        if( $("#visitor-list .visitor-card").size() == 1 ){
            that.active_guest_code = tmp_ele_id;
            $( $("#visitor-list .visitor-card").get(0) ).click();
        }
        chat_box_ops.wordBottom();
    },
    kfSendMessage:function send(inMsg) {
        var that = this;
        if('' == inMsg) {
            var input = $("#textarea").val();
        } else {
            var input = inMsg;
        }

        if( input.length == 0) {
            return ;
        }

        if( that.active_guest_code == null ){
            return;
        }
        var kf_ele = $(".hide_wrap .my_wrap").clone();
        kf_ele.find(".author-name").html( moment().format("YYYY-MM-DD HH:mm:ss") );
        kf_ele.find(".chat-message").html( input );
        kf_ele.find(".chat-avatars img").attr( "src",that.info['avatar_url'] );
        $("#ct-" + that.active_guest_code  ).append( kf_ele );
        $("#ct-" + that.active_guest_code  ).append( $(".hide_wrap .chat-sep").clone() );

        $("#textarea").val('');

        var active_guest = $("#q-" + that.active_guest_code );

        stkf_ws_service.socketSend({
            cmd: 'chat',
            data: {
                to_name: active_guest.attr("data-name"),
                to_code: that.active_guest_code,
                to_avatar: active_guest.attr("data-avatar"),
                f_code: that.info['sn'],
                f_name: that.info['nickname'],
                f_avatar: that.info['avatar_url'],
                content: input,
                f_source:"kefu"
            }
        });

        chat_box_ops.wordBottom();
    },
    setWorkStatus:function( flag ){
        var that = this;
        $.ajax({
            url: that.buildUrl("/user/set-status"),
            type:'POST',
            data:{
                status:flag
            },
            dataType:'json',
            success:function( res ){
                if( res.code == 200 ){
                    $("." + flag ).hide().siblings().show();
                }
            }
        });
    }
};

$(document).ready(function () {
    cs_index_ops.init();
    //输入enter健也可以发送
    $(document).keydown(function (event) {
        if (event.keyCode == 13) {
            $("#sendBtn").click();
            return false;
        }
    });
});