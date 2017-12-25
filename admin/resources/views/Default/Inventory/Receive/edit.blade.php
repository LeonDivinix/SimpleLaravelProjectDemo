<div data-dojo-type="dijit/layout/BorderContainer" style="width: 100%; height: 100%;" data-dojo-props="gutters:false">
    <div data-dojo-type="dijit/layout/ContentPane" region="center">
        <form data-dojo-type="dojox/form/Manager" action="Receive/save" method="post"
              id="i_receive_edit_form" data-dojo-id="i_receive_edit_form">
            <input type="hidden" name="id" value="<?php echo $obj['id']; ?>" />
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
            <input type="hidden" name="operate" value="<?php echo $operate; ?>"/>
            <table border="0">
                <tr>
                    <td valign="top">
                        <fieldset style="width: 400px" data-dojo-type="dijit/Fieldset">
                            <legend></legend>
                            <table border="0">
                                <tr>
                                    <td>采购编号：</td>
                                    <td>
                                        <input type="text" name="purchase_code"
                                               value="<?php echo $obj['purchase_code']; ?>"
                                               onblur="getPurchaseInfo()"
                                               id="i_receive_purchase_code"
                                               style="width: 250px"
                                               data-dojo-type="dijit/form/ValidationTextBox"
                                               data-dojo-props="required:true,trim:true,maxLength:36"/>
                                        <input style="display: none" type="text" name="purchase_id"
                                               value="<?php echo $obj['purchase_id']; ?>"
                                               id="i_receive_purchase_id"
                                               data-dojo-type="dijit/form/TextBox"/>
                                        <input  type="text" name="purchase_sequence"
                                                style="display: none"
                                               value="<?php echo $obj['purchase_sequence']; ?>"
                                               id="i_receive_purchase_sequence"
                                               data-dojo-type="dijit/form/TextBox"/>
                                        <button data-dojo-type="dijit/form/Button" type="button"
                                                onclick="i_receive_purchase_sel_dialog.show();">选择</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>快递公司：</td>
                                    <td>
                                        <select name="express_company" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                                            <option value="">请选择</option>
                                            <?php foreach (\Library\Constant\BusinessConstant::$EXPRESS_COMPANY as $k => $v) { ?>
                                            <option value="<?php echo $k; ?>" <?php if ($k == $obj['express_company']) echo 'selected="selected"'; ?> >
                                                <?php echo $v; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>重量单位：</td>
                                    <td>
                                        <select name="weight_unit" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                                            <option value="">请选择</option>
                                            <?php foreach (\Library\Constant\BusinessConstant::$WEIGHT as $k => $v) { ?>
                                            <option value="<?php echo $k; ?>" <?php if ($k == $obj['weight_unit']) echo 'selected="selected"'; ?> >
                                                <?php echo $v; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>留存图片：</td>
                                    <td>
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <input style="width: 235px" type="text"
                                                           id="i_receive_edit_image" name="image"
                                                           onblur="changeArticleImage(this);"
                                                           value="<?php echo isset($obj['image']) ? $obj['image'] : ""; ?>"
                                                           data-dojo-type="dijit/form/ValidationTextBox"
                                                           data-dojo-props="required:true,trim:true,maxLength:50" />
                                                </td>
                                                <td>
                                                    <div id="i_receive_edit_image_sel" class="admin_uploadBtn">选择图片</div>
                                                </td>
                                            </tr>
                                        </table>

                                        <div id="i_receive_edit_image_div" style="padding-top: 2px;">
                                            <?php
                                            $receiveImageHeader = \Library\Helper\ImageHelper::getReceiveImageUrl();
                                            if (!empty($obj['image'])) {
                                                $receiveImageUrl = $receiveImageHeader . $obj['image'];
                                                echo "<a href='" . $receiveImageUrl . "' target='_blank'><img src='"
                                                        . $receiveImageUrl . "' height=40 /></a>";
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>快递单号：</td>
                                    <td>
                                        <input type="text" name="express_code" value="<?php echo $obj['express_code']; ?>"
                                               style="width: 300px" data-dojo-type="dijit/form/ValidationTextBox"
                                               data-dojo-props="required:true,trim:true,maxLength:36"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>快递费用：</td>
                                    <td>
                                        <input type="text" name="express_amount" value="<?php echo $obj['express_amount']; ?>"
                                               style="width: 300px" data-dojo-type="dijit/form/NumberTextBox"
                                               data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:0,max:999999999.99}'/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>总重量：</td>
                                    <td>
                                        <input type="text" name="total_weight" value="<?php echo $obj['total_weight']; ?>"
                                               style="width: 300px" data-dojo-type="dijit/form/NumberTextBox"
                                               data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:0,max:999999999.99}'/>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        <fieldset style="width: 400px" data-dojo-type="dijit/Fieldset">
                            <legend></legend>
                            <table border="0">
                                <tr>
                                    <td>到货编号：</td>
                                    <td>
                                        <input type="text" name="code" value="<?php echo $obj['code']; ?>"
                                               style="width: 300px" data-dojo-type="dijit/form/ValidationTextBox"
                                               data-dojo-props="required:true,trim:true,maxLength:36"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>标题说明：</td>
                                    <td>
                                        <input type="text" name="title" value="<?php echo $obj['title']; ?>"
                                               style="width: 300px" data-dojo-type="dijit/form/ValidationTextBox"
                                               data-dojo-props="required:true,trim:true,maxLength:50"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>备注：</td>
                                    <td>
                                        <input type="text" name="remark" value="<?php echo $obj['remark']; ?>"
                                               data-dojo-type="dijit/form/Textarea"
                                               data-dojo-props="required:true,trim:true,maxLength:200"/>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>
                    <td valign="top">
                        <fieldset data-dojo-type="dijit/Fieldset">
                            <legend></legend>
                            <table border="0">
                                <tr>
                                    <td>采购日期：</td>
                                    <td>
                                        <input disabled type="text" id="i_receive_edit_purchase_date" name="purchase_date"
                                               value="<?php if(!empty($obj['purchase_date'])) echo $obj['purchase_date']; ?>"
                                               data-dojo-type="dijit/form/TextBox"
                                               data-dojo-props='required:true,trim:true'/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>供应商：</td>
                                    <td>
                                        <input disabled type="text" id="i_receive_edit_supplier"
                                            name="supplier"
                                            value="<?php if(!empty($obj['supplier'])) echo $obj['supplier']; ?>"
                                            data-dojo-type="dijit/form/ValidationTextBox"
                                            data-dojo-props="required:true,trim:true"/>
                                        <input type="text" id="i_receive_edit_supplier_id"
                                               style="display: none"
                                               name="supplier_id" value="<?php echo $obj['supplier_id']; ?>"
                                               data-dojo-type="dijit/form/ValidationTextBox"
                                               data-dojo-props="required:true,trim:true"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>联系人：</td>
                                    <td>
                                        <input disabled type="text" id="i_receive_edit_supplier_linkman"
                                               name="supplier_linkman" value="<?php echo $obj['supplier_linkman']; ?>"
                                               data-dojo-type="dijit/form/ValidationTextBox"
                                               data-dojo-props="required:true,trim:true"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>供应商手机：</td>
                                    <td>
                                        <input disabled type="text" id="i_receive_edit_supplier_mobile"
                                               name="supplier_mobile" value="<?php echo $obj['supplier_mobile']; ?>"
                                               data-dojo-type="dijit/form/ValidationTextBox"
                                               data-dojo-props="required:true,trim:true"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>供应商电话：</td>
                                    <td>
                                        <input disabled type="text" id="i_receive_edit_supplier_phone"
                                               name="supplier_phone" value="<?php echo $obj['supplier_phone']; ?>"
                                               data-dojo-type="dijit/form/ValidationTextBox"
                                               data-dojo-props="required:true,trim:true"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>货币单位：</td>
                                    <td>
                                        <select disabled name="currency_unit" id="i_receive_edit_currency_unit"
                                            data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                                            <option value="">请选择</option>
                                            <?php foreach (\Library\Constant\BusinessConstant::$CURRENCY as $k => $v) { ?>
                                            <option value="<?php echo $k; ?>" <?php if ($k == $obj['currency_unit']) echo 'selected="selected"'; ?> >
                                                <?php echo $v; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="receive_detail_info" id="i_receive_edit_receive_detail_info">
        </form>
        <fieldset style="width: 1000px;" data-dojo-type="dijit/Fieldset">
            <legend>采购详情</legend>
            <table class="grid_info_table">
                <thead>
                <tr>
                    <th>&nbsp;序号&nbsp;</th>
                    <th>&nbsp;商品编号&nbsp;</th>
                    <th>&nbsp;条码&nbsp;</th>
                    <th>&nbsp;商品名称&nbsp;</th>
                    <th>&nbsp;外文名&nbsp;</th>
                    <th>&nbsp;属性&nbsp;</th>
                    <th>&nbsp;采购数量&nbsp;</th>
                    <th>&nbsp;已到数量&nbsp;</th>
                    <th>&nbsp;本次操作数量&nbsp;</th>
                    <th>&nbsp;未到数量&nbsp;</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="i_receive_from_purchase_tbody">
                <?php
                    if (!empty($purchaseDetailList)) { foreach ($purchaseDetailList as $v) {
                        $tmpThisRemain = empty($currentChangeNumberMap[$v["id"]]) ?
                                ($v["purchase_number"] - $v["receive_number"]) : ($v["purchase_number"] - $v["receive_number"] - $currentChangeNumberMap[$v["id"]]);
                ?>
                <tr>
                    <td><?php echo $v["sequence"]; ?></td>
                    <td><?php echo $v["product_code"]; ?></td>
                    <td><?php echo $v["product_commodity_codes"]; ?></td>
                    <td><?php echo $v["product_name"]; ?></td>
                    <td><?php echo $v["product_e_name"]; ?></td>
                    <td><?php echo implode(" ", json_decode($v["product_attribute"], true)); ?></td>
                    <td><?php echo $v["purchase_number"]; ?></td>
                    <td><?php echo $v["receive_number"]; ?></td>
                    <td><span id="i_receive_from_purchase_current_num_<?php echo $v["id"]; ?>"><?php echo empty($currentChangeNumberMap[$v["id"]]) ? 0 : $currentChangeNumberMap[$v["id"]]; ?></span></td>
                    <td><span id="i_receive_from_purchase_remain_num_<?php echo $v["id"]; ?>"><?php echo $tmpThisRemain; ?></span></td>
                    <td>
                        <button data-dojo-type="dijit/form/Button"
                            onclick="addReceiveDetailDialogData('<?php echo $v["id"];  ?>');i_receive_detail_edit_dialog.show();"
                            type="button" id="i_receive_from_purchase_button_<?php echo $v["id"]; ?>"
                            <?php if ($tmpThisRemain <= 0) echo "disabled"; ?>
                            data-dojo-props="iconClass:'admin_add_icon', showLabel: false"></button>
                    </td>
                </tr>
                <?php }} ?>
                </tbody>
            </table>
            <div id="i_receive_edit_receive_detail_div">
            </div>
        </fieldset>
        <div style="padding-top: 10px;">到货明细：</div>
        <div style="height: 400px; width: 1300px;">
            <div id = "receive_detail_edit" style="height: 100%; width: 100%;"></div>
        </div>
        <div id="i_receive_purchase_sel_dialog" data-dojo-id="i_receive_purchase_sel_dialog" title="采购单选择"
             data-dojo-type="dojox/widget/DialogSimple" data-dojo-props="style: 'width:1000px;height:700px;'"
             href="PurchaseDialog?callback=onPurchaseSelCallback&dialogId=i_receive_purchase_sel_dialog">
        </div>
        <div id="i_receive_detail_edit_dialog" data-dojo-id="i_receive_detail_edit_dialog" style="width: 900px; height: 700px;"
             data-dojo-type="dojox/widget/DialogSimple" title="到货明细编辑">
            <?php echo $detailForm; ?>
        </div>
    </div>
    <div data-dojo-type="dijit/layout/ContentPane" region="bottom">
        <div style="text-align:center">
            <button data-dojo-type="dijit/form/Button" onclick="submitReceiveEditData('i_receive_edit_form')" type="button">保存</button>
            <button data-dojo-type="dijit/form/Button" style="padding-left: 50px;" onclick="closeSingleEditTab();"
                type="button">关闭</button>
        </div>
    </div>
</div>
<script> /** 选择采购单 **/
    // 上一次查询的采购单code
    var lastPurchaseCode = "";
    // 记录商品的当前变化数量 明细id:数量
    var currentChangeNumberMap = <?php echo empty($currentChangeNumberMap) ? "{}" : json_encode($currentChangeNumberMap); ?>;
    // 详情数据
    var purchaseDetailMap = <?php echo empty($purchaseDetailList) ? "{}" : json_encode($purchaseDetailList); ?>;
    // 详情id(新增模拟用)
    var receiveDetailIdIndex = 0;
    // 图片复选按钮做单选控制数组
    var receiveDetailProductImageCheckBoxIds = [];
</script>

<script> /** 复用函数 **/
    function resetAllReceiveData() {
        if (lastPurchaseCode != "") {
            currentChangeNumberMap = {};
        }
        purchaseDetailMap = {};
        receiveDetailProductImageCheckBoxIds = [];
        dojoDom.byId("i_receive_from_purchase_tbody").innerHTML = "";
    }
</script>
<script> /** 选择采购单 **/

    // dialog选择回调
    function onPurchaseSelCallback(data) {
        dijit.byId("i_receive_purchase_code").set("value", data.code);
        dijit.byId("i_receive_purchase_id").set("value", data.id);
        getPurchaseInfo();
    }

    // onblur及回调调用
    function getPurchaseInfo() {
        var purchaseCode = dijit.byId("i_receive_purchase_code").get("value");
        var purchaseId = dijit.byId("i_receive_purchase_id").get("value");
        if ("" != purchaseCode && (purchaseId == "" || purchaseCode != lastPurchaseCode)) {
            progressDialog.show();
            request(
                    RootDomainUrl + "Purchase/getInfoByCode?code=" + purchaseCode,
                    {
                        handleAs: "json",
                        method: "get",
                        timeout: 30000
                    }
            ).then(
                    function (json) {
                        progressDialog.hide();
                        if (0 === json.flag) {
                            resetAllReceiveData();
                            buildPurchaseInfo(json.result);
                            lastPurchaseCode = purchaseCode;
                        }
                        else if (999 == json.flag) {
                            location.href = json.message;
                        }
                        else {
                            Toast.error(json.message);
                        }
                    },
                    function (error) {
                        Toast.error(error);
                    }
            );
        }
    }

    // 根据采购信息构建到货信息 及 待到货列表视图
    function buildPurchaseInfo(data) {
        // 填充主表信息
        dijit.byId("i_receive_edit_currency_unit").set("value", data.currency_unit);
        dijit.byId("i_receive_edit_supplier").set("value", data.supplier);
        dijit.byId("i_receive_edit_supplier_id").set("value", data.supplier_id);
        dijit.byId("i_receive_edit_supplier_linkman").set("value", data.supplier_linkman);
        dijit.byId("i_receive_edit_supplier_mobile").set("value", data.supplier_mobile);
        dijit.byId("i_receive_edit_supplier_phone").set("value", data.supplier_phone);
        dijit.byId("i_receive_edit_purchase_date").set("value", data.create_at);
        dijit.byId("i_receive_purchase_id").set("value", data.id);
        dijit.byId("i_receive_purchase_sequence").set("value", data.sequence);

        // 生成采购明细信息
        var node = "";
        var len = data.detail_list.length;
        var id;
        var tmp;
        var disabled;
        var currentNum;
        var remainNum;
        var productAttribute;
        for (var i = 0; i < len; ++i) {
            purchaseDetailMap[data.detail_list[i].id] = data.detail_list[i];
            disabled = "";
            currentNum = 0;
            if (undefined != currentChangeNumberMap[data.detail_list[i].id]) {
                currentNum = currentChangeNumberMap[data.detail_list[i].id];
            }
            remainNum = data.detail_list[i].purchase_number - data.detail_list[i].receive_number - currentNum;
            if (remainNum == 0) {
                disabled = "disabled";
            }

            if (data.detail_list[i].remain_number == 0) {
                disabled = "disabled";
            }
            else if (undefined != currentChangeNumberMap[data.detail_list[i].id]
                    && data.detail_list[i].remain_number - currentChangeNumberMap[data.detail_list[i].id] == 0) {
                disabled = "disabled";
            }

            id = data.detail_list[i].id;
            tmp = dijit.byId('i_receive_from_purchase_button_' + id);
            if (undefined != tmp) {
                tmp.destroyRecursive();
            }
            productAttribute = implode(dojoJson.parse(data.detail_list[i].product_attribute), " ");
            node +=
                    '<tr>' +
                    '<td>' + data.detail_list[i].sequence + '</td>' +
                    '<td>' + data.detail_list[i].product_code + '</td>' +
                    '<td>' + data.detail_list[i].product_commodity_codes + '</td>' +
                    '<td>' + data.detail_list[i].product_name + '</td>' +
                    '<td>' + data.detail_list[i].product_e_name + '</td>' +
                    '<td>' + productAttribute + '</td>' +
                    '<td>' + data.detail_list[i].purchase_number + '</td>' +
                    '<td>' + data.detail_list[i].receive_number + '</td>' +
                    '<td><span id="i_receive_from_purchase_current_num_' + id + '">' + currentNum +
                    '</span></td>' +
                    '<td><span id="i_receive_from_purchase_remain_num_' + id + '">' + remainNum +
                    '</span></td>' +
                    '<td><button data-dojo-type="dijit/form/Button" onclick="addReceiveDetailDialogData(\'' +
                    data.detail_list[i].id + '\'); i_receive_detail_edit_dialog.show();"' +
                    ' type="button" ' + disabled +
                    ' id="i_receive_from_purchase_button_' + id + '"' +
                    ' data-dojo-props="iconClass:\'admin_add_icon\', showLabel: false"></button>' +
                    '</td>' +
                    '</tr>';
        }
        dojoDom.byId("i_receive_from_purchase_tbody").innerHTML = node;
        parser.parse('i_receive_from_purchase_tbody');
    }
</script>

<script> /** 入库项目操作 **/
    //
    function addReceiveDetailDialogData(id) {
        if (undefined != purchaseDetailMap[id]) {
            var convertInfo = {};
            for (var n in purchaseDetailMap[id]) {
                if (purchaseDetailMap[id].hasOwnProperty(n)) {
                    convertInfo[n] = purchaseDetailMap[id][n];
                }
            }
            convertInfo.purchase_detail_sequence = purchaseDetailMap[id].sequence;
            convertInfo.sequence = "";
            convertInfo.purchase_detail_id = purchaseDetailMap[id].id;
            convertInfo.id = --receiveDetailIdIndex;
            initReceiveDetailDialogData(convertInfo);
            dojoDom.byId('detail_edit_operate').value = 2; // 增加
        }
    }

    // 初始化明细编辑对话框
    function initReceiveDetailDialogData(data) {
        destroyReceiveProductInfo();
        var tmpObj;
        for (var n in data) {
            if (data.hasOwnProperty(n) && n != "product_buy_amount" && n != "product_buy_tax_amount") {
                tmpObj = dijit.byId("receive_detail_" + n);
                if (undefined != tmpObj) {
                    tmpObj.set("value", data[n])
                }
            }
        }
        initProductInfo(data.product_code, data);
    }

    // 销毁对象
    function destroyReceiveProductInfo() {
        var len = receiveDetailProductImageCheckBoxIds.length;
        for (var i = 0; i < len; ++i) {
            dijit.byId("receive_detail_product_image_" + receiveDetailProductImageCheckBoxIds[i]).destroyRecursive();
        }
        dojoDom.byId("receive_detail_product_image_div").innerHTML = "";
        var tree = dijit.byId("receive_detail_product_attribute_tree");
        if (undefined != tree) {
            tree.destroyRecursive();
        }
        dojoDom.byId("receive_detail_product_attribute_container").innerHTML = "";
        receiveDetailProductImageCheckBoxIds = [];
        dijit.byId("receive_detail_edit_form").reset();
    }

    // 初始化到货商品信息
    function initProductInfo(code) {
        if (code != "") {
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
                        if ("" != data) {
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
                        buildReceiveProductAttributeTree(json.result.attributes);
                        buildReceiveProductImages(json.result.images);
                        if (data["product_image_id"] > 0) {
                            dijit.byId("receive_detail_product_image_" + data["product_image_id"]).set("checked", true);
                        }
                    }
                    else {
                        Toast.error(json.message);
                    }
                }
            );
        }
    }
</script>
<script> /** 保存到货明细信息 **/
    function saveReceiveDetailData(formId) {
        var form = dijit.byId(formId);
        if (undefined != form && form.validate()) {
            var grid = dijit.byId("detail_edit_grid");
            var operate = dojoDom.byId('detail_edit_operate').value;
            patchReceiveDetailInfo();
            var saveData = form.gatherFormValues();
            var store = grid.store;
            var rNum = parseInt(dojoDom.byId("i_receive_from_purchase_remain_num_" + saveData.purchase_detail_id).innerHTML);
            if (operate == 1) { // 修改
                var old = store.get(saveData.id);
                var offset = saveData.num - old.num;
                if (offset > rNum) {
                    Toast.error("到货数量不能超过" + (old.num + rNum));
                    return false;
                }
                else if (offset == rNum) {
                    dijitDisabledWidget("i_receive_from_purchase_button_" + saveData.purchase_detail_id, true);
                }
                else {
                    dijitDisabledWidget("i_receive_from_purchase_button_" + saveData.purchase_detail_id, false);
                }
                if (undefined != currentChangeNumberMap[saveData.purchase_detail_id]) {
                    currentChangeNumberMap[saveData.purchase_detail_id] += offset;
                }
                else {
                    currentChangeNumberMap[saveData.purchase_detail_id] = offset;
                }
                store.put(saveData, {overwrite: true});
            }
            else { // 增加
                if (saveData.num > rNum) {
                    Toast.error("到货数量不能超过" + rNum);
                    return false;
                }
                else if (saveData.num == rNum) {
                    dijitDisabledWidget("i_receive_from_purchase_button_" + saveData.purchase_detail_id, true);
                }
                else {
                    dijitDisabledWidget("i_receive_from_purchase_button_" + saveData.purchase_detail_id, false);
                }
                if (undefined != currentChangeNumberMap[saveData.purchase_detail_id]) {
                    currentChangeNumberMap[saveData.purchase_detail_id] += saveData.num;
                }
                else {
                    currentChangeNumberMap[saveData.purchase_detail_id] = saveData.num;
                }
                store.add(saveData);
            }
            refreshChangedNumber(saveData.purchase_detail_id);
            i_receive_detail_edit_dialog.hide();
        }
    }

    function refreshChangedNumber(purchaseDetailId) {
        if (currentChangeNumberMap.hasOwnProperty(purchaseDetailId)) {
            var cObj = dojoDom.byId("i_receive_from_purchase_current_num_" + purchaseDetailId);
            var rObj = dojoDom.byId("i_receive_from_purchase_remain_num_" + purchaseDetailId);
            var oc = parseInt(cObj.innerHTML);
            var or = parseInt(rObj.innerHTML);
            cObj.innerHTML = currentChangeNumberMap[purchaseDetailId];
            rObj.innerHTML = oc - currentChangeNumberMap[purchaseDetailId] + or;
        }
    }

    function closeReceiveDetailDialog(formId) {
        resetEditDetailDialogInfo(formId);
        i_receive_detail_edit_dialog.hide();
    }

    function resetEditDetailDialogInfo(formId) {
        dijit.byId(formId).reset();
        lastPurchaseCode = "";
//        destroyPurchaseProductInfo();
    }
</script>
<script>
    // 提交数据
    function submitReceiveEditData(formId) {
        var data = dijit.byId("detail_edit_grid").store.data;
        if (data.length < 1) {
            Toast.error("请填写到货详情信息！")
        }
        else {
            dojoDom.byId("i_receive_edit_receive_detail_info").value = dojoJson.stringify(data);
            submitFormData(formId);
        }
    }
</script>
<script>
    // 处理图片、属性保存信息
    function patchReceiveDetailInfo() {
        len = receiveDetailProductImageCheckBoxIds.length;
        for (var i = 0; i < len; ++i) {
            value = dijit.byId("receive_detail_product_image_" + receiveDetailProductImageCheckBoxIds[i]).get('value');
            if (value) {
                dijit.byId("receive_detail_product_image_id").set("value", value);
                break;
            }
        }
        var checkedAttribute = getCBTreeCheckedMap("receive_detail_product_attribute_tree", 2);
        dijit.byId("receive_detail_product_attribute").set("value", dojoJson.stringify(checkedAttribute));
    }
</script>
<script>
/* 明细添加 */
    function refreshPurchaseDetailTotal() {
        var priceObj = dijit.byId("receive_detail_product_buy_price");
        var rateObj = dijit.byId("receive_detail_product_buy_tax_rate");
        var price = priceObj.get("value");
        var rate = rateObj.get("value");
        var number = dijit.byId("receive_detail_num").get("value");
        if (!isNaN(price) && !isNaN(rate) && !isNaN(number)) {
            dijit.byId("receive_detail_product_buy_tax").set("value", price * rate * 0.01);
            dijit.byId("receive_detail_product_buy_tax_amount").set("value", price * number * rate * 0.01);
            dijit.byId("receive_detail_product_buy_amount").set("value", price * number);
        }
        refreshPurchaseDetailTotalWeight();
    }
    
    function refreshPurchaseDetailTotalWeight() {
        var w = dijit.byId("receive_detail_product_weight").get("value");
        var n = dijit.byId("receive_detail_num").get("value");
        if (!isNaN(n) && !isNaN(w)) {
            dijit.byId("receive_detail_total_weight").set("value", w * n);
        }
    }
</script>
<script>
    function onReceiveProductImageChange(cb) {
        var id = cb.id;
        var value = dijit.byId(id).get('value');
        if (value) {
            var len = receiveDetailProductImageCheckBoxIds.length;
            for (var i = 0; i < len; ++i) {
                if (id != ("receive_detail_product_image_" + receiveDetailProductImageCheckBoxIds[i])) {
                    dijit.byId("receive_detail_product_image_" + receiveDetailProductImageCheckBoxIds[i]).set("value", false);
                }
            }
        }
    }

    function buildReceiveProductImages(data) {
        var url = "<?php echo config('filesystems.product.imageurl'); ?>";
        var len = data.length;
        for (var i = 0; i < len; ++i) {
            appendElement(
                    '<input data-dojo-type="dijit/form/CheckBox" id="receive_detail_product_image_' + data[i].id
                    + '" name="product_image_' + data[i].id + '" value="'
                    + data[i].id
                    + '" onChange="onReceiveProductImageChange(this)" />' +
                    "<a href='" + url + data[i].name + "' target='_blank'><img src='" + url + data[i].name + "' width=36 /></a>",
                    "receive_detail_product_image_div");
            receiveDetailProductImageCheckBoxIds.push(data[i].id);
        }
        parser.parse("receive_detail_product_image_div");
    }

    // 构建产品属性tree
    function buildReceiveProductAttributeTree(data) {
        if (data.length > 0) {
            require([
                "dojo/store/Memory",
                "dojo/store/Observable",
                "cbtree/model/TreeStoreModel",
                "cbtree/Tree"
            ],
            function (Memory, Observable, ObjectStoreModel, Tree) {
                appendElement("<div id='receive_detail_product_attribute_div'></div>", "receive_detail_product_attribute_container");
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
                    id: "receive_detail_product_attribute_tree",
                    model: myModel,
                    autoExpand: true
                }, "receive_detail_product_attribute_div");
                tree.startup();
            });
        }
    }
</script>
<script>
    /* 上传快递图片操作 */
    var i_receive_edit_image = "";
    function changeArticleImage(input) {
        var fileName = input.value;
        if (fileName != "") {
            if (i_receive_edit_image != fileName) {
                dojoDom.byId("i_receive_edit_image_div").innerHTML = "<a href='<?php echo $receiveImageHeader; ?>"
                        + fileName + "' target='_blank' ><img src='<?php echo $receiveImageHeader; ?>"
                        + fileName + "' height=40 /></a>";
                i_receive_edit_image = "";
            }
        }
        else {
            dojoDom.byId("i_receive_edit_image_div").innerHTML = "";
            i_receive_edit_image = "";
        }
    }

    require([
        "dojox/form/FileUploader"
    ],
    function(
            FileUploader) {
        var fileMask = [
            ["Jpeg File",  "*.jpg;*.jpeg"],
            ["GIF File",   "*.gif"],
            ["PNG File",   "*.png"]
        ];

        // 背景图
        var headUploader = new FileUploader({
            uploadUrl: "/Receive/image",
            uploadOnChange: true,
            selectMultipleFiles: false,
            fileMask: fileMask,
            force: "flash",
            isDebug: false,
            devMode: false
        }, "i_receive_edit_image_sel");
        dojo.connect(headUploader, "onComplete", function(dataArray){
            var result = dataArray[0].additionalParams;
            if (0 == result.flag) {
                dojoDom.byId("i_receive_edit_image_div").innerHTML = '<a href="' + result.url
                        + '" target="_blank"><img src="' + result.url
                        + '" height="40" > </a>';
                dojoDom.byId("i_receive_edit_image").value = dataArray[0].file;
                i_receive_edit_image = dataArray[0].file;
            }
            else if (result.flag > 900) {
                location.href = result.message;
            }
            else {
                Toast.error(result.message);
            }
        });
    });
</script>
<script>
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
                HiddenColumns
        ) {
            // 构建操作工具栏
            var gridTopBar = new Toolbar({});
            gridTopBar.addChild(new Button({
                id: "detail_edit_button",
                label: "修改",
                iconClass: "dijitCommonIcon dijitIconEditTask",
                onClick: function () {
                    var sel = grid.select.row.getSelected();
                    var isSel = grid.select.row.getSelected() != "";
                    if (sel.length > 0) {
                        updateReceiveDetail(sel[0]);
                    }
                    else {
                        Toast.error("请选择数据行！")
                    }
                }
            }));
            gridTopBar.addChild(new Button({
                id: "detail_delete_button",
                label: "删除",
                iconClass: "admin_del_icon",
                onClick: function () {

                    var sel = grid.select.row.getSelected();
                    if (sel != "") {
                        var data = grid.store.get(sel);
                        if (confirm("您确定删除吗？")) {
                            currentChangeNumberMap[data.purchase_detail_id] -= parseInt(data.num);
                            grid.store.remove(data.id);
                            refreshChangedNumber(data.purchase_detail_id);
                            dijitDisabledWidget("i_receive_from_purchase_button_" + data.purchase_detail_id, false);
                        }
                    }
                    else {
                        Toast.error("请选择数据行！")
                    }
                }
            }));

            var updateReceiveDetail = function(id) {
                dojoDom.byId('detail_edit_operate').value = 1;
                var data = grid.store.get(id);
                initReceiveDetailDialogData(data);
                i_receive_detail_edit_dialog.show();
            };

            var gridData = <?php echo empty($obj["detail_list"]) ? "[]" : json_encode($obj["detail_list"]); ?>;
            var store = new Store({data: gridData});
            // 构建grid
            var grid = new Grid({
                id : "detail_edit_grid",
                store:  store,
                cacheClass: cache,
                onRowDblClick :function(obj){
                    updateReceiveDetail(obj.rowId);
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
        });
    }

    // grid列属性配置
    var editColumnModel = [
        {id: "id", field: "id", name: "id", width: "100px", editable: false},
        {id: "purchase_detail_sequence", field: "purchase_detail_sequence", name: "采购单序号", width: "100px", editable: false},
        {id: "product_code", field: "product_code", name: "商品编号", width: "100px", editable: false},
        {id: "product_commodity_codes", field: "product_commodity_codes", name: "条码", width: "110px", editable: false},
        {id: "product_brand_name", field: "product_brand_name", name: "品牌", width: "80px", editable: false},
        {id: "product_category_name", field: "product_category_name", name: "分类", width: "80px", editable: false},
        {id: "product_name", field: "product_name", name: "名称", width: "140px", editable: false},
        {id: "num", field: "num", name: "到货数量", width: "70px", editable: false},
        {id: "product_buy_price", field: "product_buy_price", name: "单价", width: "80px", editable: false},
        {id: "product_buy_amount", field: "product_buy_amount", name: "商品金额", width: "110px", editable: false},
        {id: "product_buy_tax_rate", field: "product_buy_tax_rate", name: "消费税率%", width: "80px", editable: false},
        {id: "product_buy_tax_amount", field: "product_buy_tax_amount", name: "消费税金额", width: "80px", editable: false},
        {id: "product_weight", field: "product_weight", name: "单位重量Kg", width: "80px", editable: false},
        {id: "total_weight", field: "total_weight", name: "总重量", width: "80px", editable: false}
    ];

    // 创建grid
    createEditSelectGrid({
        // 网格设置
        gridRenderId: "receive_detail_edit",
        columnModel: editColumnModel
    });
</script>
