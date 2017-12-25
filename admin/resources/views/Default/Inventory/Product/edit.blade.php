<div data-dojo-type="dijit/layout/BorderContainer" style="width: 100%; height: 100%;" data-dojo-props="gutters:false">
    <div data-dojo-type="dijit/layout/ContentPane" region="leading">
    <form data-dojo-type="dojox/form/Manager" action="Product/save" method="post" style="width: 100%; height: 100%;"
          id="inventory_i_product_edit_form" data-dojo-id="inventory_i_product_edit_form">
        <input type="hidden" name="id" value="<?php echo $obj['id']; ?>" />
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
        <input type="hidden" name="operate" value="<?php echo $operate; ?>"/>

        <fieldset style="width: 600px" data-dojo-type="dijit/Fieldset">
            <legend></legend>
            <table border="0">
                <tr>
                    <td width="100">状态：</td>
                    <td>
                        <select name="status" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                            <option value="0" >关闭</option>
                            <option value="1" <?php if (1 === $obj['status']) echo 'selected="selected"'; ?> >开启</option>
                        </select>
                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset style="width: 600px" data-dojo-type="dijit/Fieldset">
            <legend></legend>
            <table border="0">
                <tr>
                    <td width="80">分类编号：</td>
                    <td>
                        <input type="text" value="<?php if (isset($obj['category_code'])) echo $obj['category_code']; ?>"
                               id="inventory_production_category_code"
                               onblur="onProductCategoryBlur(this)"
                               data-dojo-type="dijit/form/ValidationTextBox"
                               data-dojo-props="required:true,trim:true"/>
                        <button data-dojo-type="dijit/form/Button" onclick="inventory_product_category_sel_dialog.show();"
                                type="button">选择</button>
                        <br />
                        <input type="hidden" value="<?php echo $obj['category_id']; ?>"
                               name="category_id" id="inventory_production_category_id">
                        <span id="inventory_production_category_span"><?php if (isset($obj['category_name'])) echo $obj['category_name']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td>品牌id：</td>
                    <td>
                        <input type="text" value="<?php if (isset($obj['brand_code'])) echo $obj['brand_code']; ?>"
                               id="inventory_production_brand_code"
                               onblur="onProductBrandBlur(this)"
                               data-dojo-type="dijit/form/ValidationTextBox"
                               data-dojo-props="required:true,trim:true"/>
                        <button data-dojo-type="dijit/form/Button" onclick="inventory_product_brand_sel_dialog.show();"
                                type="button">选择</button>
                        <br />
                        <input type="hidden" value="<?php echo $obj['brand_id']; ?>"
                               name="brand_id" id="inventory_production_brand_id">
                        <span id="inventory_production_brand_span"><?php if (isset($obj['brand_name'])) echo $obj['brand_name']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td>计量单位：</td>
                    <td>
                        <select name="unit" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                            <option value="">请选择</option>
                            <?php foreach (\Library\Constant\BusinessConstant::$PRODUCT_UNIT as $k => $v) { ?>
                            <option value="<?php echo $k; ?>" <?php if ($k == $obj['unit']) echo 'selected="selected"'; ?> >
                                <?php echo $v; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset style="width: 600px" data-dojo-type="dijit/Fieldset">
            <legend></legend>
            <table border="0">
                <tr>
                    <td width="100">编号：</td>
                    <td>
                        <input type="text" name="code" value="<?php echo $obj['code']; ?>"
                               data-dojo-type="dijit/form/ValidationTextBox"
                               data-dojo-props="required:true,trim:true,maxLength:36"/>
                    </td>
                </tr>
                <tr>
                    <td width="80">条码：</td>
                    <td>
                        <input type="text" name="commodity_codes" value="<?php echo $obj['commodity_codes']; ?>"
                               data-dojo-type="dijit/form/ValidationTextBox"
                               data-dojo-props="required:true,trim:true,maxLength:13"/>
                    </td>
                </tr>
                <tr>
                    <td>名称：</td>
                    <td>
                        <input type="text" name="name" value="<?php echo $obj['name']; ?>"
                               data-dojo-type="dijit/form/ValidationTextBox"
                               data-dojo-props="required:true,trim:true,maxLength:50"/>
                    </td>
                </tr>

                <tr>
                    <td>规格描述：</td>
                    <td>
                        <input type="text" name="pack" value="<?php echo $obj['pack']; ?>"
                               data-dojo-type="dijit/form/ValidationTextBox"
                               data-dojo-props="required:true,trim:true,maxLength:50"/>
                    </td>
                </tr>
                <tr>
                    <td>外文名：</td>
                    <td>
                        <input type="text" name="e_name" value="<?php echo $obj['e_name']; ?>"
                               data-dojo-type="dijit/form/ValidationTextBox"
                               data-dojo-props="trim:true,maxLength:50"/>
                    </td>
                </tr>
                <tr>
                    <td>货币单位：</td>
                    <td>
                        <select name="currency_unit" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                            <option value="">请选择</option>
                            <?php foreach (\Library\Constant\BusinessConstant::$CURRENCY as $k => $v) { ?>
                            <option value="<?php echo $k; ?>" <?php if ($k == $obj['currency_unit']) echo 'selected="selected"'; ?> >
                                <?php echo $v; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>购买价：</td>
                    <td>
                        <input type="text" name="buy_price" value="<?php echo $obj['buy_price']; ?>"
                               id="i_product_edit_buy_price" onblur="iProductBuyPriceOnBlur()"
                               data-dojo-type="dijit/form/NumberTextBox"
                               data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:0,max:999999999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>消费税率%：</td>
                    <td>
                        <input type="text" name="buy_tax_rate" value="<?php echo $obj['buy_tax_rate']; ?>"
                               id="i_product_edit_buy_tax_rate" onblur="iProductBuyPriceOnBlur()"
                               data-dojo-type="dijit/form/NumberTextBox"
                               data-dojo-props='required:true,trim:true,constraints:{pattern: "###.##",min:-999.99,max:999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>消费税：</td>
                    <td>
                        <input type="text" name="buy_tax" value="<?php echo $obj['buy_tax']; ?>"
                               id="i_product_edit_buy_tax"
                               data-dojo-type="dijit/form/NumberTextBox"
                               data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.####",min:0, max:999999999.9999}'/>
                    </td>
                </tr>
                <tr>
                    <td>毛利率%：</td>
                    <td>
                        <input type="text" name="sold_rate" value="<?php echo $obj['sold_rate']; ?>"
                               data-dojo-type="dijit/form/NumberTextBox"
                               data-dojo-props='required:true,trim:true,constraints:{pattern: "###.##",min:0, max:999.99}'/>
                    </td>
                </tr>
                <tr style="display: none">
                    <td>重量单位：</td>
                    <td>
                        <input type="hidden" name="weight_unit" value="1">
                    </td>
                </tr>
                <tr>
                    <td>重量Kg：</td>
                    <td>
                        <input type="text" name="weight" value="<?php echo $obj['weight']; ?>"
                               data-dojo-type="dijit/form/NumberTextBox"
                               data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.####",min:0,max:999999999.9999}'/>
                    </td>
                </tr>
                <tr>
                    <td>保质期：</td>
                    <td>
                        <input type="text" name="life" value="<?php echo $obj['life']; ?>"
                               data-dojo-type="dijit/form/NumberTextBox"
                               data-dojo-props='required:true,trim:true,constraints:{min:0,max:999999999}'/>
                        <span>天(0表示永久)</span>
                    </td>
                </tr>

                <tr>
                    <td>说明：</td>
                    <td>
                        <input type="text" name="description" value="<?php echo $obj['description']; ?>"
                               data-dojo-type="dijit/form/TextArea"
                               data-dojo-props="required:true,trim:true,maxLength:200"/>
                    </td>
                </tr>
                <tr>
                    <td>排序：</td>
                    <td>
                        <input type="text" name="sort" value="<?php echo empty($obj['sort']) ? 99 : $obj['sort']; ?>"
                               data-dojo-type="dijit/form/NumberTextBox"
                               data-dojo-props='required:true,trim:true,constraints:{places:0,min:-2147483648,max:2147483647}'/>
                    </td>
                </tr>
            </table>
        </fieldset>

        <input type="hidden" name="checked_attributes" id="inventory_product_attribute" />
        <input type="hidden" name="product_images" id="inventory_product_image" />

        <fieldset style="width: 600px" data-dojo-type="dijit/Fieldset">
            <legend>产品图库</legend>
            <div id="inventory_product_edit_image_sel" class="admin_uploadBtn">选择图片</div>
            <div id="inventory_product_edit_image_lib">
                <?php
                if (!empty($obj["images"])) {
                    foreach ($obj["images"] as $v) {
                        $node = '<span id="' . $v["name"] . '_span"><a ' . 'href="'
                                . config('filesystems.product.imageurl') . $v["name"] . '" target="_blank"><img src="'
                                . config('filesystems.product.imageurl') . $v["name"]
                                . '?v=0';
                        if ($v["width"] > 540) {
                            $node .= '" width="540';
                        }
                        $node .= '" /></a></span>';
                        echo $node;
                    }
                }
                ?>
            </div>
        </fieldset>
    </form>
    </div>
    <div style="margin-left: 20px;" data-dojo-type="dijit/layout/ContentPane" region="center">
        <div id="inventory_production_attribute_tree_div">
        </div>
    </div>
    <div data-dojo-type="dijit/layout/ContentPane" region="bottom">
        <div style="text-align:center">
            <button data-dojo-type="dijit/form/Button" onclick="saveProductAttribute();" type="button">保存</button>
            <button data-dojo-type="dijit/form/Button" style="padding-left: 50px;" onclick="closeSingleEditTab();"
                type="button">关闭</button>
        </div>
    </div>
</div>

<div id="inventory_product_category_sel_dialog" data-dojo-id="inventory_product_category_sel_dialog" title="分类选择"
     data-dojo-type="dojox/widget/DialogSimple" data-dojo-props="style: 'width:400px;height:600px;'"
     href="CategoryDialog?showId=inventory_production_category_span&saveId=inventory_production_category_id&showCode=inventory_production_category_code&dialogId=inventory_product_category_sel_dialog">
</div>
<div id="inventory_product_brand_sel_dialog" data-dojo-id="inventory_product_brand_sel_dialog" title="品牌选择"
     data-dojo-type="dojox/widget/DialogSimple" data-dojo-props="style: 'width:1000px;height:700px;'"
     href="BrandDialog?showId=inventory_production_brand_span&saveId=inventory_production_brand_id&showCode=inventory_production_brand_code&dialogId=inventory_product_brand_sel_dialog">
</div>
<script>

    function iProductBuyPriceOnBlur() {
        var p = dijit.byId("i_product_edit_buy_price").get("value");
        var t = dijit.byId("i_product_edit_buy_tax_rate").get("value");
        if (!isNaN(p) && !isNaN(t)) {
            dijit.byId("i_product_edit_buy_tax").set("value", p * t * 0.01);
        }
    }

    var inventory_product_images = {};
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

        // 背景图 csf
        var headUploader = new FileUploader({
            uploadUrl:"Product/image",
            uploadOnChange:true,
            force:"flash",
            selectMultipleFiles:true,
            fileMask:fileMask,
            isDebug:false,
            devMode:false
        }, "inventory_product_edit_image_sel");
        dojo.connect(headUploader, "onComplete", function(dataArray){
            console.info(dataArray);
            var len = dataArray.length;
            var result;
            var node;
            var file;
            for (var i = 0; i < len; ++i) {
                result = dataArray[i].additionalParams;
                file = dataArray[i].file;
                if (0 == result.flag) {
                    node = '<span id="' + file + '_span"><a ' + 'href="' + result.url
                            + '" target="_blank"><img src="' + result.url
                            + '?v=' + (new Date()).getTime();
                    if (result.width > 540) {
                        node += '" width="540';
                    }

                    node += '" /></a>';
                    node +='<button data-dojo-type="dijit/form/Button" onclick="removeInventoryProductImage(\''
                        + file + '\')" data-dojo-props="iconClass:\'admin_del_icon\', showLabel: false" type="button"></button>';
                    node += "</span>";
                    unshiftElement(node, "inventory_product_edit_image_lib");
                    parser.parse("inventory_product_edit_image_lib");
                    inventory_product_images[file] = 0;
                }
                else if (result.flag > 900) {
                    location.href = result.message;
                    break;
                }
                else {
                    Toast.error(result.message);
                    break;
                }
            }
        });

    });

    function removeInventoryProductImage(file) {
        removeElement(file + "_span");
        delete(inventory_product_images[file]);
    }
</script>
<script>
    function saveProductAttribute() {
        var checkedIds = getCBTreeCheckedIds("inventory_production_attribute_tree", 2);
        if (checkedIds.length < 1) {
            Toast.error("请选择属性！");
        }
        else {
            dojoDom.byId("inventory_product_attribute").value = jsonToStr(checkedIds);
            dojoDom.byId("inventory_product_image").value = jsonToStr(inventory_product_images);
            submitFormData("inventory_i_product_edit_form");
        }
    }

    function onProductCategoryBlur(inputer) {
        var value = inputer.value;
        var idInput = dojoDom.byId("inventory_production_category_id");
        var textSpan = dojoDom.byId("inventory_production_category_span");
        if ("" != value) {
            request(
                "/Category/getInfoByCode?isLeaf=1&code=" + value,
                {
                    handleAs: "json",
                    method: "get"
                }
            ).then(
                function (json) {
                    if (0 === json.flag) {
                        idInput.value = json.result.id;
                        textSpan.innerHTML = json.result.name;
                    }
                    else if (999 == json.flag) {
                        location.href = json.message;
                    }
                    else {
                        dijit.byId("inventory_production_category_code").set("value", "");
                        idInput.value = "";
                        textSpan.innerHTML = "";
                        inputer.focus();
                        Toast.error(json.message);
                    }
                },
                function (err) {
                    //
                }
            );
        }
        else {
            idInput.value = "";
            textSpan.innerHTML = "";
        }
    }

    function onProductBrandBlur(inputer) {
        var value = inputer.value;
        var idInput = dojoDom.byId("inventory_production_brand_id");
        var textSpan = dojoDom.byId("inventory_production_brand_span");
        if ("" != value) {
            request(
                    "/Brand/getInfoByCode?isLeaf=1&code=" + value,
                    {
                        handleAs: "json",
                        method: "get"
                    }
            ).then(
                    function (json) {
                        if (0 === json.flag) {
                            idInput.value = json.result.id;
                            textSpan.innerHTML = json.result.name;
                        }
                        else if (999 == json.flag) {
                            location.href = json.message;
                        }
                        else {
                            dijit.byId("inventory_production_brand_code").set("value", "");
                            idInput.value = "";
                            textSpan.innerHTML = "";
                            inputer.focus();
                            Toast.error(json.message);
                        }
                    },
                    function (err) {
                        //
                    }
            );
        }
        else {
            idInput.value = "";
            textSpan.innerHTML = "";
        }
    }
</script>
<script>
    require([
        "dojo/store/Memory",
        "dojo/store/Observable",
        "cbtree/model/TreeStoreModel",
        "cbtree/Tree",
        "dojo/ready"
    ],
    function (Memory, Observable, ObjectStoreModel, Tree, ready) {
        var buildTree = function(data) {
            var dataStore = new Memory({
                data: data
            });
            var myStore = new Observable(dataStore);
            var myModel = new ObjectStoreModel({
                store: myStore,
                labelAttr: "name",
                query: { level: 0},
                attachToForm: {
                    checked: ["mixed", true],
                    name: "checkboxes"
                },
                checkedRoot: true
            });
            var tree = new Tree({
                id: "inventory_production_attribute_tree",
                model: myModel,
                autoExpand: true
            }, "inventory_production_attribute_tree_div");
            tree.startup();
        };
        ready(function(){ buildTree(<?php echo $obj["attributes"]; ?>); });
    });
</script>