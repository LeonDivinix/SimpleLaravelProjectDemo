<div id = "inventory_i_supplier_index_grid" style="height: 100%; width: 100%; margin:0; padding:0"></div>
<script>
    require(
            ["dojo/domReady!"],
            function(){
                var menuId = '<?php echo $menuId; ?>';
                var addTitle = "供应商";
                var moduleName = "Supplier";
                var listUrl = "" + moduleName + "/list";
                var infoUrl = "" + moduleName + "/info";
                var addUrl = <?php echo $permission["addUrl"]; ?>;
                var updateUrl = <?php echo $permission["updateUrl"]; ?>;
                var copyUrl = <?php echo $permission["copyUrl"]; ?>;
                var importUrl = <?php echo $permission["importUrl"]; ?>;
                var exportUrl = <?php echo $permission["exportUrl"]; ?>;
                var gridRenderId = "inventory_i_supplier_index_grid";
                var queryFormId = "inventory_i_supplier_query_form";
                var operateWidth = "" == updateUrl ? '40px' : '90px';
                var columnModel = [
                    {
                        id: GRID_OPERATE_COLUMN_ID, name: "操作", width: operateWidth, sortable: false,
                        formatter: function (rawData) {
                            var str = "";
                            if ("" != updateUrl) {
                                str += '<a href="#" onclick="toSingleEditTab(\'' + updateUrl + '?id=' + rawData["id"]
                                        + '\', \'修改供应商\', \'' + menuId + '\');">修改</a>&nbsp;';
                            }
                            if ("" != copyUrl) {
                                str += '<a href="#" onclick="toSingleEditTab(\'' + copyUrl + '?id=' + rawData["id"]
                                        + '\', \'复制供应商\', \'' + menuId + '\');">复制</a>';
                            }
                            return str;
                        }
                    },
                    {id: "id", field: "id", name: "id", width: "200px", editable: false},
                    {id: "code", field: "code", name: "编号", width: "100px", editable: false},
                    {id: "name", field: "name", name: "名称", width: "200px", editable: false},
                    {id: "short_name", field: "short_name", name: "简称", width: "100px", editable: false},
                    {id: "type", field: "type", name: "类型", width: "50px", editable: false,
                        decorator: function(cellData, rowId, rowIndex){
                            var result = "";
                            switch (cellData) {
                                case 0:
                                    result = '个人';
                                    break;
                                case 1:
                                    result = '公司';
                                    break;
                            }
                            return result;
                        }},
                    {id: "status", field: "status", name: "状态", width: "50px", editable: false,
                        decorator: function(cellData, rowId, rowIndex){
                            var result = "";
                            switch (cellData) {
                                case 0:
                                    result = '关闭';
                                    break;
                                case 1:
                                    result = '开启';
                                    break;
                            }
                            return result;
                        }},
                    {id: "linkman", field: "linkman", name: "联系人", width: "100px", editable: false},
                    {id: "mobile", field: "mobile", name: "手机", width: "120px", editable: false},
                    {id: "phone", field: "phone", name: "电话", width: "120px", editable: false},
                    {id: "email", field: "email", name: "email", width: "200px", editable: false},
                    {id: "wechat", field: "wechat", name: "微信", width: "120px", editable: false},
                    {id: "alipay", field: "alipay", name: "支付宝", width: "120px", editable: false},
                    {id: "account", field: "account", name: "账户", width: "120px", editable: false},
                    {id: "bank", field: "bank", name: "开户行", width: "200px", editable: false},
                    {id: "address", field: "address", name: "地址", width: "200px", editable: false}
                ];

                var queryFormContent = '<div data-dojo-type="dojox/form/Manager" id="inventory_i_supplier_query_form"  data-dojo-id="inventory_i_supplier_query_form">'
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
