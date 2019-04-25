<?php
use \common\components\GlobalUrlService;
?>
;
window.STKF_Cookie = (function (window, document, undefined) {
    var cookie = {
        get: function(val) {
            var i,x,y,
                ARRcookies = document.cookie.split(";");
            for (i = 0; i < ARRcookies.length; i++) {
                x = ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
                y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
                x = x.replace(/^\s+|\s+$/g, "");
                if (x == val) {
                    return unescape(y);
                };
            };
        },
        set: function(name, val, days) {
            var date = new Date();
            date.setDate(date.getDate() + days);
            var c_value = val + "; expires=" + date.toUTCString();
            document.cookie = name + "=" + c_value;
        },
        delete: function(name) {
            document.cookie = name + '=;expires=Thu, 05 Oct 1990 00:00:01 GMT;';
        },
        enabled: function () {
            var cookieEnabled = (navigator.cookieEnabled) ? true : false;

            if (typeof navigator.cookieEnabled == "undefined" && !cookieEnabled) {
                document.cookie="testcookie";
                cookieEnabled = (document.cookie.indexOf("testcookie") != -1) ? true : false;
            };

            return (cookieEnabled);
        }
    };
    return cookie;
})(window, document);

!function(win, doc) {
    "use strict";
    var stkf_cli = {
        init:function(){
            this.chat_box_id = "WS-STKF-CHAT";
            this.chat_iframe_id = "STKF-IFRAME-WRAP";
            this.ws_ck_div = this.ws_chat_div = null;
            this.ck_style = "position:fixed;z-index:201902151030;right:20px;bottom:50px;padding:0;"
                + "margin:0;width:100px;height:40px;background:#1E9FFF;border-radius:100px;"
                + "line-height:40px;text-align:center;color:#fff;font-size:13px;cursor:pointer;";
            this.chat_style = "position:fixed;bottom:0px;z-index:201902151030;padding:0;margin:0;"
                + "overflow:hidden;background-color:transparent;box-shadow:0 0 20px 0 rgba(0, 0, 0, .15);";
            this.hide_style= "display:none";
            this.show_style = "display:block";

            this.store_key = "guest_stkf_cs";
            this.eventBind();
        },
        eventBind:function(){
            this.initCustomer();
            this.createChatBox();
        },
        createChatBox:function(){
            var ws_ck_div, ws_chat_div;
            //咨询漂浮
            ws_ck_div = document.createElement("div");
            ws_ck_div.setAttribute("style", this.ck_style);
            ws_ck_div.setAttribute("id", this.chat_box_id );
            var text = document.createTextNode("咨询客服");
            ws_ck_div.appendChild(text);
            doc.body.appendChild(ws_ck_div);
            this.ws_ck_div = ws_ck_div;

            var is_pc_flag = "<?=$is_pc;?>";
            if( is_pc_flag == "1" ){
                this.chat_style += "right:20px;"
            }else{
                this.chat_style += "right:0px;top:0px;"
            }
            //iframe的wrap div
            ws_chat_div = document.createElement("div");
            ws_chat_div.setAttribute("style", this.chat_style + this.hide_style);
            doc.body.appendChild(ws_chat_div);

            var ws_iframe = document.createElement("iframe");
            ws_iframe.scrolling = "no";

            ws_iframe.setAttribute("frameborder", "0", 0);
            ws_iframe.setAttribute("id", this.chat_iframe_id );


            if( is_pc_flag == "1" ){
                ws_iframe.setAttribute("width", "400px");
                ws_iframe.setAttribute("height", "550px");
            }else{
                var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
                var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
                ws_iframe.setAttribute("width",  w  + "px");
                ws_iframe.setAttribute("height", h +"px" );
            }

            ws_iframe.src = "<?=$iframe_url;?>?uuid=" + this.getCustomerUUID();
            ws_chat_div.appendChild(ws_iframe);
            this.ws_chat_div = ws_chat_div;

            this.showChatBox();
        },
        hideChatBox:function () {
            this.ws_ck_div.setAttribute("style", this.ck_style + this.show_style);
            this.ws_chat_div.setAttribute("style", this.chat_style + this.hide_style);
        },
        showChatBox : function () {
            var that = this;
            doc.getElementById( this.chat_box_id ).onclick = function () {
                that.ws_ck_div.setAttribute("style", that.ck_style + that.hide_style);
                that.ws_chat_div.setAttribute("style", that.chat_style + that.show_style);
                //将页面的的来源和当前url都传递到平台
                var tmp_data = '{ "cmd":"open_chat","kf_referer": "' + doc.referrer + '","kf_url": "' + win.location.href + '","ua":"' + navigator.userAgent +'" }';
                doc.getElementById( that.chat_iframe_id ).contentWindow.postMessage(tmp_data, '*');
            };
        },
        initCustomer:function(){
            var enable_localstorage = this.getEnableOnLocalStorage() ;
            var store_key = this.store_key;
            var store_val = "<?=$uuid;?>";

            if( STKF_Cookie.enabled() && STKF_Cookie.get( store_key ) == undefined ){
                STKF_Cookie.set(store_key,store_val,"/",10000);
            }

            if( enable_localstorage && window.localStorage.getItem(store_key) == undefined ){
                window.localStorage.setItem( store_key ,store_val );
            }

            if( enable_localstorage ){
                window.localStorage.removeItem( "a" );
            }
        },
        getCustomerUUID:function(){
            var enable_localstorage = this.getEnableOnLocalStorage() ;
            var store_key = this.store_key;
            if( enable_localstorage && window.localStorage.getItem(store_key) != undefined ) {
                return window.localStorage.getItem(store_key);
            }

            if( STKF_Cookie.enabled() && STKF_Cookie.get( store_key ) != undefined ){
                return STKF_Cookie.get( store_key );
            }

        },
        getEnableOnLocalStorage:function(){
            var enable_localstorage = window.localStorage && (window.localStorage.setItem('a', 123) , window.localStorage.getItem('a') == 123) ;
            return enable_localstorage
        }
    };

    //iframe子页面床底过来的消息我们要接受下并进行处理，例如关闭窗口，等等
    win.addEventListener('message', function(event){
        if( 'hide_chat' == event.data ) {
            stkf_cli.hideChatBox();
        }else if( "open_chat" == event.data ){
            doc.getElementById( stkf_cli.chat_box_id ).onclick();
        }else if( "connect" == event.data ){
            //将页面的的来源和当前url都传递到平台
            var tmp_data = '{ "cmd":"guest_in","kf_referer": "' + doc.referrer + '","kf_url": "' + win.location.href + '","ua":"' + navigator.userAgent +'" }';
            doc.getElementById( stkf_cli.chat_iframe_id ).contentWindow.postMessage(tmp_data, '*');
        }
    }, false);
    
    stkf_cli.init();
}(window, document);
