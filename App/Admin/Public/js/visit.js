layui.use('table', () => {
    var table = layui.table;
    table.on('checkbox(demo)', obj => {
        console.log(obj);
    });
    table.on('tool(demo)', obj => {
        var data = obj.data;
        if (obj.event === 'datail') {
            layer.msg('No :' + data.id + '查看操作');
        } else if (obj.event === 'del') {
            layer.confirm('真的删除吗?', (index) => {
                obj.del();
                layer.close(index);
            })
        } else if (obj.event === 'edit') {
            layer.alert('编辑行：<br>'+ JSON.stringify(data));
        }
    });
    var $ = layui.$, active = {
        getCheckData: () => {
            var checkStatus = table.checkStatus('idCheckbox'),data = checkStatus.data;
            layer.alert(JSON.stringify(data));
        },
        getChecklength: () => {
            var checkStatus = table.checkStatus('idCheckbox'),data = checkStatus.data;
            layer.alert('选中了：' + data.length + '个');
        },
        isAll: () => {
            var checkStatus = table.checkStatus('idCheckbox');
            layer.msg(checkStatus.isAll ? '全选' : '未全选');
        }
    };
})