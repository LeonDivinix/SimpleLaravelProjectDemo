<div id = "admin_user_index_grid" style="height: 100%; width: 100%; margin:0; padding:0"></div>

<script>
    require(
        ["dojo/domReady!"],
        function() {
            var menuId = '<?php echo $menuId; ?>'; // 菜单id
            var addTitle = "用户"; // 编辑界面标题
            var moduleName = "User"; // 模块名称
            var listUrl = moduleName + "/list"; // 获得列表链接
            var infoUrl = moduleName + "/info"; // 详情链接
            var gridRenderId = "admin_user_index_grid"; // 渲染grid的id
            var queryFormId = "admin_user_query_form"; // 查询用form的id

            var addUrl = <?php echo $permission["addUrl"]; ?>;
            var updateUrl = <?php echo $permission["updateUrl"]; ?>;
            var importUrl = <?php echo $permission["importUrl"]; ?>;
            var exportUrl = <?php echo $permission["exportUrl"]; ?>;

            // grid列属性配置
            var columnModel = [
                {
                    id: GRID_OPERATE_COLUMN_ID, name: "操作", width: '80px', sortable: false,
                    formatter: function (rawData) {
                        var str = '<a href="#" onclick="toSingleEditTab(\'' + updateUrl + '?id=' + rawData["id"] + '\', \'修改用户\', \'' + menuId + '\');">修改</a>';
                        str += "";
                        return str;
                    }
                },
                {id: "id", field: "id", name: "ID", width: '290px', hidden: true, editable: false},
                {id: "name", field: "name", name: "登录名", width: '80px', editable: false},
                {id: "code", field: "code", name: "工号", width: '100px', editable: false},
                {id: "real_name", field: "real_name", name: "姓名", width: '100px', editable: false},
                {id: "status", field: "status", name: "状态", width: '100px', editable: false,
                    decorator: function(cellData, rowId, rowIndex){
                        var result = "";
                        switch (cellData) {
                            case '0':
                                result = '<span style="color:red">停用</span>';
                                break;
                            case '1':
                                result = '正常';
                                break;
                        }
                        return result;
                    }},
                {id: "phone", field: "phone", name: "座机/分机", width: '100px', editable: false},
                {id: "mobile", field: "mobile", name: "手机", width: '100px', editable: false},
                {id: "email", field: "email", name: "Email", width: '100px', editable: false},
                {id: "birth", field: "birth", name: "生日", width: '100px', editable: false},
                {id: "address", field: "address", name: "地址", width: '240px', editable: false},
                {id: "create_at", field: "create_at", name: "创建时间", width: '220px', editable: false},
                {id: "update_at", field: "update_at", name: "修改时间", width: '220px', editable: false},

            ];

            // 查询form内容
            var queryFormContent = '<div data-dojo-type="dojox/form/Manager" id="admin_user_query_form"  data-dojo-id="admin_user_query_form">'
                    + '<div data-dojo-type="dojox/layout/TableContainer" data-dojo-props="labelWidth:80, cols:4, width:800, customClass:\'labelsAndValues\'">'
                    + '<div data-dojo-type="dijit/form/TextBox" style="width: 100px"  data-dojo-props="name:\'code\'" title="工号:"></div>'
                    + '<div data-dojo-type="dijit/form/TextBox" style="width: 100px" data-dojo-props="name:\'realName\'" title="姓名:"></div>'
                    + '</div></div>';

            createCommonIndex({
                // 页面相关设置
                menuId: menuId,
                title: addTitle,
                listUrl: listUrl,
                infoUrl: infoUrl,
                addUrl: addUrl,
                importUrl: importUrl,
                exportUrl: exportUrl,

                // 网格设置
                gridRenderId: gridRenderId,
                columnModel: columnModel,

                // 查询form设置
                queryFormId: queryFormId,
                queryFormContent: queryFormContent
            });
        }
    );
</script>