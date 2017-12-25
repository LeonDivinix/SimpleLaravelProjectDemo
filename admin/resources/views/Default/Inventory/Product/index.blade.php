<div id = "inventory_i_product_index_grid" style="height: 100%; width: 100%; margin:0; padding:0"></div>
<script>
    require(
        ["dojo/domReady!"],
        function(){
            var menuId = '<?php echo $menuId; ?>';
            var addTitle = "商品模板";
            var moduleName = "Product";
            var listUrl = "" + moduleName + "/list";
            var infoUrl = "" + moduleName + "/info";
            var addUrl = <?php echo $permission["addUrl"]; ?>;
            var updateUrl = <?php echo $permission["updateUrl"]; ?>;
            var copyUrl = <?php echo $permission["copyUrl"]; ?>;
            var importUrl = <?php echo $permission["importUrl"]; ?>;
            var exportUrl = <?php echo $permission["exportUrl"]; ?>;
            var gridRenderId = "inventory_i_product_index_grid";
            var queryFormId = "inventory_i_product_query_form";
            var operateWidth = "" == updateUrl ? '40px' : '90px';
            var columnModel = [
                {
                    id: GRID_OPERATE_COLUMN_ID, name: "操作", width: operateWidth, sortable: false,
                    formatter: function (rawData) {
                        var str = "";
                        if ("" != updateUrl) {
                            str += '<a href="#" onclick="toSingleEditTab(\'' + updateUrl + '?id=' + rawData["id"]
                                    + '\', \'修改商品模板\', \'' + menuId + '\');">修改</a>&nbsp;';
                        }
                        if ("" != copyUrl) {
                            str += '<a href="#" onclick="toSingleEditTab(\'' + copyUrl + '?id=' + rawData["id"]
                                    + '\', \'复制商品模板\', \'' + menuId + '\');">复制</a>';
                        }
                        return str;
                    }
                },
                {id: "id", field: "id", name: "id", width: "50px", editable: false},
                {id: "code", field: "code", name: "编号", width: "100px", editable: false},
                {id: "commodity_codes", field: "commodity_codes", name: "条码", width: "110px", editable: false},
                {id: "name", field: "name", name: "名称", width: "200px", editable: false},
                {id: "brand_name", field: "brand_name", name: "品牌", width: "100px", editable: false},
                {id: "category_name", field: "category_name", name: "分类", width: "80px", editable: false},
                {id: "unit", field: "unit", name: "计量单位", width: "80px", editable: false,
                    decorator: function(cellData, rowId, rowIndex){
                        var result = "";
                        if (adminIndexProductUnitJson.hasOwnProperty(cellData)) {
                            result = adminIndexProductUnitJson[cellData];
                        }
                        return result;
                    }},
                {id: "pack", field: "pack", name: "规格描述", width: "100px", editable: false},
                {id: "currency_unit", field: "currency_unit", name: "货币单位", width: "80px", editable: false,
                    decorator: function(cellData, rowId, rowIndex){
                        var result = "";
                        if (adminIndexCurrencyJson.hasOwnProperty(cellData)) {
                            result = adminIndexCurrencyJson[cellData];
                        }
                        return result;
                    }},
                {id: "buy_price", field: "buy_price", name: "购买价", width: "65px", editable: false},
                {id: "buy_tax_rate", field: "buy_tax_rate", name: "消费税%", width: "65px", editable: false},
                {id: "buy_tax", field: "buy_tax", name: "消费税", width: "65px", editable: false},
                {id: "sold_rate", field: "sold_rate", name: "毛利率%", width: "65px", editable: false},
                {id: "weight_unit", field: "weight_unit", name: "重量单位", width: "80px", editable: false,
                    decorator: function(cellData, rowId, rowIndex){
                        var result = "";
                        if (adminIndexWeightJson.hasOwnProperty(cellData)) {
                            result = adminIndexWeightJson[cellData];
                        }
                        return result;
                    }},
                {id: "weight", field: "weight", name: "重量", width: "50px", editable: false},
                {id: "life", field: "life", name: "保质期(天)", width: "90px", editable: false},
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
                {id: "sort", field: "sort", name: "排序", width: "50px", editable: false},
                {id: "create_at", field: "create_at", name: "创建时间", width: "220px", editable: false},
                {id: "update_at", field: "update_at", name: "修改时间", width: "220px", editable: false}
            ];

            var queryFormContent = '<div data-dojo-type="dojox/form/Manager" id="inventory_i_product_query_form"  data-dojo-id="inventory_i_product_query_form">'
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
