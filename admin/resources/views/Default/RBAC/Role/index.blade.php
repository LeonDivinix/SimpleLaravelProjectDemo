<div id = "admin_role_index_grid" style="height: 100%; width: 100%; margin:0; padding:0"></div>
<script>
    require(
        ["dojo/domReady!"],
        function() {
            var menuId = '<?php echo $menuId; ?>'; // 菜单id
            var addTitle = "角色"; // 编辑界面标题
            var moduleName = "Role"; // 模块名称
            var listUrl = moduleName + "/list"; // 获得列表链接
            var infoUrl = moduleName + "/info";
            var gridRenderId = "admin_role_index_grid"; // 渲染grid的id
            var queryFormId = "admin_role_query_form"; // 查询用form的id

            var addUrl = <?php echo $permission["addUrl"]; ?>;
            var updateUrl = <?php echo $permission["updateUrl"]; ?>;
            var copyUrl = <?php echo $permission["copyUrl"]; ?>;
            var importUrl = <?php echo $permission["importUrl"]; ?>;
            var exportUrl = <?php echo $permission["exportUrl"]; ?>;

            var operateWidth = "" == updateUrl ? '40px' : '90px';
            // grid列属性配置
            var columnModel = [
                {
                    id: GRID_OPERATE_COLUMN_ID, name: "操作", width: operateWidth, sortable: false,
                    formatter: function (rawData) {
                        var str = "";
                        if ("" != updateUrl) {
                            str += '<a href="#" onclick="toSingleEditTab(\'' + updateUrl + '?id=' + rawData["id"]
                                    + '\', \'修改角色\', \'' + menuId + '\');">修改</a>&nbsp;';
                        }
                        if ("" != copyUrl) {
                            str += '<a href="#" onclick="toSingleEditTab(\'' + copyUrl + '?id=' + rawData["id"]
                                    + '\', \'复制角色\', \'' + menuId + '\');">复制</a>';
                        }
                        return str;
                    }
                },
                {id: "id", field: "id", name: "ID", width: '290px', sortable: false, editable: false},
                {id: "title", field: "title", name: "标题", width: '80px', editable: false},
                {id: "sort", field: "sort", name: "排序", width: '100px', editable: false},
                {id: "status", field: "status", name: "状态", width: '60px', editable: false,
                    decorator: function(cellData, rowId, rowIndex){
                        return cellData == 1 ? '开启' : '关闭';
                    }},
                {id: "remark", field: "remark", name: "备注", width: '400px', sortable: false, editable: false},
                {id: "create_at", field: "create_at", name: "创建时间", width: '220px',  editable: false},
                {id: "update_at", field: "update_at", name: "修改时间", width: '220px',  editable: false}

            ];

            // 查询form内容
            var queryFormContent = '<div data-dojo-type="dojox/form/Manager" id="admin_role_query_form"  data-dojo-id="admin_role_query_form">'
                    + '<div data-dojo-type="dojox/layout/TableContainer" data-dojo-props="labelWidth:80, cols:4, width:800, customClass:\'labelsAndValues\'">'
                    + '<div data-dojo-type="dijit/form/TextBox" style="width: 100px"  data-dojo-props="name:\'title\'" title="标题:"></div>'
                    + '<div data-dojo-type="dijit/form/Select" style="width: 100px" data-dojo-props="trim:true,name:\'status\'" title="状态:"><option value="">请选择</option><option value="1">开启</option><option value="0">关闭</option></div>'
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