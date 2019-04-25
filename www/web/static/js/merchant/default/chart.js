;
var chart_ops = {
    setOption:function(){
        Highcharts.setOptions({
            exporting: {
                enabled: false
            },
            colors: this.getDefinedColor(),
            legend: {
                enabled:false
            },
            credits:{
                enabled:false
            },
            lang: {
                noData: "暂无数据"
            },
            noData: {
                style: {
                    fontWeight: 'bold',
                    fontSize: '15px',
                    color: '#303030'
                }
            }
        });
    },
    getDefinedColor:function(){
        var colors = ['#058DC7', '#50B432', '#ED561B', '#DDDF00',
            '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4','#E93EFF'];
        return colors  ;
    },
    drawLine:function( data ){
        $('#'+data.target).highcharts({
            chart:{
                height:270,
                type:'spline'
            },
            title: {
                text: data.title,
                align:"left"
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                labels: {
                    formatter: function() {
                        return data.categories[this.value];
                    }
                },
                tickInterval:1
            },
            yAxis: {
                title: {
                    text: ''
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            plotOptions: {
                spline: {
                    marker: {
                        enabled: true
                    }
                }
            },
            tooltip: {
                formatter:function () {
                    var s = '<b>' +data.categories[this.x] + '</b>';
                    var weekArray = ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"];
                    s += '<br/>' + weekArray[ new Date( data.categories[this.x] ).getDay() ];
                    $.each(this.points, function () {
                        s += '<br/>' + this.series.name + ': ' + this.y + '次';
                    });

                    return s;
                },
                shared: true
            },
            legend: {
                enabled:true,
                layout:"vertical",
                align: 'right',
                verticalAlign: 'top',
                floating: true
            },
            credits: {
                enabled:false
            },
            series: data.series
        });
    },
    drawPie:function( data ){
        $('#'+data.target).highcharts({
            chart: {
                // backgroundColor: '#000000',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                height:300
            },
            noData:{

            },
            colors: this.getDefinedColor(),
            title: {
                text: data.title,
                align:"left"
            },
            credits: {
                enabled:false
            },
            tooltip: {
                // pointFormat: '<b>{point.percentage:.1f}%</b>',
                formatter:function () {
                    var s = '<b>' + this.point.name + "<br/>" + this.y + '%（'+ this.point.total_number +'次）</b>';
                    return s;
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}<br/>{point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        },
                        distance:50
                    },
                    //innerSize: '75%',
                    showInLegend: false
                }
            },
            legend: {
                itemStyle : {
                    'fontSize' : '12px',
                    'color'    : '#768499'
                },
                layout: 'horizontal',
                symbolHeight: 12,
                symbolWidth :12,
                symbolRadius :10,
                itemMarginBottom:5,
                borderWidth: 0
            },
            series: data.series
        });
    }
};
