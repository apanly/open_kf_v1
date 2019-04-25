;
! function($) {
    "use strict";
    var cls = {},
    zIndex = 888,
    layCounter = 1,
    type,
    index,
    layWidth,
    layHeight,
    objStyle;
    $.extend({
        lay: {
            defaults: {
                title: '提示信息',
                shade: true,
                shadeClose: false,
                params: null,
                btnText: ['确定', '取消'],
                ok: null,
                cancel: null,
                layControl: true,
                preventClose: false,
                content: null,
                lockScreen: true,
                area: []
            },
            //createLay
            createLay: function(data) {
                var content = data.content || '';
                var type = data.type || 1;
                var opts;
                if (type == 1 || type == 2) {
                    opts = $.extend({}, $.lay.defaults, data);
                } else {
                    opts = $.extend({}, $.lay.defaults, data.options);
                }
                var title = (opts.title == "false" || opts.title == false) ? false : opts.title;
                if (type == 1 || type == 2) {
                    title = (opts.title == "false" || opts.title == false || opts.title == $.lay.defaults.title) ? false : opts.title;
                }
                var shade = (opts.shade == "false" || opts.shade == false) ? false : true;
                var shadeClose = (opts.shadeClose == "false" || opts.shadeClose == false) ? false : true;
                var params = opts.params;
                var okText = opts.btnText[0];
                var cancelText = opts.btnText[1];
                var ok = data.ok || opts.ok;
                var cancel = data.cancel || opts.cancel;
                var layControl = (opts.layControl == "false" || opts.layControl == false) ? false : true;
                var preventClose = (opts.preventClose == "false" || opts.preventClose == false) ? false : true;
                var lockScreen = (opts.lockScreen == "false" || opts.lockScreen == false) ? false : true;
                layWidth = opts.area[0];
                layHeight = opts.area[1];
                cls = {
                    'lay-shade': 'lay-shade',
                    'lay-body': 'lay-body lay-msg',
                    'lay-title': 'lay-title',
                    'lay-control': 'lay-control',
                    'lay-close': 'lay-close',
                    'lay-content': 'lay-content',
                    'lay-btns': 'lay-btns',
                    'lay-btn-confirm': 'lay-btn-confirm',
                    'lay-btn-cancel': 'lay-btn-cancel'
                }
                if (type == 1 || type == 2) {
                    cls['lay-body'] = 'lay-body lay-lay';
                }
                if (type == 1 && typeof(content) != 'object' || type == 2) {
                    cls['lay-body'] = 'lay-body lay-lay lay-lay-string';
                }
                if (type == 2) {
                    content = '<iframe class="lay-iframe" src="' + content + '"></iframe>'
                }
                //layDom
                var layDoms = {
                    a: '<div class="' + cls['lay-shade'] + '"></div>', //lay-shade
                    b: '<div class="' + cls['lay-body'] + '">', //lay-body
                    c: '<div class="' + cls['lay-title'] + '">' + title + '</div>', //lay-title
                    d: '<div class="' + cls['lay-control'] + '"><i class="' + cls['lay-close'] + '">&times;</i></div>', //lay-control
                    e: '<div class="' + cls['lay-content'] + '" >' + content + '</div>', //lay-content
                    f: '<div class="' + cls['lay-btns'] + '">', //lay-btns
                    g: '<a class="' + cls['lay-btn-confirm'] + '">' + okText + '</a>', //lay-btn-confirm
                    h: '<a class="' + cls['lay-btn-cancel'] + '">' + cancelText + '</a>', //lay-btn-cancel
                    fe: '</div>',
                    be: '</div>'
                }
                var doms = '';

                if (type == 1 && typeof(content) == 'object') {
                    objStyle = content.attr('style') || '';
                    content.show().addClass('lay-wrap').wrap(layDoms.b);
                    //shade
                    if (shade) {
                        content.parents('.lay-body').before(layDoms.a);
                    }
                    //title
                    if (title) {
                        content.parents('.lay-body').prepend(layDoms.c);
                    }
                    //layControl
                    if (layControl) {
                        content.parents('.lay-body').prepend(layDoms.d);
                    }
                } else {
                    //遮罩
                    if (shade) {
                        doms += layDoms.a;
                    }
                    //主体
                    doms += layDoms.b;
                    //非tip、load 显示标题与控制区
                    if (type != 5 && type != 6) {
                        //标题
                        if (title) {
                            doms += layDoms.c;
                        }
                        //lay control 控制
                        if (layControl) {
                            doms += layDoms.d;
                        }
                    }
                    //内容
                    doms += layDoms.e;
                    //按钮
                    if (type == 3 || type == 4) {
                        doms += layDoms.f;
                        doms += layDoms.g;
                        if (type == 4) {
                            doms += layDoms.h;
                        }
                        doms += layDoms.fe;
                    }
                    doms += layDoms.be;
                }
                //弹出层主体
                $('body').append(doms);
                //zindex
                $('.lay-shade:last').css({
                    'z-index': zIndex++
                }).attr('id', 'lay-shade-' + layCounter);
                //shadeClose
                if (shadeClose) {
                    $('.lay-shade:last').addClass('lay-shade-close');
                }
                $.lay.refresh(); //位置控制
                $('.lay-body:last').css({
                    'z-index': zIndex++
                }).attr({
                    'id': 'lay-body-' + layCounter,
                    'layCounter': layCounter++
                });

                //事件
                if (!preventClose) { //允许点击关闭按钮关闭弹层
                    $('.lay-btn-confirm,.lay-close,.lay-btn-cancel,.lay-shade-close').click(function() {
                        index = $('.lay-body:last').attr('layCounter');
                        var trigger = $(this);
                        //点击确认
                        if ($(this).hasClass('lay-btn-confirm')) {
                            if (ok) {
                                if (params) { //如果传了参数params
                                    ok(params);
                                } else ok();
                            }
                        } else if ($(this).hasClass('lay-btn-cancel') || $(this).hasClass('lay-close') || $(this).hasClass('lay-shade-close')) {
                            if (cancel) {
                                cancel(trigger);
                            }
                        }
                        $.lay.close(index);
                    });
                }
                if (lockScreen) {
                    $('html').addClass('lay-lock');
                }
                return layCounter - 1; //将index返回
            },
            //open
            open: function(data) {
                return $.lay.createLay(data);
            },
            //close
            close: function(index) {
                index = index || $('.lay-body:last').attr('layCounter');
                $('#lay-shade-' + index).remove();
                if ($('#lay-body-' + index).hasClass('lay-msg') || $('#lay-body-' + index).hasClass('lay-lay-string')) {
                    $('#lay-body-' + index).remove();
                } else if ($('#lay-body-' + index).hasClass('lay-lay') && !$('#lay-body-' + index).hasClass('lay-lay-string')) {
                    $('#lay-body-' + index).find('.lay-wrap').siblings().remove().end().unwrap().removeClass('lay-wrap').attr('style', objStyle).hide();
                }
                if ($('.lay-shade').length < 1) {
                    $('html').removeClass('lay-lock');
                }
            },
            closeAll: function(sort) {
                switch (sort) {
                    case 'msg':
                        $('.lay-msg').each(function() {
                            index = $(this).attr('layCounter');
                            $(this).remove();
                            $('#lay-shade-' + index).remove();
                        });
                        if ($('.lay-shade').length < 1) {
                            $('html').removeClass('lay-lock');
                        }
                        break;
                    case 'lay':
                        $('.lay-lay').each(function() {
                            index = $(this).attr('layCounter');
                            $('#lay-shade-' + index).remove();
                            if ($(this).hasClass('lay-lay-string')) {
                                $(this).remove();
                            } else {
                                $(this).find('.lay-wrap').siblings().remove().end().unwrap().removeClass('lay-wrap').hide();
                            }
                        });
                        if ($('.lay-shade').length < 1) {
                            $('html').removeClass('lay-lock');
                        }
                        break;
                    default:
                        $('.lay-msg').remove();
                        $('.lay-lay').not('lay-lay-string').find('.lay-wrap').siblings().remove().end().unwrap().removeClass('lay-wrap').hide();
                        $('.lay-lay-string').remove();
                        $('.lay-shade').remove();
                        $('html').removeClass('lay-lock');
                }
            },
            //alert
            alert: function(content, options, ok, cancel) {
                var postionFlag = typeof options === 'function';
                if (postionFlag) {
                    cancel = ok;
                    ok = options;
                }
                return $.lay.open({
                    type: 3,
                    content: content,
                    ok: ok,
                    cancel: cancel,
                    options: postionFlag ? {} : options
                });
            },
            //confirm
            confirm: function(content, options, ok, cancel) {
                var postionFlag = typeof options === 'function';
                if (postionFlag) {
                    cancel = ok;
                    ok = options;
                }
                return $.lay.open({
                    type: 4,
                    content: content,
                    ok: ok,
                    cancel: cancel,
                    options: postionFlag ? {} : options
                });
            },
            //load
            load: function() {
                //type 6
            },
            //prompt
            prompt: function() {
                //type 7
            },
            //refresh
            refresh: function(area) {
                var winWidth = $(window).width();
                var winHeight = $(window).height();
                $('.lay-body:last .lay-body,.lay-body:last .lay-wrap').css({
                    'max-width': winWidth - 50,
                    'max-height': winHeight - 50
                });
                if (layWidth != 'auto') {
                    $('.lay-body:last .lay-body,.lay-body:last .lay-wrap').css({
                        'width': layWidth
                    });
                }
                if (layHeight != 'auto') {
                    $('.lay-body:last .lay-body,.lay-body:last .lay-wrap').css({
                        'height': layHeight
                    });
                }
                $('.lay-body:last .lay-wrap').css('height','');
                var layMarginLeft = -$('.lay-body:last').width() / 2;
                var layMarginTop = -$('.lay-body:last').height() / 2;
                $('.lay-body:last').css({
                    'margin-left': layMarginLeft,
                    'margin-top': layMarginTop
                });
                $('.lay-body:last .lay-wrap').css({
                    'height': $('.lay-body:last').height() - $('.lay-title:last').height()
                });
                if (area) {
                    if (area[0] && area[0] != 'auto') {
                        layWidth = area[0];
                        $('.lay-body:last .lay-body,.lay-body:last .lay-wrap').css({
                            'width': layWidth
                        });
                    }
                    if (area[1] && area[1] != 'auto') {
                        layHeight = area[1];
                        $('.lay-body:last .lay-body,.lay-body:last .lay-wrap').css({
                            'height': layHeight
                        });
                    }
                }
            }
        }

    });
    //快捷调用
    $.alert = $.lay.alert;
    $.confirm = $.lay.confirm;
    $.prompt = $.lay.prompt;
    $(window).keyup(function(e) {
        switch (e.keyCode) {
            case 27:
                if ($('.lay-btn-cancel').length) {
                    $('.lay-btn-cancel').click();
                }
                $.lay.close();
                break;
            case 13:
                if ($('.lay-btn-confirm').length) {
                    $('.lay-btn-confirm').click();
                }
                break;
            default:
                ;
        }
    });
    //tip方法
    $.fn.extend({
        tip: function(msg, options) {
            var that = $(this);

            var options = options || [];
            var tipStyle = options[0] || 1;
            tipStyle = parseInt(tipStyle);
            var tipPosition = options[1] || 'bottom';
            that.focus(); //to deal

            var tipDom = '<div class="tip-wrap style-' + tipStyle + '"><i class="tip-i tip-i-1"></i><i class="tip-i tip-i-2"></i><div class="tip-msg">' + msg + '</div></div>';
            if (that.next('div').hasClass('tip-wrap')) {
                that.next('div').find('.tip-msg').html(msg).end().stop().fadeIn();
            } else {
                that.after(tipDom);
                that.next('div').stop().fadeIn();
            }

            var tip = that.next('.tip-wrap');
            var offsetL = that.offset().left;
            var offsetT = that.offset().top;
            var objW = that.outerWidth();
            var objH = that.outerHeight();
            var tipW = that.next('.tip-wrap').outerWidth();
            var tipH = that.next('.tip-wrap').outerHeight();
            var tipPos = 'tip-top tip-right tip-bottom tip-left';
            var tipSty = 'style-1 style-2 style-3';
            tip.removeClass(tipSty).addClass('style-' + tipStyle).removeClass(tipPos).css({
                'z-index': zIndex++
            });

            switch (tipPosition) {

                case 'top':
                    tip.offset({
                        'top': offsetT - tipH - 8,
                        'left': offsetL
                    }).addClass('tip-top');
                    break;

                case 'right':
                    tip.offset({
                        'top': offsetT + (objH - tipH) / 2,
                        'left': offsetL + objW + 15
                    }).addClass('tip-right');
                    break;

                case 'left':
                    tip.offset({
                        'top': offsetT,
                        'left': offsetL - tipW - 8
                    }).addClass('tip-left');
                    break;

                case 'bottom':
                    ;
                default:
                    tip.offset({
                        'top': offsetT + objH + 8
                    }).addClass('tip-bottom');
                    if (that.hasClass('input-1') || that.hasClass('textarea')) {
                        tip.offset({
                            'left': offsetL
                        })
                    } else {
                        tip.offset({
                            'left': offsetL + (objW - tipW) / 2
                        })
                        that.next('.tip-wrap').find('.tip-i').css({
                            'left': '50%',
                            'margin-left': '-8px'
                        })
                    }
                    //防止右侧超出屏幕
                    if ($(window).width() - offsetL < 100 && (tipPosition == 'top' || tipPosition == 'bottom')) {
                        tip.offset({
                            'left': offsetL + (objW - tipW)
                        })
                        that.next('.tip-wrap').find('.tip-i').css({
                            'left': 'auto',
                            'right': '8px'
                        })
                    }
            }
        },
        hideTip: function() {
            var that = $(this);
            if (that.next('div').hasClass('tip-wrap')) {
                that.next('.tip-wrap').stop().fadeOut();
            }
        },
        refreshTip: function() {
            var that = $(this);
            if (that.next('div').hasClass('tip-wrap')) {
                that.next('.tip-wrap').css({
                    'top': that.offset().top + $(this).outerHeight() + 8
                });
            }
        }
    });
}(jQuery);
;;
var core_ops = {
    init:function(){
      this.defaults={
        smallWidth:640,
        mediumWidth:990
      };
      this.adjustWinWidth();
      // this.clearfix();
      // this.prettifySelect();
      this.tab();
      this.showPanel();
      this.hasTip();
      this.eventBind();
    },
    eventBind:function(){
      $('.box_left_nav,.menu_list').css({
        'height' : $(window).height()-170
      });
      //左侧导航菜单折叠／展开控制
      $('.menu_switch').click(function(){
        $('.menu_list li span').hide();
        //添加动画效果
        if( !$(this).parents('.box_wrap').hasClass('open') ){
          $('.box_left_nav,.menu_switch').stop().animate({
            'width' : '200px'
          });
          $('.box_main').stop().animate({
            'margin-left' : '200px'
          });
          $('.menu_switch i').eq(0).hide();
          $('.menu_switch i').eq(1).show();
          $('.menu_list li span').each(function(){
            var index = $('.menu_list li span').index(this);
            $(this).stop().delay( 1000 * parseInt( index /3 ) ).fadeIn();
          });
        }
        else{
          $('.box_left_nav,.menu_switch').stop().animate({
            'width' : '90px'
          });
          $('.box_main').stop().animate({
            'margin-left' : '90px'
          });
          $('.menu_switch i').eq(0).show();
          $('.menu_switch i').eq(1).hide();
        }
        $('.box_wrap').toggleClass('open');
      });
      //
      $('.menu_list li').hover(function(){
        if(!$(this).parents('.box_wrap').hasClass('open')){
          $(this).tip($(this).find('span').text(),[3,'right']);
        }
      },function(){
        $(this).hideTip();
      });
      $(window).resize(function(){
        core_ops.adjustWinWidth();
        $('.box_left_nav,.menu_list').css({
          'height' : $(window).height()-170
        });
      });
      //滚动条
      $(".box_left_nav .menu_list").mCustomScrollbar({
        theme:"minimal"
      });
      //edit-mode
      if($('.edit-mode').length){
        $('.edit-mode').each(function(){
          var that=$(this);
          if(that.find('.select-all').length){
            that.find('.select-all').change(function(){
              if($(this).prop('checked')==false){
                $(this).parents('.edit-mode').find('input:checkbox').not($(this)).prop('checked',false);
              }
              else{
                $(this).parents('.edit-mode').find('input:checkbox').not($(this)).prop('checked',true);
              }
            });
          }
          var elem=that.data('elem');
          var selectedClass=that.data('class');
          var disabledElem='thead tr,thead th,.disabled';
          that.find(disabledElem).css('cursor','default');
          that.on('click',elem,function(event){
            if(!$(this).hasClass('disabled')){
              $(this).parents('.edit-mode').find(elem).not($(this)).removeClass('selected').removeClass(selectedClass);
              $(this).not(disabledElem).toggleClass('selected '+selectedClass);
              if($(this).not('thead tr').find("input:checkbox").length){
                if($(this).find("input:checkbox").prop('checked')==false && $(this).hasClass('selected')){
                  $(this).find("input:checkbox").prop('checked',true);
                }
                else if(!$(this).hasClass('selected')){
                  $(this).find("input:checkbox").prop('checked',false);
                }
                $('.edit-mode').on('click','input:checkbox',function(event){
                  event.stopPropagation();
                });
              }
              event.stopPropagation();
            }
          });
        });
      }
      //preload images
      var preload_img=new Image();
      preload_img.src='https://static-s.styd.cn/201606201358/loading.gif';
    },
    adjustWinWidth:function(){
      var winWidth=$(window).width();
      if(winWidth<=this.defaults.smallWidth){
        $('body').removeClass('body-medium').removeClass('body-large').addClass('body-small');
      }
      else if(winWidth>this.defaults.smallWidth && winWidth<=this.defaults.mediumWidth){
        $('body').removeClass('body-small').removeClass('body-large').addClass('body-medium');
      }
      else{
        $('body').removeClass('body-small').removeClass('body-medium').addClass('body-large');
      }
    },
    // clearfix:function(){
    //   $('.clearfix,.row').each(function(){
    //     $(this).prepend('<before></before>').append('<after></after>');
    //   });
    // },
    prettifySelect:function(){
     $('.select-1').each(function(){
       var that=$(this);
       var num=that.find('option').length;
       var dom='<div class="select-wrap">';
       dom+='<div class="select-selected"><span>'+that.val()+'</span><i class="icon_club">&#xe614;</i></div>'
       dom+='<div class="select-options">';
       dom+='<ul>'
       for(var i=0;i<num;i++){
         dom+='<li>'+that.find('option').eq(i).text()+'</li>'
       }
       dom+='</ul></div></div>';
       that.after(dom);
     });

     $('.select-options').each(function(){
       $(this).css({
         'width':$(this).parents('.select-wrap').width()
       });
     });

     $('.select-selected').click(function(){
       var num=$(this).parents('.select-wrap').prev('.select-1').find('option').length;
       var dom='';
       for(var i=0;i<num;i++){
         dom+='<li>'+$(this).parents('.select-wrap').prev('.select-1').find('option').eq(i).text()+'</li>';
       }
       $(this).parents('.select-wrap').find('ul li').remove();
       $(this).parents('.select-wrap').find('ul').append(dom);
       var currentText=$(this).find('span').text();
       $(this).parents('.select-wrap').find('.select-options').toggle();
       $(this).parents('.select-wrap').find('.select-options li').each(function(){
         if($(this).text() == currentText){
           $(this).addClass('current').siblings('li').removeClass('current');
         }
       });
     });

     $('.select-wrap').on('click','.select-options li',function(){
       $(this).parents('.select-options').hide();
       $(this).parents('.select-wrap').find('.select-selected span').text($(this).text());
       var currentIndex=$('.select-options li').index(this);
       $(this).parents('.select-wrap').prev('.select-1').val($(this).parents('.select-wrap').prev('.select-1').find('option').eq(currentIndex).attr('value')).find('option').eq(currentIndex).attr('selected','selected').siblings('option').removeAttr('selected');
       if(!$(this).hasClass('current')){
         $(this).parents('.select-wrap').prev('.select-1').change();
       }
     });
    //  $('.select-options li').click(function(){
    //    $(this).parents('.select-options').hide();
    //    $(this).parents('.select-wrap').find('.select-selected span').text($(this).text());
    //    var currentIndex=$('.select-options li').index(this);
    //    $(this).parents('.select-wrap').prev('.select-1').val($(this).parents('.select-wrap').prev('.select-1').find('option').eq(currentIndex).attr('value')).find('option').eq(currentIndex).attr('selected','selected').siblings('option').removeAttr('selected');
    //    if(!$(this).hasClass('current')){
    //      $(this).parents('.select-wrap').prev('.select-1').change();
    //    }
    //  });

     $(document).bind("click",function(e){
       var target = $(e.target);
       if(target.closest(".select-wrap").length == 0){
         $(".select-options").hide();
       }
     });
   },
   //tab
   tab:function(){
     if($('.tab-1 .tab-title li').length){
       $('.tab-1 .tab-title li').click(function(){
         $(this).addClass('current').siblings('li').removeClass('current');
         var currentIndex=$('.tab-1 .tab-title li').index(this);
         $(this).parents('.tab-1').find('.tab-each').eq(currentIndex).show().siblings('.tab-each').hide();
       });
     }
   },
   showPanel:function(){
     var timer=null;
     if($('.has-panel').length){
       $('.has-panel').each(function(){
         var that=$(this);
         var panelTop = that.offset().top + that.height();
         $('.'+that.data('panel')).css('top',panelTop);
         that.hover(function(){
           clearTimeout(timer);
           $('.'+that.data('panel')).stop().slideDown();
         },function(){
           timer=null;
           timer=setTimeout(function(){
             $('.'+that.data('panel')).stop().slideUp();
           },500);
         });
         $('.'+that.data('panel')).hover(function(){
           clearTimeout(timer);
         },function(){
           timer=$('.'+that.data('panel')).stop().slideUp();
         });
       });
     }
   },
   hasTip: function(){
     $('i.icon_club').each(function(){
       $(this).hover(function(){
         switch( escape($(this).text()) ){
           case '%uE610':
            $(this).tip('编辑',[3,'bottom']);
            break;
           case '%uE611':
            $(this).tip('删除',[3,'bottom']);
            break;
           case '%uE613':
            $(this).tip('添加',[3,'bottom']);
            break;
           case '%uE616':
            $(this).tip('查看',[3,'bottom']);
            break;
           case '%uE61E':
            $(this).tip('生成',[3,'bottom']);
            break;
           case '%uE61C':
            $(this).tip('导入',[3,'bottom']);
            break;
           case '%uE61B':
            $(this).tip('导出',[3,'bottom']);
            break;
           defautl:;
         }
       },function(){
         $(this).hideTip();
       });
     });
     $('.hastips .icon_club,.hastip').each(function(){
       $(this).hover(function(){
         if( $(this).data('tip') ){
           $(this).tip($(this).data('tip'),[3,'bottom']);
         }
       },function(){
         $(this).hideTip();
       });
     });
   }
};

$(document).ready(function(){
  core_ops.init();
});
