<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/visit/Public/statics/layui/css/layui.css">
    <link rel="stylesheet" href="/visit/App/Admin/Public/css/index.css">
    <title>Visit</title>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">Visit</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;" class="layui-anim layui-anim-up layui-this" id="classification">选择医院科室</a>
                <dl class="layui-nav-child">
                    <?php if(is_array($hospitals)): foreach($hospitals as $index=>$vo): ?><dd class="layui-amin layui-amin-scaleSpring"><a href="javascript:;" onclick="readyHospital(this)" index="<?php echo ($index + 1); ?>"><?php echo ($vo['hospital']); ?></a></dd><?php endforeach; endif; ?>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                    贤心
                </a>
            </li>
            <li class="layui-nav-item"><a href="">退了</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <li class="layui-nav-item" id="edit">
                    <a href="javascript:;">在线编辑</a>
                </li>
                <li class="layui-nav-item layui-nav-itemed" id="charts">
                    <a class="" href="javascript:;">回访信息趋势图</a>
                </li>
                <li class="layui-nav-item layui-nav-itemed" id="add">
                    <a href="javascript:;">科室添加</a>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">快速定位</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" id="nameSearch">按名字查询</a></dd>
                        <dd><a href="javascript:;" id="dateSearch">按日期查询</a></dd>
                        <dd><a href="javascript:;" id="statuSerach">按就诊状态查询</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>

    <div class="layui-body">
        <iframe id="iframe" src="<?php echo U('Admin/Index/visit');?>" frameborder="0" id="demoAdmin" style="width: 100%; height: 300px;"></iframe>
    </div>
</div>

<div style="position:fixed; bottom:0px; left:200px; z-index:999; font-size:12px; font-weight:600;">
    <!-- 底部固定区域 -->
    <a href="javascript:;" title="发布日期: 2018/8/1日:) Github: https://github.com/thisnameisprivate"><span class="layui-icon layui-icon-website layui-anim layui-anim-fadein layui-anim-loop"></span>&nbsp;&nbsp;&nbsp;广元协和医院预约管理系统 ©</a>
</div>
</body>
<script src="/visit/Public/statics/layui/layui.js"></script>
<script src="/visit/App/Admin/Public/js/index.js"></script>
</html>