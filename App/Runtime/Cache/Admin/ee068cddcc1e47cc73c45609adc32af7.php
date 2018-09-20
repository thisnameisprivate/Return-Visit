<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/visit/Public/statics/layui/css/layui.css">
    <link rel="stylesheet" href="/visit/App/Admin/Public/css/visit.css">
    <title>visit</title>
</head>
<body>
<table id="container" lay-filter="edittable"></table>
<div class="layui-container" id="layerpopCheck">
    <p>查看信息弹出窗口</p>
</div>
<div class="layui-container" id="layerpopEdit">
    <p>修改信息弹出窗口</p>
</div>
</body>
<script src="/visit/Public/statics/layui/layui.js"></script>
<script type="text/html" id="bar">
    <a class="layui-btn layui-btn-xs" lay-event="detail">查看</a>
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script>
    layui.use(['table', 'layer', 'form'], () => {
        var table = layui.table;
        var layer = layui.layer;
        table.render({
            text: {
                none: '暂无相关数据',
            },
            initSort: {
              field: 'id',
              type: 'desc',
            },
            elem: '#container',
            url: "<?php echo U('Admin/Index/visitCheck');?>",
            height:'full-0',
            even:true,
            cellMinWidth:100,
            page: true,
            limit: 25,
            limits: [25, 40, 60, 90, 150, 200],
            loading: true,
            size: 'sm',
            cols: [[
                {type: 'checkbox'},
                {field: 'id', title: 'No . ', width:80, sort: true}
                ,{field: 'status', title: '状态', width:80}
                ,{field: 'phone', title: '咨询电话', width:177}
                ,{field: 'clientPhone', title: '客户电话', width:177}
                ,{field: 'name', title: '名字', width: 100}
                ,{field: 'options', title: '就诊项目', width: 80}
                ,{field: 'visitStatus', title: '回访状态', width: 100}
                ,{field: 'money', title: '消费金额', width: 177, sort: true}
                ,{fixed: 'right', width:150, align:'center', toolbar: '#bar'}
                ,
            ]],
            id: 'edittable',
            done: (res, curr, count) => {
            }
        });
        table.on('tool(edittable)', obj => {
            var data = obj.data;
            console.log(data);
            var layEvent = obj.event;
            var tr = obj.tr;
            if (layEvent === 'detail') {
                layer.open({
                    type: 1,
                    title: '查看信息',
                    area: ['900px', '600px'],
                    content: document.getElementById('layerpopCheck').innerHTML,
                })
            } else if (layEvent === 'del') {
                layer.confirm('【 ' + data.name + ' 】do you delete source?', (index) => {
                    var client = new XMLHttpRequest();
                    client.open("GET", "<?php echo U('Admin/Index/delete/id/" + parseInt(data.id) + "');?>");
                    client.send();
                    client.onreadystatechange = () => {
                        if (client.readyState === 4 && client.status === 200) {
                            if (client.response == 1) {
                                layer.msg('delete success', {icon: 6});
                                obj.del();
                                layer.close(index);
                            } else {
                                layer.msg('delete fialed', {icon: 5});
                            }
                        }
                    }
                });
            } else if (layEvent === 'edit') {
                layer.open({
                    type: 1,
                    title: '编辑信息',
                    area: ['900px', '600px'],
                    content: document.getElementById('layerpopEdit').innerHTML,
                });
                obj.update({

                })
            }
        })
    })
</script>
</html>