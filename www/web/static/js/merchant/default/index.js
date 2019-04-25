;
var default_index_ops = {
    init:function(){
        this.eventBind();
        chart_ops.setOption();
        this.dateComponent();
        $(".chart_form_wrap select[name=custom_date]").change();
    },
    eventBind:function(){
        var that = this;
        $(".chart_form_wrap select[name=custom_date]").change(function(){
            var tmp_selected_target = $(this).find("option:selected");
            var tmp_date_from = tmp_selected_target.attr("date_from");
            var tmp_date_to = tmp_selected_target.attr("date_to");
            $(".chart_form_wrap input[name=date_range_picker]").val(  tmp_date_from + " 至 " + tmp_date_to );
            $(".chart_form_wrap input[name=date_from]").val( tmp_date_from );
            $(".chart_form_wrap input[name=date_to]").val( tmp_date_to );
            that.drawCharts();
        });
    },
    drawCharts:function(){
        var that = this;
        $.ajax({
            url: common_ops.buildMerchantUrl("/charts/dashboard"),
            data: {
                date_from: $(".chart_form_wrap input[name=date_from]").val(),
                date_to: $(".chart_form_wrap input[name=date_to]").val()
            },
            dataType: 'json',
            success: function (res) {
                var data = res.data ;
                chart_ops.drawPie( {'title':'来路域名', 'target':'source_chart', 'series':data.source.series});
                chart_ops.drawPie( {'title':'浏览器', 'target':'client_browser_chart', 'series':data.client_browser.series});
            }
        });

    },
    dateComponent:function(){
        var that = this;
        //date range picker
        $("input[name=date_range_picker]").dateRangePicker({
            autoClose: false,
            format: 'YYYY-MM-DD',
            separator: ' 至 ',
            language: 'cn',
            startOfWeek: 'monday',// or monday
            getValue: function() {
                return $(this).val();
            },
            setValue: function(s,start,end) {
                if(!$(this).attr('readonly') && !$(this).is(':disabled') && s != $(this).val()) {
                    $(this).val(s);
                }
                $(".chart_form_wrap input[name=date_from]").val( start );
                $(".chart_form_wrap input[name=date_to]").val( end );
            },
            startDate: false,
            endDate: false,
            time: {
                enabled: false
            },
            minDays: 0,
            maxDays: 0,
            showShortcuts: false,
            shortcuts: {},
            customShortcuts : [],
            inline:false,
            container:'body',
            alwaysOpen:false,
            singleDate:false,
            lookBehind: false,
            batchMode: false,
            duration: 200,
            stickyMonths: false,
            dayDivAttrs: [],
            dayTdAttrs: [],
            applyBtnClass: '',//确定btn的class btn-tiny
            singleMonth: 'auto',
            hoveringTooltip: function(days, startTime, hoveringTime)
            {
                return false;
            },
            showTopbar: true,
            customTopBar: '请选择时间',
            swapTime: false,
            selectForward: false,
            selectBackward: false,
            showWeekNumbers: false,
            getWeekNumber: function(date) {//date will be the first day of a week
                return moment(date).format('w');
            }
        }).bind('datepicker-apply',function(event,obj) {
            that.drawCharts();
        });
    }
};

$(document).ready( function(){
    default_index_ops.init();
} );