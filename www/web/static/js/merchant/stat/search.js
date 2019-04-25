;
var log_ops = {
    init:function(){
        this.datetimepickerComponent();
    },
    datetimepickerComponent:function(){
        $.datetimepicker.setLocale('zh');
        params = {
            scrollInput:false,
            scrollMonth:false,
            scrollTime:false,
            timepicker:false,
            dayOfWeekStart : 1,
            lang:'zh',
            todayButton:true,//回到今天
            defaultSelect:true,
            step:5,
            defaultDate:new Date().Format('yyyy-MM-dd'),
            format:'Y-m-d',//格式化显示
            onChangeDateTime:function(dp,$input){
                //alert($input.val())
            }
        };
        $('#search_conditions input[name=date_from]').datetimepicker( params );
        $('#search_conditions input[name=date_to]').datetimepicker( params );
    }
};

$(document).ready( function(){
    log_ops.init();
});