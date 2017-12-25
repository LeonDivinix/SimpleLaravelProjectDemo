<div id = "inventory_purchase_index_grid" style="height: 100%; width: 100%; margin:0; padding:0"></div>
<script>
    require(
        ["dojo/domReady!"],
        function(){
            var menuId = '<?php echo $menuId; ?>';
            var addTitle = "采购";
            var moduleName = "Purchase";
            var listUrl = "" + moduleName + "/list";
            var infoUrl = "" + moduleName + "/info";
            var addUrl = <?php echo $permission["addUrl"]; ?>;
            var updateUrl = <?php echo $permission["updateUrl"]; ?>;
            var copyUrl = <?php echo $permission["copyUrl"]; ?>;
            var importUrl = <?php echo $permission["importUrl"]; ?>;
            var exportUrl = <?php echo $permission["exportUrl"]; ?>;
            var gridRenderId = "inventory_purchase_index_grid";
            var queryFormId = "inventory_purchase_query_form";
            var operateWidth = "" == updateUrl ? '40px' : '90px';
            var columnModel = [
                {
                    id: GRID_OPERATE_COLUMN_ID, name: "操作", width: operateWidth, sortable: false,
                    formatter: function (rawData) {
                        var str = "";
                        if ("" != updateUrl) {
                            str += '<a href="#" onclick="toSingleEditTab(\'' + updateUrl + '?id=' + rawData["id"]
                                    + '\', \'修改采购\', \'' + menuId + '\');">修改</a>&nbsp;';
                        }
                        if ("" != copyUrl) {
                            str += '<a href="#" onclick="toSingleEditTab(\'' + copyUrl + '?id=' + rawData["id"]
                                    + '\', \'复制采购\', \'' + menuId + '\');">复制</a>';
                        }
                        return str;
                    }
                },
                {id: "id", field: "id", name: "id", width: "50px", editable: false},
                {id: "sequence", field: "sequence", name: "序号", width: "100px", editable: false},
                {id: "code", field: "code", name: "编号", width: "100px", editable: false},
                {id: "title", field: "title", name: "标题说明", width: "200px", editable: false},
                {id: "supplier", field: "supplier", name: "供应商", width: "200px", editable: false},
                {id: "supplier_linkman", field: "supplier_linkman", name: "联系人", width: "100px", editable: false},
                {id: "pay_status", field: "pay_status", name: "支付状态", width: "80px", editable: false,
                    decorator: function(cellData, rowId, rowIndex){
                        var result = "";
                        if (adminPayStatusJson.hasOwnProperty(cellData)) {
                            result = adminPayStatusJson[cellData];
                        }
                        return result;
                    }},
                {id: "receive_status", field: "receive_status", name: "到货状态", width: "80px", editable: false,
                    decorator: function(cellData, rowId, rowIndex){
                        var result = "";
                        if (adminReceiveStatusJson.hasOwnProperty(cellData)) {
                            result = adminReceiveStatusJson[cellData];
                        }
                        return result;
                    }},
                {id: "product_weight", field: "product_weight", name: "商品重量(kg)", width: "110px", editable: false},
                {id: "currency_unit", field: "currency_unit", name: "货币单位", width: "80px", editable: false,
                    decorator: function(cellData, rowId, rowIndex){
                        var result = "";
                        if (adminIndexCurrencyJson.hasOwnProperty(cellData)) {
                            result = adminIndexCurrencyJson[cellData];
                        }
                        return result;
                    }},
                {id: "buy_amount", field: "buy_amount", name: "商品金额", width: "110px", editable: false},
                {id: "buy_tax_amount", field: "buy_tax_amount", name: "消费税", width: "110px", editable: false},
                {id: "total_amount", field: "total_amount", name: "商品总额", width: "110px", editable: false},
                {id: "create_at", field: "create_at", name: "创建时间", width: "220px", editable: false},
                {id: "update_at", field: "update_at", name: "修改时间", width: "220px", editable: false}
            ];

            var queryFormContent = '<div data-dojo-type="dojox/form/Manager" id="inventory_purchase_query_form"  data-dojo-id="inventory_purchase_query_form">'
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
