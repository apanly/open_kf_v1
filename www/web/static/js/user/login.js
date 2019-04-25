;
var user_login_ops = {
    init: function () {
        this.eventBind();
        this.bindGetCaptcha();
        this.bindPopup();
        this.togglePassword();
        this.getLoginpic();
    },
    eventBind: function () {
        var that = this;
        // $('body').on('focus', '.input_box', function () {
        //     $('.login_tips').text('');
        // });
        $(".icon_nav").click(function () {
            $(".icon_nav, .nav_list").toggleClass("actived");
            if ($(this).hasClass("actived")) {
                $(".lock_layer").show();
            } else {
                $(".nav_list .sub_nav, .nav_product_sub").removeClass("actived");
                $(".lock_layer").hide();
            }
        });
        $(".nav_product_sub").click(function () {
            $(".nav_list .sub_nav, .nav_product_sub").toggleClass("actived");
        });

        $(".fg-password").click(function () {
            $('#pop .pop').html($('#tpl_4').html());
            that.showPop({
                title: '忘记密码',
                msg: '',
                flag: 'fg'
            });
            $('#pop').on('click', '.success_confirm', function () {
                window.location.reload();
            });
        });

        $("#forget .doforget").click(function () {
            if (!that.inputCheck()) {
                return;
            }
            var mobile = $("#forget input[name=mobile]").val();
            var public_key = $("#forget input[name=public_key]").val();
            var timestamp = $("#forget input[name=timestamp]").val();
            var img_captcha = $("#forget input[name=img_captcha]").val();
            var newPassword = $("#forget input[name=password]").val();
            var captcha = $("#forget input[name=captcha]").val();
            $.ajax({
                url: common_ops.getUrlPrefix() + "/user/forget",
                type: 'POST',
                data: {
                    'mobile': mobile,
                    'public_key': public_key,
                    'timestamp': timestamp,
                    'img_captcha': img_captcha,
                    'password': newPassword,
                    'captcha': captcha
                },
                dataType: 'json',
                success: function (res) {
                    if (res.code == 200) {
                        that.closePop();
                        $("#login input[name=login_name]").val(mobile)
                        $("#login input[name=login_pwd]").val('')
                        alert("重置密码成功");
                        // that.lightenOrDisabled("countdown");
                    } else {
                        alert(res.msg);

                        $("#img_captcha").click();
                        // that.lightenOrDisabled("light");
                    }
                }
            });
        });

        $("#forget .get_captcha").click(function () {
            var mobile = $("#forget input[name=mobile]").val();
            var img_captcha = $("#forget input[name=img_captcha]").val();
            var btn_target = $(this);
            if ( btn_target.hasClass("secondary") ) {
                return false;
            }
            if (mobile.length <= 0 || !/^[1-9]\d{10}$/.test(mobile)) {
                alert("请输入符合要求的手机号码！");
                return false;
            }

            if (img_captcha.length < 1) {
                alert("请输入图形校验码！");
                return false;
            }

            that.lightenOrDisabled("disabled");
            $.ajax({
                url:  "/user/get_captcha",
                type: 'POST',
                data: {'mobile': mobile,  'img_captcha': img_captcha},
                dataType: 'json',
                success: function (res) {
                    if (res.code == 200) {
                        that.lightenOrDisabled("countdown");
                    } else {
                        alert(res.msg);
                        $("#img_captcha").click();
                        that.lightenOrDisabled("light");
                    }
                }
            });
        });

        $('#login .do_login').click(function () {
            var login_name = $('#login input[name=login_name]').val();
            var login_pwd = $('#login input[name=login_pwd]').val();
            var btn_target = $(this);

            if (login_name.length < 1) {
                alert('请输入用户名~~');
                return;
            }

            if (login_pwd.length < 1) {
                alert('请输入密码！');
                return;
            }

            if ( btn_target.hasClass('secondary')) {
                alert("正在登录中，请不要重复点击~~");
                return;
            }

            btn_target.addClass('secondary');

            $.ajax({
                url: '/user/login',
                type: 'POST',
                data: {
                    login_name: login_name,
                    login_pwd: login_pwd
                },
                dataType: 'json',
                success: function (res) {
                    btn_target.removeClass('secondary');
                    alert( res.msg );
                    if (res.code == 200) {
                        window.location.href = res.data.url;
                    }
                }
            });
        });
    },
    bindPopup: function () {
        var $close = $('.close-reveal-modal');
        $close.click(this.closePop);
    },
    showPop: function (options) {
        var opts = options || {};
        var msg = opts.msg || '';
        var title = opts.title || '帐号锁定';

        var $shade = $('.reveal-modal-bg');
        var $pop = $('.reveal-modal');

        $pop.find('.modal-title').text(title);
        $pop.find('.tips').html(msg);
        if (opts.flag === 'fg') {
            $pop.addClass('fg-modal');
            $pop.find('.modal-title').addClass('fg-title');
            $shade.addClass('fg-modal-bg');
        } else {
            $pop.find('.modal-title').removeClass('fg-title');
            $pop.removeClass('fg-modal');
            $shade.removeClass('fg-modal-bg');
        }

        $shade.show();
        $pop.fadeIn();
        $pop.find('.input_box').eq(0).focus();
    },
    closePop: function () {
        var $shade = $('.reveal-modal-bg');
        var $pop = $('.reveal-modal');
        $pop.fadeOut();
        $shade.hide();
    },
    inputCheck: function () {
        if ($("#forget input[name=mobile]").val().length <= 0 ||
            !/^[1-9]\d{10}$/.test($("#forget input[name=mobile]").val())) {
            alert("请输入符合要求的手机号码！");
            return false;
        }

        if ($("#forget input[name=captcha]").val().length <= 0) {
            alert("请输入验证码！");
            return false;
        }

        if ($("#forget input[name=password]").val().length < 6) {
            alert("请输入符合要求的密码！");
            return false;
        }
        return true;
    },
    bindGetCaptcha: function () {
        this.intervalid = null;
        this.timeCount = 60;
        var that = this;

        $('body').on('click', '.get_captcha', function () {
            var mobile = $('input[name=login_name]').val();
            var public_key = $('input[name=public_key]').val();
            var timestamp = $('input[name=timestamp]').val();
            var img_captcha = $('input[name=img_captcha]').val();
            var $tip = $('.login_tips.type_2');

            if ($(this).hasClass('secondary')) {
                return false;
            }

            if (mobile.length <= 0 || !/^[1-9]\d{10}$/.test(mobile)) {
                $tip.text('请输入符合要求的手机号码！');
                return false;
            }

            if (img_captcha.length < 1) {
                $tip.text('请输入图形校验码！');
                return false;
            }

            that.lightenOrDisabled('disabled');
            $.ajax({
                url: '/web/user/get_captcha',
                type: 'POST',
                data: {
                    mobile: mobile,
                    public_key: public_key,
                    timestamp: timestamp,
                    img_captcha: img_captcha
                },
                dataType: 'json',
                success: function (res) {
                    if (res.code == 200) {
                        that.lightenOrDisabled('countdown');
                    } else {
                        $tip.text(res.msg);
                        $('#img_captcha').click();
                        that.lightenOrDisabled('light');
                    }
                }
            });
        });
    },
    togglePassword: function () {
        $('body').on('click', '.password_eye', function () {
            var $pwd = $(this).prev('.input_password');
            $(this).toggleClass('visible');
            if ($(this).hasClass('visible')) {
                $pwd.prop('type', 'text');
            } else $pwd.prop('type', 'password');
        })
    },
    getLoginpic: function () {
        $('.wappper').css('background', 'url(/static/images/user/banner-2.jpg) top center no-repeat');
        // if (data.is_show_url === "1" && data.url) {
        //     $('.wappper').css('cursor', 'pointer');
        //     $(".wappper").attr('href', data.url);
        //     $(".wappper").attr('target', "_blank");
        // }
    },
    lightenOrDisabled: function (type) {
        var that = this;
        if (type == 'disabled') {
            $('.get_captcha').addClass('secondary');
        } else if (type == 'light') {
            $('.get_captcha').removeClass('secondary');
        } else if (type == 'countdown') {
            $('.get_captcha').addClass('secondary');
            this.intervalid = setInterval(function () {
                that.setCaptchaTips();
            }, 1000);
        }
    },
    setCaptchaTips: function () { //倒计时提示
        var that = this;
        that.timeCount--;
        if (that.timeCount <= 0) {
            clearInterval(that.intervalid);
            that.lightenOrDisabled('light');
            $('.get_captcha').html('获取验证码');
            that.timeCount = 60;
            return;
        }
        $('.get_captcha').html(that.timeCount + ' 重新获取');

    }
};
$(document).ready(function () {
    user_login_ops.init();
    $(document).on('keydown', function (e) {
        if (e.keyCode == 13) {
            $('.do_login').click();
        }
    });
});
