<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/visit/Public/statics/layui/css/layui.css">
    <link rel="stylesheet" href="/visit/App/Admin/Public/css/visit.css">
    <style>
        .container{position:relative; width:900px; height: 500px; top:0; left:0; bottom:0; right:0; margin:auto; padding-top: 50px;}
    </style>
    <title>visit</title>
</head>
<body>
<div><?php echo ($tableName); ?></div>
<table id="container" lay-filter="edittable"></table>
<div class="layui-container" id="layerpopCheck" style="display:none;">
    <p>查看信息弹出窗口</p>
</div>
<div class="layui-container" id="layerpopEdit" style="display:none;">
    <form class="layui-form" lay-filter="formedit">
        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-inline">
                <input type="text" name="status" autocomplete="off" class="layui-input">
            </div>
            <label class="layui-form-label">咨询电话</label>
            <div class="layui-input-inline">
                <input type="text" name="phone" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">客户电话</label>
            <div class="layui-input-inline">
                <input type="text" name="clientPhone" autocomplete="off" class="layui-input">
            </div>
            <label class="layui-form-label">客服姓名</label>
            <div class="layui-input-inline">
                <select name="name" lay-verify="required">
                    <option value=""></option>
                    <option value="0">北京</option>
                    <option value="1">上海</option>
                    <option value="2">广州</option>
                    <option value="3">深圳</option>
                    <option value="4">杭州</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">就诊项目</label>
            <div class="layui-input-inline">
                <div class="layui-input-inline">
                    <select name="options" lay-verify="required">
                        <option value=""></option>
                        <option value="0">北京</option>
                        <option value="1">上海</option>
                        <option value="2">广州</option>
                        <option value="3">深圳</option>
                        <option value="4">杭州</option>
                    </select>
                </div>
            </div>
            <label class="layui-form-label">回访状态</label>
            <div class="layui-input-inline">
                <div class="layui-input-inline">
                    <select name="visitStatus" lay-verify="required">
                        <option value="0">等待回访</option>
                        <option value="1">已回访</option>
                        <option value="2">全流失</option>
                        <option value="3">半流失</option>
                        <option value="4">已预约</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">消费金额</label>
            <div class="layui-input-inline">
                <input type="text" name="money" autocomplete="off" class="layui-input">
            </div>
        </div>
    </form>
</div>
<div class="layui-container" id="layerAddData" style="display:none;">
    <div class="container">
        <form class="layui-form" lay-filter="formadd">
            <div class="layui-form-item">
                <label class="layui-form-label">回访目标</label>
                <div class="layui-input-inline">
                    <input type="text" name="username" lay-veify="required" placeholder="请输入病人名字或昵称~" autocomplete="off" class="layui-input">
                </div>
                <label class="layui-form-label">回访电话</label>
                <div class="layui-input-inline">
                    <input type="text" name="clientPhone" lay-verify="phone" placeholder="请输入病人联系方式~" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">客服电话</label>
                <div class="layui-input-inline">
                    <input type="text" name="phone" lay-verify="phone" placeholder="请输入客服小姐姐电话~" autocomplete="off" class="layui-input">
                </div>
                <label class="layui-form-label">客服姓名</label>
                <div class="layui-input-inline">
                    <select name="name" lay-verify="required">
                        <option value=""></option>
                        <option value="0">北京</option>
                        <option value="1">上海</option>
                        <option value="2">广州</option>
                        <option value="3">深圳</option>
                        <option value="4">杭州</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">回访状态</label>
                <div class="layui-input-inline">
                    <div class="layui-input-inline">
                        <select name="visitStatus" lay-verify="required">
                            <option value="0">等待回访</option>
                            <option value="1">已回访</option>
                            <option value="2">全流失</option>
                            <option value="3">半流失</option>
                            <option value="4">已预约</option>
                        </select>
                    </div>
                </div>
                <label class="layui-form-label">来院状态</label>
                <div class="layui-input-inline">
                    <div class="layui-input-inline">
                        <select name="status" lay-verify="required">
                            <option value="0">等待回访</option>
                            <option value="1">已回访</option>
                            <option value="2">全流失</option>
                            <option value="3">半流失</option>
                            <option value="4">已预约</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">消费金额</label>
                <div class="layui-input-inline">
                    <input type="text" name="money" placeholder="¥_¥ 必须为数字~" autocomplete="off" class="layui-input">
                </div>
                <label class="layui-form-label">就诊项目</label>
                <div class="layui-input-inline">
                    <div class="layui-input-inline">
                        <select name="options" lay-verify="required">
                            <?php if(is_array($diseasesList)): foreach($diseasesList as $index=>$vo): ?><option value="<?php echo ($index); ?>"><?php echo ($vo['diseases']); ?></option><?php endforeach; endif; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="fromadd">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div><?php echo (cookie('disease')); ?></div>
</body>
<script src="/visit/Public/statics/layui/layui.js"></script>
<script type="text/html" id="toolbaradd">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="add">添加新的信息</button>
    </div>
</script>
<script type="text/html" id="bar">
    <a class="layui-btn layui-btn-xs" lay-event="detail">查看</a>
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script>
    layui.use(['table', 'layer', 'form'], () => {
        var table = layui.table;
        var layer = layui.layer;
        var form = layui.form;
        var tableIns = table.render({
            text: {
                none: '暂无相关数据',
            },
            initSort: {
              field: 'id',
              type: 'desc',
            },
            elem: '#container',
            toolbar: '#toolbaradd',
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
                ,{field: 'username', title: '回访目标', width:100}
                ,{field: 'addtime', title: '修改时间', width:177}
                ,{field: 'phone', title: '咨询电话', width:177}
                ,{field: 'clientPhone', title: '客户电话', width:177}
                ,{field: 'name', title: '客服姓名', width: 100}
                ,{field: 'options', title: '就诊项目', width: 80}
                ,{field: 'visitStatus', title: '回访状态', width: 100}
                ,{field: 'money', title: '消费金额', width: 177, sort: true}
                ,{fixed: 'right', width:150, align:'center', toolbar: '#bar'}
                ,
            ]],
            id: 'edittable',
        });
        table.on('tool(edittable)', obj => {
            var data = obj.data;
            console.log(data);
            var layEvent = obj.event;
            var tr = obj.tr;
            if (layEvent === 'detail') { // check tool data
                layer.open({
                    type: 1,
                    title: '查看信息',
                    area: ['900px', '600px'],
                    content: document.getElementById('layerpopCheck').innerHTML,
                })
            } else if (layEvent === 'del') { // delete tool data
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
            } else if (layEvent === 'edit') { // edit tool data
                layer.open({
                    type: 1,
                    title: '编辑信息',
                    area: ['900px', '600px'],
                    content: document.getElementById('layerpopEdit').innerHTML,
                });
                setFormValue(data);
                obj.update({

                })
            }
        });
        table.on('toolbar(edittable)', obj => {
            var checkStatus = table.checkStatus(obj.config.id);
            if (obj.event === 'add') {
                layer.open({
                    type: 1,
                    title: '新增回访信息',
                    area: ['900px', '600px'],
                    content: document.getElementById('layerAddData').innerHTML,
                });
                form.render();
                form.on('submit(fromadd)', data => {
                    var client = new XMLHttpRequest();
                    client.open('GET', "<?php echo U('Admin/Index/addData/data/"+ JSON.stringify(data.field) +"');?>");
                    client.send();
                    client.onreadystatechange = () => {
                        if (client.readyState === 4 && client.status === 200) {
                            if (client.response === 1) {
                                layer.msg('add success', {icon: 6});
                                layer.closeAll('page');
                                tableIns.reload();
                            } else {
                                layer.msg('add failed', {icon: 5});
                            }
                        }
                    }
                });
            }
        });
        /* 渲染form表单 */
        function setFormValue (data) {
            form.val('formedit', {
                'status': data.status,
                'phone': data.phone,
                'clientPhone': data.clientPhone,
                'name': data.name,
                'options': data.options,
                'visitStatus': data.visitStatus,
                'money': data.money,
            });
            form.render();
        }
    });
</script>
</html>