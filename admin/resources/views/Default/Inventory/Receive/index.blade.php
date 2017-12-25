<div id = "inventory_i_receive_index_grid" style="height: 100%; width: 100%; margin:0; padding:0"></div>
<script>
    require(
            ["dojo/domReady!"],
            function(){
                var menuId = '<?php echo $menuId; ?>';
                var addTitle = "到货";
                var moduleName = "Receive";
                var listUrl = "" + moduleName + "/list";
                var infoUrl = "" + moduleName + "/info";
                var addUrl = <?php echo $permission["addUrl"]; ?>;
                var updateUrl = <?php echo $permission["updateUrl"]; ?>;
                var copyUrl = <?php echo $permission["copyUrl"]; ?>;
                var importUrl = <?php echo $permission["importUrl"]; ?>;
                var exportUrl = <?php echo $permission["exportUrl"]; ?>;
                var gridRenderId = "inventory_i_receive_index_grid";
                var queryFormId = "inventory_i_receive_query_form";
                var operateWidth = "" == updateUrl ? '90px' : '120px';
                var columnModel = [
                    {
                        id: GRID_OPERATE_COLUMN_ID, name: "操作", width: "100px", sortable: false,
                        formatter: function (rowData) {
                            var str = "";
                            if ("" != updateUrl) {
                                str += '<a href="#" onclick="toSingleEditTab(\'' + updateUrl + '?id=' + rowData["id"]
                                        + '\', \'修改到货\', \'' + menuId + '\');">修改</a>&nbsp;';
                            }
                            if (99 != rowData["status"]) {
                                str += '&nbsp;<a href="#" onclick="i_receiveToInventory(\'' + rowData["id"] + '\');">入库</a>';
                            }
                            return str;
                        }
                    },
                    {id: "id", field: "id", name: "id", width: "50px", editable: false},
                    {id: "sequence", field: "sequence", name: "序号", width: "50px", editable: false},
                    {id: "code", field: "code", name: "到货单编号", width: "95px", editable: false},
                    {id: "purchase_code", field: "purchase_code", name: "采购单编号", width: "95px", editable: false},
                    {id: "title", field: "title", name: "标题说明", width: "80px", editable: false},
                    {id: "supplier", field: "supplier", name: "供应商", width: "65px", editable: false},
                    {id: "currency_unit", field: "currency_unit", name: "货币单位", width: "80px", editable: false,
                        decorator: function(cellData, rowId, rowIndex){
                            var result = "";
                            if (adminIndexCurrencyJson.hasOwnProperty(cellData)) {
                                result = adminIndexCurrencyJson[cellData];
                            }
                            return result;
                        }},
                    {id: "buy_amount", field: "buy_amount", name: "商品金额", width: "80px", editable: false},
                    {id: "express_amount", field: "express_amount", name: "快递费用", width: "80px", editable: false},
                    {id: "buy_tax_amount", field: "buy_tax_amount", name: "消费税金额", width: "95px", editable: false},
                    {id: "total_amount", field: "total_amount", name: "总金额", width: "65px", editable: false},
                    {id: "weight_unit", field: "weight_unit", name: "重量单位", width: "80px", editable: false,
                        decorator: function(cellData, rowId, rowIndex){
                            var result = "";
                            if (adminIndexWeightJson.hasOwnProperty(cellData)) {
                                result = adminIndexWeightJson[cellData];
                            }
                            return result;
                        }},
                    {id: "product_weight", field: "product_weight", name: "商品重量", width: "80px", editable: false},
                    {id: "express_weight", field: "express_weight", name: "快递包装重量", width: "110px", editable: false},
                    {id: "total_weight", field: "total_weight", name: "总重量", width: "65px", editable: false},
                    {id: "express_company", field: "express_company", name: "快递公司", width: "80px", editable: false,
                        decorator: function(cellData){
                            var result = "";
                            if (adminExpressCompanyJson.hasOwnProperty(cellData)) {
                                result = adminExpressCompanyJson[cellData];
                            }
                            return result;
                        }},
                    {id: "express_code", field: "express_code", name: "快递单号", width: "80px", editable: false},
                    {id: "status", field: "status", name: "状态", width: "50px", editable: false,
                        decorator: function(cellData, rowId, rowIndex){
                            var result = "";
                            switch (cellData) {
                                case 0:
                                    result = '初始';
                                    break;
                                case 99:
                                    result = '已入库';
                                    break;
                            }
                            return result;
                        }},
                    {id: "create_at", field: "create_at", name: "创建时间", width: "220px", editable: false}
                ];

                var queryFormContent = '<div data-dojo-type="dojox/form/Manager" id="inventory_i_receive_query_form"  data-dojo-id="inventory_i_receive_query_form">'
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
<script>
    function i_receiveToInventory(receiveId) {
        if (confirm("入库后将进入库存，同时生成采购订单，并且到货记录将不能修改。您确定吗？")) {
            progressDialog.show();
            request(
                "/Receive/toInventory",
                {
                    handleAs: "json",
                    method: "Post",
                    timeout: 300000,
                    data: {id: receiveId}
                }
            ).then(
                function(json) {
                    progressDialog.hide();
                    if (0 === json.flag) {
                        Toast.message("入库成功，并生成采购订单");
                        dijit.byId(buildGridId("<?php echo $menuId; ?>")).filter.refresh();
                    }
                    else if (999 == json.flag) {
                        location.href = json.message;
                    }
                    else {
                        Toast.error(json.message);
                    }
                },
                function(err){
                    //
                }
            );
        }
    }
</script>