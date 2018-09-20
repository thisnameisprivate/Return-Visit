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
<table id="demo" lay-filter="edittable"></table>
</body>
<script src="/visit/Public/statics/layui/layui.js"></script>
<script type="text/html" id="bar">
    <a class="layui-btn layui-btn-xs" lay-event="detail">查看</a>
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script>
    layui.use('table', () => {
        var table = layui.table;
        table.render({
            text: {
                none: '暂无相关数据',
            },
            initSort: {
              field: 'id',
              type: 'desc',
            },
            id: 'idtest',
            height:'full-20',
            even:true,
            cellMinWidth:100,
            limit: 10,
            size: 'sm',
            elem: '#demo',
            url: "<?php echo U('Admin/Index/visitCheck');?>",
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
                console.log(res);
                console.log(curr);
                console.log(count);
            }
        });
        table.on('tool(edittable)', obj => {
            var data = obj.data;
            var layEvent = obj.event;
            var tr = obj.tr;
            if (layEvent === 'detail') {
                layer.msg('onclick select');
            } else if (layEvent === 'del') {
                layer.confirm('do you delete source?', (index) => {
                    console.log(index);
                    obj.del();
                    layer.close(index);
                })
            } else if (layEvent === 'edit') {
                obj.update({

                })
            }
        })
    })
</script>
</html>