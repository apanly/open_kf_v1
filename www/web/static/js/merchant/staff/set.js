;
var staff_set_ops = {
    init:function(){
        this.eventBind();
    },
    eventBind:function(){
        $(".wrap_staff_set .save").click( function(){
            var btn_target = $(this);
            if( btn_target.hasClass("disabled") ){
                $.alert( "正在提交，请不要重复提交~~" );
                return ;
            }

            var nickname_target = $(".wrap_staff_set input[name=nickname]");
            var nickname = nickname_target.val();

            var login_name_target = $(".wrap_staff_set input[name=login_name]");
            var login_name = login_name_target.val();

            var login_pwd_target = $(".wrap_staff_set input[name=login_pwd]");
            var login_pwd = login_pwd_target.val();

            if( nickname == undefined || nickname.length < 1 ){
                nickname_target.tip("请输入符合规范的昵称~~");
                return;
            }

            if( login_name == undefined || login_name.length < 4 ){
                login_name_target.tip("请输入符合规范的登录用户名，登录名称介于4 - 11 个字符~~");
                return;
            }

            if( login_pwd == undefined || login_pwd.length < 6  ){
                login_pwd_target.tip("请输入符合规范的密码，密码不能少于6位~~");
                return;
            }

            btn_target.addClass("disabled");
            var data = {
                id:$(".wrap_staff_set input[name=id]").val(),
                nickname:nickname,
                login_name:login_name,
                login_pwd:login_pwd
            };
            $.ajax({
                url:common_ops.buildMerchantUrl("/staff/set"),
                type:'POST',
                data:data,
                dataType:'json',
                success:function( res ) {
                    btn_target.removeClass("disabled");
                    if( res.code == 200 ) {
                        callback = {
                            'ok': function () {
                                window.location.href = common_ops.buildMerchantUrl("/staff/index");
                            }
                        }
                    }
                    $.alert(res.msg,callback);
                }
            });
        });
    }
};

$(document).ready( function(){
    staff_set_ops.init();
} );