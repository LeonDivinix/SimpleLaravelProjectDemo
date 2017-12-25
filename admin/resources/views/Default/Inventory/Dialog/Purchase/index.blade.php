<div id = "<?php echo $dialogId ?>_grid" style="height: 600px; width: 100%; margin:0; padding:0"></div>
<div style="text-align:center; padding-top: 10px">
    <button data-dojo-type="dijit/form/Button" onclick="fromDialog<?php echo $dialogId; ?>(GRID_PREFIX + '<?php echo $dialogId ?>_grid')" type="button">确定</button>
    <button data-dojo-type="dijit/form/Button" onclick="closeDialog('<?php echo $dialogId ?>');" type="button">关闭</button>
</div>
<script>
    require(
        ["dojo/domReady!"],
        function() {
            var moduleName = "PurchaseDialog"; // 模块名称
            var listUrl = moduleName + "/list"; // 获得列表链接
            var gridRenderId = "<?php echo $dialogId ?>_grid"; // 渲染grid的id
            var queryFormId = "<?php echo $dialogId ?>_query_form"; // 查询用form的id

            // grid列属性配置
            var columnModel = [
                {id: "id", field: "id", name: "id", width: "50px", editable: false},
                {id: "sequence", field: "sequence", name: "序号", width: "50px", editable: false},
                {id: "code", field: "code", name: "编号", width: "100px", editable: false},
                {id: "title", field: "title", name: "标题说明", width: "200px", editable: false},
                {id: "supplier", field: "supplier", name: "供应商", width: "65px", editable: false},
                {id: "currency_unit", field: "currency_unit", name: "货币单位", width: "80px", editable: false},
                {id: "buy_amount", field: "buy_amount", name: "预估金额", width: "100px", editable: false},
                {id: "product_weight", field: "product_weight", name: "商品重量KG", width: "80px", editable: false},
                {id: "status", field: "status", name: "状态", width: "50px", editable: false},
                {id: "pay_status", field: "pay_status", name: "支付状态", width: "80px", editable: false},
                {id: "receive_status", field: "receive_status", name: "到货状态", width: "80px", editable: false},
                {id: "create_at", field: "create_at", name: "创建时间", width: "220px", editable: false},
                {id: "update_at", field: "update_at", name: "修改时间", width: "220px", editable: false}
            ];

            // 查询form内容
            var queryFormContent = '<div data-dojo-type="dojox/form/Manager" id="<?php echo $dialogId ?>_query_form"  data-dojo-id="<?php echo $dialogId ?>_query_form">'
                + '<div data-dojo-type="dojox/layout/TableContainer" data-dojo-props="labelWidth:80, cols:4, width:800, customClass:\'labelsAndValues\'">'
                + '<div data-dojo-type="dijit/form/TextBox" style="width: 120px" data-dojo-props="trim:true,name:\'id\'" title="id:"></div>'
                + '<div data-dojo-type="dijit/form/TextBox" style="width: 120px" data-dojo-props="trim:true,name:\'name\'" title="名称:"></div>'
                + '<div data-dojo-type="dijit/form/TextBox" style="width: 120px" data-dojo-props="trim:true,name:\'type\'" title="分类id:"></div>'
                + '<div data-dojo-type="dijit/form/TextBox" style="width: 120px" data-dojo-props="trim:true,name:\'typeName\'" title="分类名称:"></div>'
                + '</div></div>';

            createSingleSelectGrid({
                // 页面相关设置
                listUrl: listUrl,

                // 网格设置
                gridRenderId: gridRenderId,
                columnModel: columnModel,

                // 查询form设置
                queryFormId: queryFormId,
                queryFormContent: queryFormContent
            });
        }
    );
    function fromDialog<?php echo $dialogId; ?>(id) {
        var dialogId= '<?php echo $dialogId ?>';
        var callback = '<?php echo $callback; ?>';
        var grid = dijit.byId(id);
        var sel = grid.select.row.getSelected();
        if (sel.length > 0) {
            var data = grid.row(sel).data();
            window[callback](data);
            closeDialog(dialogId);
        }
        else {
            Toast.error('请选择条目！');
        }
    }
</script>