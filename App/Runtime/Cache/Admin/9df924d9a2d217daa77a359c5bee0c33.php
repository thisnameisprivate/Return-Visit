<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/visit/Public/statics/layui/css/layui.css">
    <link rel="stylesheet" href="/visit/App/Admin/Public/css/index.css">
    <style>
        .layui-body{height:100%; width:100%; overflow:hidden;}
        .layui-layout-admin .layui-header{background: #2F4056;}
    </style>
    <title>Visit</title>
    <script type="text/javascript">
        document.cookie = "tableName=nkvisit";
    </script>
</head>
<body class="layui-layout-body" style="overflow-y:hidden;">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">回访数据管理系统</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;" class="layui-anim layui-anim-up layui-this" id="classification">广元协和医院男科</a>
                <dl class="layui-nav-child">

                    <?php if(is_array($hospitals)): foreach($hospitals as $index=>$vo): ?><dd class="layui-amin layui-anim-scaleSpring"><a href="javascript:;" onclick="readyHospital(this);" tableName="<?php echo ($vo['tableName']); ?>"><?php echo ($vo['hospital']); ?></a></dd><?php endforeach; endif; ?>

                </dl>
            </li>
            <li class="layui-nav-item"><a href="javascript:;">注销</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <li class="layui-nav-item tableName" onclick="editdata(this);">
                    <a href="javascript:;"><i class="layui-icon layui-icon-table" style="font-size: 18px;">   </i>回访数据总览</a>
                </li>
                <li class="layui-nav-item layui-nav-itemed tableName" id="charts">
                    <a class="" href="javascript:;" onclick="echarts();"><i class="layui-icon layui-icon-chart-screen" style="font-size: 18px;">   </i>回访趋势图</a>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="layui-icon layui-icon-app" style="font-size: 18px;">   </i>系统管理</a>
                    <dl class="layui-nav-child">
                        <dd class="tableName" onclick="custservice();"><a href="javascript:;"><i class="layui-icon layui-icon-headset" style="font-size: 18px;">   </i>客服管理</a></dd>
                        <dd class="tableName" onclick="departMent(this);"><a href="javascript:;"><i class="layui-icon layui-icon-form" style="font-size: 18px;">   </i>科室管理</a></dd>
                        <dd class="tableName" onclick="user();"><a href="javascript:;"><i class="layui-icon layui-icon-user" style="font-size: 18px;">   </i>用户管理</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>

    <div class="layui-body">
        <iframe id="iframe" src="<?php echo U('Admin/Index/echarts');?>" frameborder="0" style="height:105%; width:91.2%;"></iframe>
    </div>
</div>

<div style="position:fixed; bottom:0px; left:200px; z-index:999; font-size:12px; font-weight:600;">
    <!-- 底部固定区域 -->
    <a href="javascript:;" title="发布日期: 2018/10/1日:)"><span class="layui-icon layui-icon-website layui-anim layui-anim-fadein layui-anim-loop"></span>&nbsp;&nbsp;&nbsp;广元协和医院预约回访管理系统 ©</a>
</div>
</body>
<script src="/visit/Public/statics/layui/layui.js"></script>
<script>
    layui.use(['element', 'layer', 'form'], () => {
        var layer = layui.layer;
        departMent = tableName => {
            var Request = new XMLHttpRequest();
            Request.open('GET', "<?php echo U('Admin/Index/departMent');?>");
            Request.send();
            Request.onreadystatechange = () => {
                document.getElementById('iframe').setAttribute('src', "<?php echo U('Admin/Index/departMent');?>");
            }
        }
        editdata = tableName => {
            var tableName = tableName.getAttribute('tableName');
            if (! tableName != '') {
                layer.msg('请先选择科室', {icon: 5});
                return false;
            }
            var promise = new Promise((resolve, reject) => {
                if (document.cookie.indexOf(tableName) != -1) {
                    resolve();
                } else {
                    return reject('set cookie failed');
                }
            });
            promise.then(resolve => {
                var Request = new XMLHttpRequest();
                Request.open('GET', "<?php echo U('Admin/Index/visit');?>");
                Request.send();
                Request.onreadystatechange = () => {
                    document.getElementById('iframe').setAttribute('src', "<?php echo U('Admin/Index/visit');?>");
                }
            }, reject => {
                layer.msg(reject, {icon: 5});
                return false;
            })
        }
        custservice = () => {
            var Request = new XMLHttpRequest();
            Request.open('GET', "<?php echo U('Admin/Index/custservice');?>");
            Request.send();
            Request.onreadystatechange = () => {
                document.getElementById('iframe').setAttribute('src', "<?php echo U('Admin/Index/custservice');?>");
            }
        }
        user = () => {
            var Request = new XMLHttpRequest();
            Request.open('GET', "<?php echo U('Admin/Index/user');?>");
            Request.send();
            Request.onreadystatechange = () => {
                document.getElementById('iframe').setAttribute('src', "<?php echo U('Admin/Index/user');?>");
            }
        }
        echarts = () => {
            var Request = new XMLHttpRequest();
            Request.open('GET', "<?php echo U('Admin/Index/echarts');?>");
            Request.send();
            Request.onreadystatechange = () => {
                document.getElementById('iframe').setAttribute('src', "<?php echo U('Admin/Index/echarts');?>");
            }
        }
        readyHospital = tableName => {
            var ification = document.getElementById('classification');
            var selects = document.getElementsByClassName('tableName');
            ification.innerHTML = tableName.innerText + "<span class='layui-nav-more'></span>";
            for (var i = 0; i < selects.length; i ++) {
                selects[i].setAttribute('tableName', tableName.getAttribute('tableName'));
            }
            document.cookie = "tableName=" + tableName.getAttribute('tableName');
            console.log(tableName.getAttribute('tableName'));
        }
    })
</script>
</html>