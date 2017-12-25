<div id = "inventory_i_inventory_index_grid" style="height: 100%; width: 100%; margin:0; padding:0"></div>
<script>
    require(
        ["dojo/domReady!"],
        function(){
            var menuId = '<?php echo $menuId; ?>';
            var addTitle = "库存";
            var moduleName = "Inventory";
            var listUrl = "" + moduleName + "/list";
            var infoUrl = "" + moduleName + "/info";
            var addUrl = <?php echo $permission["addUrl"]; ?>;
            var updateUrl = <?php echo $permission["updateUrl"]; ?>;
            var copyUrl = <?php echo $permission["copyUrl"]; ?>;
            var importUrl = <?php echo $permission["importUrl"]; ?>;
            var exportUrl = <?php echo $permission["exportUrl"]; ?>;
            var gridRenderId = "inventory_i_inventory_index_grid";
            var queryFormId = "inventory_i_inventory_query_form";
            var operateWidth = "" == updateUrl ? '40px' : '90px';
            var columnModel = [
                {
                    id: GRID_OPERATE_COLUMN_ID, name: "操作", width: operateWidth, sortable: false,
                    formatter: function (rawData) {
                        var str = "";
                        return str;
                    }
                },
                {id: "id", field: "id", name: "id", width: "50px", editable: false},
                {id: "sequence", field: "sequence", name: "序号", width: "50px", editable: false},
                {id: "purchase_code", field: "purchase_code", name: "采购编号", width: "80px", editable: false},
                {id: "receive_code", field: "receive_code", name: "到货编号", width: "80px", editable: false},
                {id: "product_code", field: "product_code", name: "商品编号", width: "100px", editable: false},
                {id: "product_commodity_codes", field: "product_commodity_codes", name: "条码", width: "110px", editable: false},
                {id: "product_name", field: "product_name", name: "名称", width: "200px", editable: false},
                {id: "product_brand_name", field: "product_brand_name", name: "品牌", width: "80px", editable: false},
                {id: "product_category_name", field: "product_category_name", name: "分类", width: "80px", editable: false},
                {id: "product_attribute", field: "product_attribute", name: "属性", width: "200px", editable: false,
                    decorator: function(cellData, rowId, rowIndex){
                        return implode(dojoJson.parse(cellData), " ");
                    }},
                {id: "product_unit", field: "product_unit", name: "计量单位", width: "80px", editable: false,
                    decorator: function(cellData, rowId, rowIndex){
                        var result = "";
                        var json = <?php echo json_encode(\Library\Constant\BusinessConstant::$PRODUCT_UNIT); ?>;
                        if (json.hasOwnProperty(cellData)) {
                            result = json[cellData];
                        }
                        return result;
                    }},
                {id: "num", field: "num", name: "商品数量", width: "80px", editable: false},
                {id: "product_weight_unit", field: "product_weight_unit", name: "重量单位", width: "80px", editable: false},
                {id: "product_weight", field: "product_weight", name: "重量", width: "50px", editable: false},
                {id: "weight", field: "weight", name: "商品总重量", width: "95px", editable: false},
                {id: "total_weight", field: "total_weight", name: "合计总重量", width: "95px", editable: false},
                {id: "product_currency_unit", field: "product_currency_unit", name: "货币单位", width: "80px", editable: false},
                {id: "product_buy_price", field: "product_buy_price", name: "商品购买价", width: "95px", editable: false},
                {id: "product_buy_tax_rate", field: "product_buy_tax_rate", name: "消费税率", width: "80px", editable: false},
                {id: "product_buy_tax", field: "product_buy_tax", name: "消费税", width: "65px", editable: false},
                {id: "express_price", field: "express_price", name: "折算快递费", width: "110px", editable: false},
                {id: "cost", field: "cost", name: "成本价", width: "65px", editable: false},
                {id: "total_amount", field: "total_amount", name: "成本总金额", width: "95px", editable: false},
                {id: "exchange_rate", field: "exchange_rate", name: "汇率", width: "50px", editable: false,
                    decorator: function(cellData, rowId, rowIndex){
                        return '<span style="color: blue">' + cellData + '</span>';
                    }},
                {id: "cost_local", field: "cost_local", name: "成本价¥", width: "70px", editable: false,
                    decorator: function(cellData, rowId, rowIndex){
                        return '<span style="color: blue">' + cellData + '</span>';
                    }},
                {id: "total_amount_local", field: "total_amount_local", name: "成本总金额¥", width: "100px", editable: false,
                    decorator: function(cellData, rowId, rowIndex){
                        return '<span style="color: blue">' + cellData + '</span>';
                    }},
                {id: "product_pack", field: "product_pack", name: "规格", width: "300px", editable: false},
                {id: "product_image", field: "product_image", name: "图片", width: "50px", editable: false},
                {id: "product_life", field: "product_life", name: "保质期", width: "65px", editable: false},
                {id: "product_date", field: "product_date", name: "生产日期", width: "90px", editable: false},
                {id: "status", field: "status", name: "状态", width: "50px", editable: false,
                decorator: function(cellData, rowId, rowIndex){
                    var result = "";
                    switch (cellData) {
                        case 0:
                            result = '初始';
                            break;
                        case 99:
                            result = '已标价';
                            break;
                    }
                    return result;
                }},
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
                {id: "create_at", field: "create_at", name: "创建时间", width: "220px", editable: false},
                {id: "update_at", field: "update_at", name: "修改时间", width: "220px", editable: false}
            ];

            var queryFormContent = '<div data-dojo-type="dojox/form/Manager" id="inventory_i_inventory_query_form"  data-dojo-id="inventory_i_inventory_query_form">'
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
