<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>visit echarts</title>
    <link rel="stylesheet" href="/visit/Public/statics/layui/css/layui.css">
    <style>
        /*.container{height:900px; width:1700px;}*/
        /*#pie{height:660px; width:50%; float:left;}*/
        /*#pie2{height:660px; width:50%; float:right;}*/
        .container{display: flex; justify-content: center; height:500px; width:100%;}
        .container div{flex: 1;}
        .container-title{display:flex; justify-content: center; width:100%;}
        .container-title div{flex: 1; margin: 2%; margin-top: 2%;}
        .layui-card-body{font-size: 1rem; text-align: center; color: #009688;}
        .layui-card-header{background-color: #5FB878; color: white;}
    </style>
</head>
<body>
<div class="container-title">
    <div class="layui-card">
        <div class="layui-card-header">客服</div>
        <div class="layui-card-body">
            <i class="layui-icon layui-icon-user" style="font-size: 40px; color: #009688;">    </i><?php echo ($custServiceCount?$custServiceCount:'暂无相关数据'); ?>
        </div>
    </div>
    <div class="layui-card">
        <div class="layui-card-header">总消费</div>
        <div class="layui-card-body">
            <i class="layui-icon layui-icon-rmb" style="font-size: 40px; color: #009688">    </i>¥<?php echo ($moneyCount?$moneyCount:'暂无相关数据'); ?>
        </div>
    </div>
    <div class="layui-card">
        <div class="layui-card-header">已到</div>
        <div class="layui-card-body">
            <i class="layui-icon layui-icon-flag" style="font-size: 40px; color: #009688">    </i><?php echo ($arrival?$arrival:'暂无相关数据'); ?>
        </div>
    </div>
    <div class="layui-card">
        <div class="layui-card-header">未到</div>
        <div class="layui-card-body">
            <i class="layui-icon layui-icon-survey" style="font-size: 40px; color: #009688">    </i><?php echo ($arrivalo?$arrivalo:'暂无相关数据'); ?>
        </div>
    </div>
</div>
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