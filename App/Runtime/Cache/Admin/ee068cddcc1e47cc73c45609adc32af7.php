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
<table class="layui-table" lay-data="{width: 100%, height:100%, url:'{U:('Admin/Home/visitCheck')}', page:true, id:'idCheckbox'}" lay-filter="demo">
    <thead>
    <tr>
        <th lay-data="">No . </th>
        <th lay-data="">状态</th>
        <th lay-data="">受理电话</th>
        <th lay-data="">客户卡号</th>
        <th lay-data="">姓名</th>
        <th lay-data="">咨询项目类型</th>
        <th lay-data="">受理状况</th>
    </tr>
    </thead>
</table>
</body>
<script src="/visit/Public/statics/layui/layui.js"></script>
<script src="/visit/App/Admin/Public/js/visit.js"></script>
</html>