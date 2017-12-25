<div data-dojo-type="dijit/layout/BorderContainer" style="width: 100%; height: 100%;" data-dojo-props="gutters:false">
    <div data-dojo-type="dijit/layout/ContentPane" region="center">
        <form data-dojo-type="dojox/form/Manager" action="Purchase/save" method="post"
        id="inventory_purchase_edit_form" data-dojo-id="inventory_purchase_edit_form">
            <input type="hidden" name="id" value="<?php echo $obj['id']; ?>" />
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
            <input type="hidden" name="operate" value="<?php echo $operate; ?>"/>

            <fieldset style="width: 800px" data-dojo-type="dijit/Fieldset">
                <legend></legend>
                <table border="0">
                    <tr style="display: none;">
                        <td>状态：</td>
                        <td>
                            <select name="status" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                                <option value="6" <?php if (6 === $obj['status']) echo 'selected="selected"'; ?> >已审核</option>
                                <option value="0" >初始</option>
                                <option value="1" <?php if (1 === $obj['status']) echo 'selected="selected"'; ?> >初始</option>
                                <option value="5" <?php if (5 === $obj['status']) echo 'selected="selected"'; ?> >待审核</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>是否删除：</td>
                        <td>
                            <select name="is_del" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                                <option value="0" >否</option>
                                <option value="1" <?php if (1 === $obj['is_del']) echo 'selected="selected"'; ?> >是</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </fieldset>

            <fieldset style="width: 800px" data-dojo-type="dijit/Fieldset">
            <legend></legend>
            <table border="0">
                <tr>
                    <td>供应商：</td>
                    <td>
                        <select name="supplier_id" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                            <option value="">请选择</option>
                            <?php foreach($obj["supplierMap"] as $k => $v) { ?>
                            <option value="<?php echo $k; ?>" <?php if (!empty($obj["supplier_id"]) && $k === $obj['supplier_id']) echo 'selected="selected"'; ?>><?php echo $v; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>货币单位：</td>
                    <td>
                        <select id="purchase_edit_currency_unit" name="currency_unit" data-dojo-type="dijit/form/Select"
                            onchange="resetPurchaseProductDialog(this.value)"
                            data-dojo-props="required:true">
                            <?php foreach (\Library\Constant\BusinessConstant::$CURRENCY as $k => $v) { ?>
                            <option value="<?php echo $k; ?>" <?php if ($k === $obj['currency_unit']) echo 'selected="selected"'; ?> >
                                <?php echo $v; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="width: 80px">编号：</td>
                    <td>
                        <input type="text" name="code" value="<?php echo $obj['code']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:36"/>
                    </td>
                </tr>
                <tr>
                    <td>标题：</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $obj['title']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:50"/>
                    </td>
                </tr>
                <tr>
                    <td>备注：</td>
                    <td>
                        <textarea name="remark" data-dojo-type="dijit/form/Textarea" cols="27"
                        data-dojo-props="required:true,trim:true,maxLength:200"><?php echo $obj['remark']; ?></textarea>
                    </td>
                </tr>
            </table>
            </fieldset>
            <input type="hidden" id="inventory_purchase_detail" name="purchase_detail">
        </form>
        <div style="height: 400px; width: 1300px; padding-top: 10px;">
            <div id = "purchase_detail_edit" style="height: 100%; width: 100%;"></div>
        </div>
    </div>
    <div id="purchase_edit_detail_dialog" data-dojo-id="purchase_edit_detail_dialog"
         data-dojo-type="dojox/widget/DialogSimple" title="明细编辑">
        <?php echo $detailForm; ?>
    </div>
    <div id="purchase_product_dialog_container">
    <div id="purchase_product_dialog" data-dojo-id="purchase_product_dialog" data-dojo-type="dojox/widget/DialogSimple"
         title="商品选择"
         href="ProductDialog?currencyUnit=<?php echo empty($obj['currency_unit']) ? 1 : $obj['currency_unit']; ?>&callback=purchaseProductCallback&dialogId=purchase_product_dialog"></div>
    </div>

    <div data-dojo-type="dijit/layout/ContentPane" region="bottom">
        <div style="text-align:center">
            <button data-dojo-type="dijit/form/Button" type="button"
                onclick="submitPurchaseInfo('inventory_purchase_edit_form')">保存</button>
            <button data-dojo-type="dijit/form/Button" style="padding-left: 50px;" type="button"
                    onclick="closeSingleEditTab();">关闭</button>
        </div>
    </div>
</div>
<script>
    // 更新税 税率变
    function refreshPurchaseBuyTax() {
        var p = dijit.byId("purchase_detail_product_buy_price").get("value");
        var t = dijit.byId("purchase_detail_product_buy_tax_rate").get("value");
        if (!isNaN(p) && !isNaN(t)) {
            dijit.byId("purchase_detail_product_buy_tax").set("value", p * t * 0.01);
            var n = dijit.byId("purchase_detail_purchase_number").get("value");
            if (!isNaN(n)) {
                t = p * t * n * 0.01;
                dijit.byId("purchase_detail_product_buy_tax_amount").set("value", t);
                dijit.byId("purchase_detail_purchase_amount").set("value", p * n + t);
            }
        }
    }

    // 更新商品金额 价格变
    function refreshPurchaseBuyAmount() {
        var p = dijit.byId("purchase_detail_product_buy_price").get("value");
        var n = dijit.byId("purchase_detail_purchase_number").get("value");
        if (!isNaN(p) && !isNaN(n)) {
            dijit.byId("purchase_detail_product_buy_amount").set("value", p * n);

        }
        refreshPurchaseBuyTax();
    }

    // 数量变
    function refreshPurchaseDetailTotal() {
        var number = dijit.byId("purchase_detail_purchase_number").get("value");
        var totalWeight = dijit.byId("purchase_detail_purchase_weight");
        var weight = dijit.byId("purchase_detail_product_weight").get("value");
        if (!isNaN(number) || !isNaN(weight)) {
            totalWeight.set("value", weight * number);
        }
        refreshPurchaseBuyAmount();
    }

    function submitPurchaseInfo(formId) {
        var grid = dijit.byId('detail_edit_grid');
        var data = grid.store.data;
        var validCount = data.length;

        if (validCount < 1) {
            Toast.error("请配置明细项");
            return;
        }
        dojoDom.byId("inventory_purchase_detail").value = dojoJson.stringify(data);
        submitFormData(formId)
    }

</script>
<script>
    function savePurchaseDetailData(formId) {
        var form = dijit.byId(formId);

        if (undefined != form && form.validate()) {
            var grid = dijit.byId("detail_edit_grid");
            var operate = dojoDom.byId('detail_edit_operate').value;
            patchPurchaseDetailInfo();
            var saveData = form.gatherFormValues();
            saveData.id = dojoDom.byId('detail_edit_id').value;
            var store = grid.store;
            if (operate == 1) { // 修改
                dojoDom.byId('detail_edit_id').value = "";
                store.put(saveData, {overwrite: true});
            }
            else {
                if (operate == 3) { // 复制
                    saveData.sequence = "";
                }
                store.add(saveData);
                initToolBarButton();
                closePurchaseDetailDialog(formId);
            }
            purchase_edit_detail_dialog.hide();
        }
    }

    function closePurchaseDetailDialog(formId) {
        resetEditDetailDialogInfo(formId);
        purchase_edit_detail_dialog.hide();
    }

    function resetEditDetailDialogInfo(formId) {
        dijit.byId(formId).reset();
        last_purchase_product_code = "";
        destroyPurchaseProductInfo();
    }
</script>
<script>
    var purchase_detail_temp_id = 10000;
    // 用于相同code，避免重复更新
    var last_purchase_product_code = "";
    // 图片复选按钮做单选控制数组
    var purchaseDetailProductImageCheckBoxIds = [];

    function purchaseProductCallback(data) {
        if (undefined != data.code) {
            getPurchaseProductByCode(data.code)
        }
    }

    function getPurchaseProductByCode(code) {
        if (code != last_purchase_product_code && code != "") {
            var data = "";
            if (arguments.length > 1) {
                data = arguments[1];
            }
            request(
                RootDomainUrl + "Product/getInfoByCode?code=" + code,
                {
                    handleAs: "json",
                    method: "get",
                    timeout: 30000
                }
            ).then(
                function (json) {
                    if (json.flag == 0) {
                        var fields = ["id", "code", "name", "e_name", "commodity_codes", "buy_price", "buy_tax_rate", "category_name", "category_id",
                            "buy_tax", "brand_name", "brand_id", "unit", "pack", "weight_unit", "weight", "currency_unit", "life"];
                        var len = fields.length;
                        for (var i = 0; i < len; ++i) {
                            dijit.byId("purchase_detail_product_" + fields[i]).set("value", json.result[fields[i]]);
                        }
                        last_purchase_product_code = code;
                        refreshPurchaseDetailTotal();
                        destroyPurchaseProductInfo();

                        buildPurchaseProductImages(json.result.images);

                        if ("" != data) {
                            if (data["product_image_id"] > 0) {
                                dijit.byId("purchase_detail_product_image_" + data["product_image_id"]).set("checked", true);
                            }
                            if ("" != data["product_attribute"]) {
                                var haveAttr = strToJson(data["product_attribute"]);
                                len = json.result.attributes.length;
                                for (i = 0; i < len; ++i) {
                                    if (undefined != haveAttr[json.result.attributes[i].id]) {
                                        json.result.attributes[i].checked = true;
                                    }
                                }
                            }
                        }
                        buildPurchaseProductTree(json.result.attributes);
                    }
                    else {
                        Toast.error(json.message);
                    }
                }
            );
        }
    }
    function showPurchaseProductDialog() {
        dijit.byId('purchase_product_dialog').show();
    }

    function resetPurchaseProductDialog(value) {
        dijit.byId("purchase_product_dialog").set("href",
            "ProductDialog?currencyUnit=" + value + '&callback=purchaseProductCallback&dialogId=purchase_product_dialog');
    }

    function buildPurchaseProductTree(data) {
        if (data.length > 0) {
            require([
                "dojo/store/Memory",
                "dojo/store/Observable",
                "cbtree/model/TreeStoreModel",
                "cbtree/Tree"
            ],
            function (Memory, Observable, ObjectStoreModel, Tree) {
                appendElement("<div id='purchase_detail_product_attribute_div'></div>", "purchase_detail_product_attribute_container");
                var dataStore = new Memory({
                    data: data
                });
                var myStore = new Observable(dataStore);
                var myModel = new ObjectStoreModel({
                    store: myStore,
                    labelAttr: "name",
                    query: {level: 0},
                    attachToForm: {
                        checked: ["mixed", true],
                        name: "checkboxes"
                    },
                    checkedRoot: true
                });
                var tree = new Tree({
                    id: "purchase_detail_product_attribute_tree",
                    model: myModel,
                    autoExpand: true
                }, "purchase_detail_product_attribute_div");
                tree.startup();
            });
        }
    }


    function buildPurchaseProductImages(data) {
        var url = "<?php echo config('filesystems.product.imageurl'); ?>";
        var len = data.length;
        for (var i = 0; i < len; ++i) {
            appendElement(
                '<input data-dojo-type="dijit/form/CheckBox" id="purchase_detail_product_image_' + data[i].id
                + '" name="product_image_' + data[i].id + '" value="'
                + data[i].id
                + '" onChange="onPurchaseProductImageChange(this)" />' +
                "<a href='" + url + data[i].name + "' target='_blank'><img src='" + url + data[i].name + "' width=36 /></a>",
                "purchase_detail_product_image_div");
            purchaseDetailProductImageCheckBoxIds.push(data[i].id);
        }
        parser.parse("purchase_detail_product_image_div");

    }

    function destroyPurchaseProductInfo() {
        var len = purchaseDetailProductImageCheckBoxIds.length;
        for (var i = 0; i < len; ++i) {
            dijit.byId("purchase_detail_product_image_" + purchaseDetailProductImageCheckBoxIds[i]).destroyRecursive();
        }
        dojoDom.byId("purchase_detail_product_image_div").innerHTML = "";
        var tree = dijit.byId("purchase_detail_product_attribute_tree");
        if (undefined != tree) {
            tree.destroyRecursive();
        }
        dojoDom.byId("purchase_detail_product_attribute_container").innerHTML = "";
        purchaseDetailProductImageCheckBoxIds = [];
    }

    function onPurchaseProductImageChange(cb) {
        var id = cb.id;
        var value = dijit.byId(id).get('value');
        if (value) {
            var len = purchaseDetailProductImageCheckBoxIds.length;
            for (var i = 0; i < len; ++i) {
                if (id != ("purchase_detail_product_image_" + purchaseDetailProductImageCheckBoxIds[i])) {
                    dijit.byId("purchase_detail_product_image_" + purchaseDetailProductImageCheckBoxIds[i]).set("value", false);
                }
            }
        }
    }

    function patchPurchaseDetailInfo() {
        len = purchaseDetailProductImageCheckBoxIds.length;
        for (var i = 0; i < len; ++i) {
            value = dijit.byId("purchase_detail_product_image_" + purchaseDetailProductImageCheckBoxIds[i]).get('value');
            if (value) {
                dijit.byId("purchase_detail_product_image_id").set("value", value);
                break;
            }
        }
        var checkedAttribute = getCBTreeCheckedMap("purchase_detail_product_attribute_tree", 2);
        dijit.byId("purchase_detail_product_attribute").set("value", dojoJson.stringify(checkedAttribute));
    }
</script>
<script>
    function initToolBarButton() {
        var grid = dijit.byId('detail_edit_grid');
        var validCount = grid.store.data.length;

        if (validCount == 0) {
            dijitShowWidget("detail_add_button");
            dijitHideWidget("detail_edit_button");
            dijitHideWidget("detail_copy_button");
//            dijitHideWidget("detail_delete_button");
        }
        else {
            dijitShowWidget("detail_add_button");
            dijitShowWidget("detail_edit_button");
            dijitShowWidget("detail_copy_button");
//            dijitShowWidget("detail_delete_button");
        }
    }

    function initDetailEditInfo(data) {
        var tmp;
        var operate = dojoDom.byId('detail_edit_operate').value;
        for (var n in data) {
            if (data.hasOwnProperty(n)) {
                tmp = dijit.byId("purchase_detail_" + n);
                if (undefined != tmp && (operate != 3 || n != "id")) {
                    tmp.set("value", data[n]);
                }
            }
        }
        getPurchaseProductByCode(data["product_code"], data);
    }

    // 创建单选Grid
    function createEditSelectGrid(tabConfig) {
        require([
            "dojo/store/Memory",
            'dijit/Toolbar',
            'dijit/form/Button',
            'dijit/TooltipDialog',
            "gridx/Grid",
            "gridx/core/model/cache/Async",
            "gridx/modules/ColumnResizer",
            "gridx/modules/Filter",
            "gridx/modules/Pagination",
            "gridx/modules/pagination/PaginationBar",
            "gridx/modules/SingleSort",
            'gridx/support/LinkPager',
            'gridx/support/Summary',
            'gridx/support/GotoPageButton',
            "gridx/modules/Bar",
            'gridx/modules/select/Row',
            "gridx/modules/HiddenColumns",
            'dojo/ready'
        ],
        function(
            Store,
            Toolbar,
            Button,
            TooltipDialog,
            Grid,
            cache,
            ColumnResizer,
            Filter,
            Pagination,
            PaginationBar,
            SingleSort,
            LinkPager,
            Summary,
            GotoPageButton,
            Bar,
            SelectRow,
            HiddenColumns,
            ready
        ) {
            // 构建操作工具栏
            var gridTopBar = new Toolbar({});
            gridTopBar.addChild(new Button({
                id: "detail_add_button",
                label: "增加",
                style: "display: none",
                iconClass: "dijitCommonIcon dijitIconNewTask",
                onClick: function () {
                    // 上一次操作是增加则不重置
                    if (1 != dojoDom.byId('detail_edit_operate').value) {
                        resetEditDetailDialogInfo(("detail_edit_form"));
                        initToolBarButton();
                    }
                    dojoDom.byId('detail_edit_id').value = ++purchase_detail_temp_id;
                    dojoDom.byId('detail_edit_operate').value = 2;
                    purchase_edit_detail_dialog.show();
                }
            }));
            gridTopBar.addChild(new Button({
                id: "detail_edit_button",
                label: "修改",
                style: "display: none",
                iconClass: "dijitCommonIcon dijitIconEditTask",
                onClick: function () {
                    var isSel = grid.select.row.getSelected() != "";
                    if (isSel) {
                        resetEditDetailDialogInfo("detail_edit_form");
                        dojoDom.byId('detail_edit_operate').value = 1;
                        var sel = grid.select.row.getSelected();
                        var data = grid.store.get(sel);
                        dojoDom.byId('detail_edit_id').value = data.id;
                        initDetailEditInfo(data);
                        purchase_edit_detail_dialog.show();
                    }
                    else {
                        Toast.error("请选择数据行！")
                    }
                }
            }));
            gridTopBar.addChild(new Button({
                id: "detail_copy_button",
                label: "复制",
                style: "display: none",
                iconClass: "dijitCommonIcon dijitIconCopy",
                onClick: function () {
                    var isSel = grid.select.row.getSelected() != "";
                    if (isSel) {
                        resetEditDetailDialogInfo("detail_edit_form");
                        dojoDom.byId('detail_edit_operate').value = 3;
                        var copySel = grid.select.row.getSelected();
                        var copyData = grid.store.get(copySel);
                        dojoDom.byId('detail_edit_id').value = ++purchase_detail_temp_id;
                        initDetailEditInfo(copyData);
                        purchase_edit_detail_dialog.show();
                    }
                    else {
                        Toast.error("请选择数据行！")
                    }
                }
            }));
            <?php if (empty($obj['id'])) { ?>
            gridTopBar.addChild(new Button({
                id: "detail_delete_button",
                label: "删除",
                style: "display: none",
                iconClass: "admin_del_icon",
                onClick: function () {
                    var isSel = grid.select.row.getSelected() != "";
                    if (isSel) {
                        var sel = grid.select.row.getSelected();
                        var data = grid.row(sel).data();
                        if (confirm("您确定删除id为" + data.id + "的数据吗？")) {
                            grid.store.remove(data.id);
                            initToolBarButton();
                        }
                    }
                    else {
                        Toast.error("请选择数据行！")
                    }
                }
            }));
            <?php } ?>

            var gridData = <?php echo empty($obj["detail_list"]) ? "[]" : json_encode($obj["detail_list"]); ?>;
            var store = new Store({data: gridData});
            // 构建grid
            var grid = new Grid({
                id : "detail_edit_grid",
                store:  store,
                cacheClass: cache,
                onRowDblClick :function(obj){
                    resetEditDetailDialogInfo("detail_edit_form");
                    dojoDom.byId('detail_edit_operate').value = 1;
                    var sel = grid.select.row.getSelected();
                    var data = grid.store.get(sel);
                    dojoDom.byId('detail_edit_id').value = data.id;
                    initDetailEditInfo(data);
                    purchase_edit_detail_dialog.show();
                },
                structure: tabConfig.columnModel,
                selectRowTriggerOnCell: true,
                modules: [
                    SelectRow,
                    ColumnResizer,
                    Bar,
                    SingleSort,
                    HiddenColumns,
                    Pagination
                ],
                barTop: [
                    gridTopBar
                ],
                barBottom: [
                    [
                        {pluginClass: Summary, showRange:true, style: 'width:300px'}
                    ]
                ]
            });

            grid.placeAt(tabConfig.gridRenderId);
            grid.startup();
            grid.hiddenColumns.add("id");
            // 1增加 2修改 3复制
            ready(function(){
                initToolBarButton();
            });
        });
    }

    // grid列属性配置
    var editColumnModel = [
        {id: "id", field: "id", name: "id", width: "100px", editable: false},
        {id: "product_code", field: "product_code", name: "商品编号", width: "100px", editable: false},
        {id: "product_commodity_codes", field: "product_commodity_codes", name: "条码", width: "110px", editable: false},
        {id: "product_brand_name", field: "product_brand_name", name: "品牌", width: "80px", editable: false},
        {id: "product_category_name", field: "product_category_name", name: "分类", width: "80px", editable: false},
        {id: "product_name", field: "product_name", name: "名称", width: "140px", editable: false},
        {id: "purchase_number", field: "purchase_number", name: "采购数量", width: "70px", editable: false},
        {id: "product_buy_price", field: "product_buy_price", name: "购买价", width: "80px", editable: false},
        {id: "product_buy_tax_rate", field: "product_buy_tax_rate", name: "消费税率%", width: "80px", editable: false},
        {id: "product_buy_amount", field: "product_buy_amount", name: "商品金额", width: "80px", editable: false},
        {id: "product_buy_tax", field: "product_buy_tax_amount", name: "消费税", width: "80px", editable: false},
        {id: "purchase_amount", field: "purchase_amount", name: " 总金额", width: "110px", editable: false},
        {id: "product_weight_unit", field: "product_weight_unit", name: "重量单位", width: "60px", editable: false},
        {id: "purchase_weight", field: "purchase_weight", name: "预估重量", width: "110px", editable: false},
        {id: "product_unit", field: "product_unit", name: "计量单位", width: "60px", editable: false},
        {id: "product_pack", field: "product_pack", name: "规格", width: "200px", editable: false},
        {id: "is_del", field: "is_del", name: "是否删除", width: "80px", editable: false,
            decorator: function(cellData, rowId, rowIndex){
                var result = "";
                switch (cellData) {
                    case '0':
                        result = '否';
                        break;
                    case '1':
                        result = '<span style="color: red">是</span>';
                        break;
                }
                return result;
            }}
    ];

    // 创建grid
    createEditSelectGrid({
        // 网格设置
        gridRenderId: "purchase_detail_edit",
        columnModel: editColumnModel
    });
</script>
