<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/visit/Public/statics/layui/css/layui.css">
    <title>Visit</title>
</head>
<body>
<table class="layui-container" id="container" lay-filter="edittable"></table>
<div class="layui-container" id="layerAddHospital" style="display:none;">
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">医院科室：</label>
            <div class="layui-input-inline">
                <input type="text" name="hospital" required lay-verify="required" placeholder="请输入新的医院科室" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-input-inline">
                <button class="layui-btn" lay-submit="" lay-filter="formSubmit">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
</body>
<script src="/visit/Public/statics/layui/layui.js"></script>
<script type="text/html" id="bar">
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script type="text/html" id="toolbaradd">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="add">添加医院科室</button>
    </div>
</script>
<script>
    layui.use(['table', 'layer', 'form'], () => {
        var table = layui.table;
        var layer = layui.layer;
        var form = layui.form;
        table.render({
            text: {
                none: "暂无相关数据",
            },
            initSort: {
                field: 'id',
                type: 'asc',
            },
            elem: '#container',
            toolbar: '#toolbaradd',
            url: "<?php echo U('Admin/Index/departmentRender');?>",
            height: 'full-20',
            cellMinWidth: 150,
            size: 'sm',
            cols: [[
                {field: 'id', title: 'No .' , width:80, sort: true},
                {field: 'hospital', title: '医院科室', width: 200},
                {field: 'addtime', title: '添加时间', width:200},
                {fixed: 'right', width:100, align:'center', toolbar: '#bar'}
            ]],
            id: 'edittable',
        });
        table.on('tool(edittable)', obj => {
            var data = obj.data;
            var layEvent = obj.event;
            var tr = obj.tr;
            if (layEvent === 'del') {
                layer.confirm('【'+ data.hospital +'】你确定删除吗?', index => {
                    var client = new XMLHttpRequest();
                    client.open('GET', "<?php echo U('Admin/Index/delDepartMent/id/"+ parseInt(data.id) +"');?>");
                    client.send();
                    client.onreadystatechange = () => {
                        if (client.readyState === 4 && client.status === 200) {
                            if (client.response == 1) {
                                layer.msg('delete success', {icon: 6});
                                obj.del();
                                layer.close(index);
                            } else {
                                layer.msg('delete failed', {icon: 5});
                            }
                        }
                    }
                })
            }
        });
        table.on('toolbar(edittable)', obj => {
            var checkStatus = table.checkStatus(obj.config.id);
            if (obj.event === 'add') {
                layer.open({
                    type: 1,
                    title: '新增医院科室',
                    area: ['600px', '150px'],
                    content: document.getElementById('layerAddHospital').innerHTML,
                });
            };
            form.on('submit(formSubmit)', data => {
                var client = new XMLHttpRequest();
                client.open('GET', "<?php echo U('Admin/Index/addDepartMent/hospital/"+ JSON.stringify(data.field) +"');?>");
                client.send();
                client.onreadystatechange = () => {
                    if (client.readyState === 4 && client.status === 200) {
                        if (client.response == 1) {
                            layer.msg('add success', {icon: 6});
                            layer.closeAll('page');
                        } else {
                            layer.msg('add failed', {icon: 5});
                        }
                    }
                }
                return false;
            })
        });
    });
</script>
</html>