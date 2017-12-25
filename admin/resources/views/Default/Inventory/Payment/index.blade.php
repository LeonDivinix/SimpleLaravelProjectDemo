<div id = "inventory_i_payment_index_grid" style="height: 100%; width: 100%; margin:0; padding:0"></div>
<script>
    require(
        ["dojo/domReady!"],
        function(){
            var menuId = '<?php echo $menuId; ?>';
            var addTitle = "支付";
            var moduleName = "Payment";
            var listUrl = "" + moduleName + "/list";
            var infoUrl = "" + moduleName + "/info";
            var addUrl = <?php echo $permission["addUrl"]; ?>;
            var updateUrl = <?php echo $permission["updateUrl"]; ?>;
            var copyUrl = <?php echo $permission["copyUrl"]; ?>;
            var importUrl = <?php echo $permission["importUrl"]; ?>;
            var exportUrl = <?php echo $permission["exportUrl"]; ?>;
            var gridRenderId = "inventory_i_payment_index_grid";
            var queryFormId = "inventory_i_payment_query_form";
            var operateWidth = "" == updateUrl ? '40px' : '90px';
            var columnModel = [
                {
                    id: GRID_OPERATE_COLUMN_ID, name: "操作", width: operateWidth, sortable: false,
                    formatter: function (rawData) {
                        var str = "";
                        if ("" != updateUrl) {
                            str += '<a href="#" onclick="toSingleEditTab(\'' + updateUrl + '?id=' + rawData["id"]
                                    + '\', \'修改支付\', \'' + menuId + '\');">修改</a>&nbsp;';
                        }
                        if ("" != copyUrl) {
                            str += '<a href="#" onclick="toSingleEditTab(\'' + copyUrl + '?id=' + rawData["id"]
                                    + '\', \'复制支付\', \'' + menuId + '\');">复制</a>';
                        }
                        return str;
                    }
                },
                {id: "id", field: "id", name: "id", width: "50px", editable: false},
                {id: "sequence", field: "sequence", name: "序号", width: "50px", editable: false},
                {id: "purchase_order_id", field: "purchase_order_id", name: "采购订单号", width: "95px", editable: false},
                {id: "pay_type", field: "pay_type", name: "支付方式", width: "80px", editable: false},
                {id: "pay", field: "pay", name: "支付", width: "50px", editable: false},
                {id: "serial_number", field: "serial_number", name: "流水号", width: "65px", editable: false},
                {id: "image", field: "image", name: "留存图片", width: "80px", editable: false},
                {id: "create_time", field: "create_time", name: "create_time", width: "185px", editable: false},
                {id: "create_by", field: "create_by", name: "create_by", width: "155px", editable: false},
            ];

            var queryFormContent = '<div data-dojo-type="dojox/form/Manager" id="inventory_i_payment_query_form"  data-dojo-id="inventory_i_payment_query_form">'
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
