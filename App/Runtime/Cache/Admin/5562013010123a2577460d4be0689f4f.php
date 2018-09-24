<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/visit/Public/statics/layui/css/layui.css">
    <style>
        .container{position:relative; width:500px; height: 200px; top:0; left:0; bottom:0; right:0; margin:auto; padding-top: 20px;}
    </style>
    <title>visit</title>
</head>
<body>
<table class="layui-container" id="container" lay-filter="custservice"></table>
<div class="layui-container" id="layerAddCustomer" style="display:none;">
    <div class="container">
        <form class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label">客服名称：</label>
                <div class="layui-input-inline">
                    <input type="text" name="custservice" required lay-verify="customer" placeholder="请输入客服小姐姐名字~" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="formSubmit">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
<script src="/visit/Public/statics/layui/layui.js"></script>
<script type="text/html" id="bar">
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script type="text/html" id="toolbaradd">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="add">添加客服</button>
    </div>
</script>
<script>
    layui.use(['table', 'form', 'layer'], () => {
        var table = layui.table;
        var layer = layui.layer;
        var form = layui.form;
        var tableIns = table.render({
            text: {
                none: '没找到客服小姐姐~'
            },
            initSort: {
                field: 'id',
                type: 'asc',
            },
            elem: '#container',
            toolbar: '#toolbaradd',
            url: "<?php echo U('Admin/Index/custserviceCheck');?>",
            height: 'full-20',
            cellMinWidth: 150,
            size: 'sm',
            cols: [[
                {field: 'id', title: 'NO .', width:80, sort: true},
                {field: 'custservice', title: '客服', width:100},
                {field: 'addtime', title: '添加时间', width:200},
                {field: 'right', width:100, align:'center', toolbar:'#bar'},
            ]],
            id: '#custservice',
        });
        table.on('tool(custservice)', obj => {
            var data = obj.data;
            var layEvent = obj.event;
            var tr = obj.tr;
            if (layEvent === 'del') {
                layer.confirm('【'+ data.hospital +'】你确定删除吗?', index => {
                    var client = new XMLHttpRequest();
                    client.open('GET', "<?php echo U('Admin/Index/custserviceDelete/id/"+ parseInt(data.id) +"');?>");
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
        table.on('toolbar(custservice)', obj => {
            var checkStatus = table.checkStatus(obj.config.id);
            if (obj.event === 'add') {
                layer.open({
                    type: 1,
                    title: '新增客服小姐姐~',
                    area: ['600px', '300px'],
                    content: document.getElementById('layerAddCustomer').innerHTML,
                });
            };
            form.on('submit(formSubmit)', data => {
                var client = new XMLHttpRequest();
                client.open('GET', "<?php echo U('Admin/Index/custserviceAdd/custservice/"+ JSON.stringify(data.field) +"');?>");
                client.send();
                client.onreadystatechange = () => {
                    if (client.readyState === 4 && client.status === 200) {
                        if (client.response == 1) {
                            layer.msg('add success', {icon: 6});
                            layer.closeAll('page');
                            tableIns.reload();
                        } else {
                            layer.msg('add failed', {icon: 5});
                        }
                    }
                }
                return false;
            });
            form.verify({
                customer: (value, item) => {
                    if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                        return '客服名称不能有特殊字符';
                    }
                    if(/^\d+\d+\d$/.test(value)){
                        return '客服名称不能全为数字';
                    }
                    if(/(^\_)|(\__)|(\_+$)/.test(value)){
                        return '客服名称首尾不能出现下划线\'_\'';
                    }
                }
            })
        });
    });
</script>
</html>