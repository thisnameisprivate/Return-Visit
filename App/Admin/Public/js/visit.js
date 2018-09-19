layui.use('table', () => {
    var table = layui.table;
    table.render({
        elem: '#demo',
        height: 312,
        url: "{:U('Admin/Index/visitCheck')}",
        page: true,
        colsl: [[
            {field: 'id', title: 'ID', width:80, sort: true, fixed: 'left'}
            ,{field: 'status', title: '用户名', width:80}
            ,{field: 'phone', title: '性别', width:80, sort: true}
            ,{field: 'clientPhone', title: '城市', width:80}
            ,{field: 'name', title: '签名', width: 177}
            ,{field: 'options', title: '积分', width: 80, sort: true}
            ,{field: 'visitStatus', title: '评分', width: 80, sort: true}
        ]]
    });
})