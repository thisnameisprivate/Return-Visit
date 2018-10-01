<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>visit echarts</title>
    <style>
        .container{height:900px; width:1700px;}
        #pie{height:660px; width:50%; float:left;}
        #pie2{height:660px; width:50%; float:right;}
    </style>
</head>
<body>
<div class="container">
    <div id="pie"></div>
    <div id="pie2"></div>
    <!--<div id="img">-->
        <!--<img src="/visit/Public/statics/images/right.jpg" alt="">-->
    <!--</div>-->
</div>
</body>
<script src="/visit/Public/statics/js/echart.js"></script>
<script src="/visit/Public/statics/js/macarons.js"></script>
<script>
    var myChartPie = echarts.init(document.getElementById('pie'));
    var myChartPie2 = echarts.init(document.getElementById('pie2'), 'macarons');
    myChartPie.setOption({
        title : {
            text: '本月数据总览',
            subtext: '该饼状图只查询本月数据',
            x:'center'
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: ['等待','已到','未到','预约未定','全流失', '半流失', '已诊治']
        },
        series : [
            {
                name: '访问来源',
                type: 'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data:[
                    {value:<?php echo ($data['loading']); ?>, name:'等待'},
                    {value:<?php echo ($data['arrived']); ?>, name:'已到'},
                    {value:<?php echo ($data['arrivedOut']); ?>, name:'未到'},
                    {value:<?php echo ($data['reserUnde']); ?>, name:'预约未定'},
                    {value:<?php echo ($data['loss']); ?>, name:'全流失'},
                    {value:<?php echo ($data['halfLoss']); ?>, name:'半流失'},
                    {value:<?php echo ($data['hasBeen']); ?>, name:'已诊治'}
                ],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    });
    myChartPie2.setOption({
        title : {
            text: '本月咨询到诊比例',
            subtext: '该数据只显示前五名(已到)',
            x:'center'
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: [<?php echo ($names); ?>]
        },
        series : [
            {
                name: '访问来源',
                type: 'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data:[
                    {value:<?php echo ($sort[0]); ?>, name: "<?php echo ($name[0]); ?>"},
                    {value:<?php echo ($sort[1]); ?>, name: "<?php echo ($name[1]); ?>"},
                    {value:<?php echo ($sort[2]); ?>, name: "<?php echo ($name[2]); ?>"},
                    {value:<?php echo ($sort[3]); ?>, name: "<?php echo ($name[3]); ?>"},
                    {value:<?php echo ($sort[4]); ?>, name: "<?php echo ($name[4]); ?>"},
                ],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    })

</script>
</html>