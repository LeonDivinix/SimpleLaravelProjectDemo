<div id = "inventory_i_consumer_index_grid" style="height: 100%; width: 100%; margin:0; padding:0"></div>
<script>
    require(
        ["dojo/domReady!"],
        function(){
            var menuId = '<?php echo $menuId; ?>';
            var addTitle = "客户";
            var moduleName = "Consumer";
            var listUrl = "" + moduleName + "/list";
            var infoUrl = "" + moduleName + "/info";
            var addUrl = <?php echo $permission["addUrl"]; ?>;
            var updateUrl = <?php echo $permission["updateUrl"]; ?>;
            var copyUrl = <?php echo $permission["copyUrl"]; ?>;
            var importUrl = <?php echo $permission["importUrl"]; ?>;
            var exportUrl = <?php echo $permission["exportUrl"]; ?>;
            var gridRenderId = "inventory_i_consumer_index_grid";
            var queryFormId = "inventory_i_consumer_query_form";
            var operateWidth = "" == updateUrl ? '40px' : '90px';
            var columnModel = [
                {
                    id: GRID_OPERATE_COLUMN_ID, name: "操作", width: operateWidth, sortable: false,
                    formatter: function (rawData) {
                        var str = "";
                        if ("" != updateUrl) {
                            str += '<a href="#" onclick="toSingleEditTab(\'' + updateUrl + '?id=' + rawData["id"]
                                    + '\', \'修改客户\', \'' + menuId + '\');">修改</a>&nbsp;';
                        }
                        if ("" != copyUrl) {
                            str += '<a href="#" onclick="toSingleEditTab(\'' + copyUrl + '?id=' + rawData["id"]
                                    + '\', \'复制客户\', \'' + menuId + '\');">复制</a>';
                        }
                        return str;
                    }
                },
                {id: "id", field: "id", name: "id", width: "50px", editable: false},
                {id: "sequence", field: "sequence", name: "序号", width: "50px", editable: false},
                {id: "code", field: "code", name: "编号", width: "50px", editable: false},
                {id: "name", field: "name", name: "姓名", width: "50px", editable: false},
                {id: "mobile", field: "mobile", name: "手机", width: "50px", editable: false},
                {id: "phone", field: "phone", name: "电话", width: "50px", editable: false},
                {id: "email", field: "email", name: "email", width: "95px", editable: false},
                {id: "qq", field: "qq", name: "qq", width: "50px", editable: false},
                {id: "wechat", field: "wechat", name: "微信", width: "50px", editable: false},
                {id: "gender", field: "gender", name: "性别", width: "50px", editable: false},
                {id: "birthday", field: "birthday", name: "生日", width: "50px", editable: false},
                {id: "province", field: "province", name: "省", width: "50px", editable: false},
                {id: "city", field: "city", name: "市", width: "50px", editable: false},
                {id: "area", field: "area", name: "地区", width: "50px", editable: false},
                {id: "address", field: "address", name: "地址", width: "50px", editable: false},
                {id: "post_code", field: "post_code", name: "邮编", width: "50px", editable: false},
                {id: "status", field: "status", name: "状态", width: "50px", editable: false},
                {id: "is_del", field: "is_del", name: "是否删除", width: "80px", editable: false,
                decorator: function(cellData, rowId, rowIndex){
                    var result = "";
                    switch (cellData) {
                        case '0':
                            result = '否';
                            break;
                        case '1':
                            result = '是';
                            break;
                    }
                    return result;
                }},
            ];

            var queryFormContent = '<div data-dojo-type="dojox/form/Manager" id="inventory_i_consumer_query_form"  data-dojo-id="inventory_i_consumer_query_form">'
                + '<div data-dojo-type="dojox/layout/TableContainer" data-dojo-props="labelWidth:80, cols:4, width:800, customClass:\'labelsAndValues\'">'
                + '<div data-dojo-type="dijit/form/TextBox" style="width: 100px"  data-dojo-props="trim:true,name:\'title\'" title="标题:"></div>'
                + '<div data-dojo-type="dijit/form/Select" style="width: 120px" data-dojo-props="trim:true,name:\'status\'" title="状态:"><option value="">请选择</option><option value="1">开启</option><option value="0">关闭</option></div>'
                + '</div></div>';

            createCommonIndex({
                menuId: menuId,
                title: addTitle,
                listUrl: listUrl,
                infoUrl: infoUrl,
                addUrl: addUrl,
                importUrl: importUrl,
                exportUrl: exportUrl,
                gridRenderId: gridRenderId,
                columnModel: columnModel,
                queryFormId: queryFormId,
                queryFormContent: queryFormContent,
                customFunc: "",
                customTitle: ""
            });
        }
    );
</script>
