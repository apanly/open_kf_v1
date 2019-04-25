;
var user_login_ops = {
    init:function(){
        layui.use('layer');
        this.eventBind();
    },
    eventBind:function(){
        var that = this;
        $(".login-form #btn").click( function(){
            var btn_target = $(this);
            if( btn_target.hasClass("disabled") ){
                layer.alert( "正在提交，请不要重复提交~~" );
                return ;
            }
            var login_name = $(".login-form input[name=login_name]").val();
            var login_pwd = $(".login-form input[name=login_pwd]").val();
            if( login_name == undefined || login_name.length < 1 ){
                layer.alert("请输入符合规范的登录用户名~~");
                return;
            }

            if( login_pwd == undefined || login_pwd.length < 1 ){
                layer.alert("请输入符合规范的登录密码~~");
                return;
            }
            btn_target.addClass("disabled");
            $.ajax({
                url:window.location.href,
                type:'POST',
                data:{
                    login_name:login_name,
                    login_pwd:login_pwd
                },
                dataType:'json',
                success:function( res ) {
                    btn_target.removeClass("disabled");
                    if( res.code != 200 ) {
                        layer.alert( res.msg );
                    }else{
                        window.location.href = res.data.url;
                    }
                }
            });
        });
    }
};

$(document).ready( function () {
    user_login_ops.init();

    $(document).on('keydown', function (e) {
        if (e.keyCode == 13) {
            $('#btn').click();
        }
    });
});