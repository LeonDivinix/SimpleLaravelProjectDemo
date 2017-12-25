<div id = "inventory_i_sold_index_grid" style="height: 100%; width: 100%; margin:0; padding:0"></div>
<script>
    require(
        ["dojo/domReady!"],
        function(){
            var menuId = '<?php echo $menuId; ?>';
            var addTitle = "销售";
            var moduleName = "Sold";
            var listUrl = "" + moduleName + "/list";
            var infoUrl = "" + moduleName + "/info";
            var addUrl = <?php echo $permission["addUrl"]; ?>;
            var updateUrl = <?php echo $permission["updateUrl"]; ?>;
            var copyUrl = <?php echo $permission["copyUrl"]; ?>;
            var importUrl = <?php echo $permission["importUrl"]; ?>;
            var exportUrl = <?php echo $permission["exportUrl"]; ?>;
            var gridRenderId = "inventory_i_sold_index_grid";
            var queryFormId = "inventory_i_sold_query_form";
            var operateWidth = "" == updateUrl ? '40px' : '90px';
            var columnModel = [
                {
                    id: GRID_OPERATE_COLUMN_ID, name: "操作", width: operateWidth, sortable: false,
                    formatter: function (rawData) {
                        var str = "";
                        if ("" != updateUrl) {
                            str += '<a href="#" onclick="toSingleEditTab(\'' + updateUrl + '?id=' + rawData["id"]
                                    + '\', \'修改销售\', \'' + menuId + '\');">修改</a>&nbsp;';
                        }
                        if ("" != copyUrl) {
                            str += '<a href="#" onclick="toSingleEditTab(\'' + copyUrl + '?id=' + rawData["id"]
                                    + '\', \'复制销售\', \'' + menuId + '\');">复制</a>';
                        }
                        return str;
                    }
                },
                {id: "id", field: "id", name: "id", width: "50px", editable: false},
                {id: "sequence", field: "sequence", name: "序号", width: "50px", editable: false},
                {id: "code", field: "code", name: "编号", width: "50px", editable: false},
                {id: "cost", field: "cost", name: "成本金额", width: "80px", editable: false},
                {id: "amount", field: "amount", name: "商品金额", width: "80px", editable: false},
                {id: "express_amount", field: "express_amount", name: "快递金额", width: "80px", editable: false},
                {id: "tax_amount", field: "tax_amount", name: "税金额", width: "65px", editable: false},
                {id: "total_amount", field: "total_amount", name: "总金额", width: "65px", editable: false},
                {id: "express_flag", field: "express_flag", name: "是否包邮", width: "80px", editable: false},
                {id: "profit", field: "profit", name: "毛利", width: "50px", editable: false},
                {id: "total_weight", field: "total_weight", name: "总重量", width: "65px", editable: false},
                {id: "consumer_id", field: "consumer_id", name: "客户id", width: "80px", editable: false},
                {id: "express_pic", field: "express_pic", name: "快递图片留存", width: "110px", editable: false},
                {id: "address", field: "address", name: "客户地址", width: "80px", editable: false},
                {id: "contact", field: "contact", name: "客户联系方式", width: "110px", editable: false},
                {id: "status", field: "status", name: "状态", width: "50px", editable: false,
                decorator: function(cellData, rowId, rowIndex){
                    var result = "";
                    switch (cellData) {
                        case '0':
                            result = '初始';
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
                {id: "create_at", field: "create_at", name: "创建时间", width: "80px", editable: false},
                {id: "create_by", field: "create_by", name: "创建人", width: "65px", editable: false},
                {id: "update_at", field: "update_at", name: "修改时间", width: "80px", editable: false},
                {id: "update_by", field: "update_by", name: "修改人", width: "65px", editable: false},
            ];

            var queryFormContent = '<div data-dojo-type="dojox/form/Manager" id="inventory_i_sold_query_form"  data-dojo-id="inventory_i_sold_query_form">'
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
