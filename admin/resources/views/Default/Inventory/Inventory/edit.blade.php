<div data-dojo-type="dijit/layout/BorderContainer" style="width: 100%; height: 100%;" data-dojo-props="gutters:false">
    <div data-dojo-type="dijit/layout/ContentPane" region="center">
        <form data-dojo-type="dojox/form/Manager" action="Inventory/save" method="post"
        id="inventory_i_inventory_edit_form" data-dojo-id="inventory_i_inventory_edit_form">
            <input type="hidden" name="id" value="<?php echo $obj['id']; ?>" />
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
            <input type="hidden" name="operate" value="<?php echo $operate; ?>"/>
            <fieldset style="width: 800px" data-dojo-type="dijit/Fieldset">
            <legend></legend>
            <table border="0">
                <tr>
                    <td>序号：</td>
                    <td>
                        <input type="text" name="sequence" value="<?php echo $obj['sequence']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{places:0,min:1,max:4147483647}'/>
                    </td>
                </tr>
                <tr>
                    <td>receive_id：</td>
                    <td>
                        <input type="text" name="receive_id" value="<?php echo $obj['receive_id']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true"/>
                    </td>
                </tr>
                <tr>
                    <td>receive_detail_id：</td>
                    <td>
                        <input type="text" name="receive_detail_id" value="<?php echo $obj['receive_detail_id']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true"/>
                    </td>
                </tr>
                <tr>
                    <td>到货编号：</td>
                    <td>
                        <input type="text" name="receive_code" value="<?php echo $obj['receive_code']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:36"/>
                    </td>
                </tr>
                <tr>
                    <td>purchase_id：</td>
                    <td>
                        <input type="text" name="purchase_id" value="<?php echo $obj['purchase_id']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true"/>
                    </td>
                </tr>
                <tr>
                    <td>purchase_detail_id：</td>
                    <td>
                        <input type="text" name="purchase_detail_id" value="<?php echo $obj['purchase_detail_id']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true"/>
                    </td>
                </tr>
                <tr>
                    <td>采购编号：</td>
                    <td>
                        <input type="text" name="purchase_code" value="<?php echo $obj['purchase_code']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:36"/>
                    </td>
                </tr>
                <tr>
                    <td>商品数量：</td>
                    <td>
                        <input type="text" name="num" value="<?php echo $obj['num']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{places:0,min:-2147483648,max:2147483647}'/>
                    </td>
                </tr>
                <tr>
                    <td>重量单位：</td>
                    <td>
                        <select name="product_weight_unit" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                            <option value="">请选择</option>
                            <?php foreach (\Library\Constant\BusinessConstant::$WEIGHT as $k => $v) { ?>
                            <option value="<?php echo $k; ?>" <?php if ($k == $obj['product_weight_unit']) echo 'selected="selected"'; ?> >
                                <?php echo $v; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>重量：</td>
                    <td>
                        <input type="text" name="product_weight" value="<?php echo $obj['product_weight']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:-999999999.99,max:999999999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>商品总重量：</td>
                    <td>
                        <input type="text" name="weight" value="<?php echo $obj['weight']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.####",min:-999999999.9999,max:999999999.9999}'/>
                    </td>
                </tr>
                <tr>
                    <td>合计总重量：</td>
                    <td>
                        <input type="text" name="total_weight" value="<?php echo $obj['total_weight']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.####",min:-999999999.9999,max:999999999.9999}'/>
                    </td>
                </tr>
                <tr>
                    <td>货币单位：</td>
                    <td>
                        <select name="product_currency_unit" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                            <option value="">请选择</option>
                            <?php foreach (\Library\Constant\BusinessConstant::$CURRENCY as $k => $v) { ?>
                            <option value="<?php echo $k; ?>" <?php if ($k == $obj['product_currency_unit']) echo 'selected="selected"'; ?> >
                                <?php echo $v; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>商品购买价：</td>
                    <td>
                        <input type="text" name="product_buy_price" value="<?php echo $obj['product_buy_price']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:-999999999.99,max:999999999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>消费税率：</td>
                    <td>
                        <input type="text" name="product_buy_tax_rate" value="<?php echo $obj['product_buy_tax_rate']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "###.##",min:-999.99,max:999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>消费税：</td>
                    <td>
                        <input type="text" name="product_buy_tax" value="<?php echo $obj['product_buy_tax']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.####",min:-999999999.9999,max:999999999.9999}'/>
                    </td>
                </tr>
                <tr>
                    <td>折算快递费：</td>
                    <td>
                        <input type="text" name="express_price" value="<?php echo $obj['express_price']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.####",min:-999999999.9999,max:999999999.9999}'/>
                    </td>
                </tr>
                <tr>
                    <td>成本价：</td>
                    <td>
                        <input type="text" name="cost" value="<?php echo $obj['cost']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.####",min:-999999999.9999,max:999999999.9999}'/>
                    </td>
                </tr>
                <tr>
                    <td>成本总金额：</td>
                    <td>
                        <input type="text" name="total_amount" value="<?php echo $obj['total_amount']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.####",min:-999999999.9999,max:999999999.9999}'/>
                    </td>
                </tr>
                <tr>
                    <td>汇率：</td>
                    <td>
                        <input type="text" name="exchange_rate" value="<?php echo $obj['exchange_rate']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.####",min:-999999999.9999,max:999999999.9999}'/>
                    </td>
                </tr>
                <tr>
                    <td>成本价：</td>
                    <td>
                        <input type="text" name="cost_local" value="<?php echo $obj['cost_local']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.####",min:-999999999.9999,max:999999999.9999}'/>
                    </td>
                </tr>
                <tr>
                    <td>成本总金额：</td>
                    <td>
                        <input type="text" name="total_amount_local" value="<?php echo $obj['total_amount_local']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.####",min:-999999999.9999,max:999999999.9999}'/>
                    </td>
                </tr>
                <tr>
                    <td>商品id：</td>
                    <td>
                        <input type="text" name="product_id" value="<?php echo $obj['product_id']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true"/>
                    </td>
                </tr>
                <tr>
                    <td>编号：</td>
                    <td>
                        <input type="text" name="product_code" value="<?php echo $obj['product_code']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:36"/>
                    </td>
                </tr>
                <tr>
                    <td>名称：</td>
                    <td>
                        <input type="text" name="product_name" value="<?php echo $obj['product_name']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:50"/>
                    </td>
                </tr>
                <tr>
                    <td>分类id：</td>
                    <td>
                        <input type="text" name="product_category_id" value="<?php echo $obj['product_category_id']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true"/>
                    </td>
                </tr>
                <tr>
                    <td>品牌id：</td>
                    <td>
                        <input type="text" name="product_brand_id" value="<?php echo $obj['product_brand_id']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true"/>
                    </td>
                </tr>
                <tr>
                    <td>属性：</td>
                    <td>
                        <input type="text" name="product_attribute" value="<?php echo $obj['product_attribute']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:"/>
                    </td>
                </tr>
                <tr>
                    <td>计量单位：</td>
                    <td>
                        <select name="product_unit" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                            <option value="">请选择</option>
                            <option value="\Library\Constant\BusinessConstant" <?php if (\Library\Constant\BusinessConstant === $obj['product_unit']) echo 'selected="selected"'; ?> ></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>规格：</td>
                    <td>
                        <input type="text" name="product_pack" value="<?php echo $obj['product_pack']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:20"/>
                    </td>
                </tr>
                <tr>
                    <td>图片：</td>
                    <td>
                        <input type="text" name="product_image_id" value="<?php echo $obj['product_image_id']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{places:0,min:-2147483648,max:2147483647}'/>
                    </td>
                </tr>
                <tr>
                    <td>保质期：</td>
                    <td>
                        <input type="text" name="product_life" value="<?php echo $obj['product_life']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{places:0,min:-2147483648,max:2147483647}'/>
                    </td>
                </tr>
                <tr>
                    <td>生产日期：</td>
                    <td>
                        <input type="text" name="product_date" value="<?php echo $obj['product_date']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:"/>
                    </td>
                </tr>
                <tr>
                    <td>状态：</td>
                    <td>
                        <select name="status" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                            <option value="">请选择</option>
                            <option value="0" <?php if (0 === $obj['status']) echo 'selected="selected"'; ?> >初始</option>
                            <option value="99" <?php if (99 === $obj['status']) echo 'selected="selected"'; ?> >已标价</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>是否删除：</td>
                    <td>
                        <select name="is_del" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                            <option value="">请选择</option>
                            <option value="0" <?php if (0 === $obj['is_del']) echo 'selected="selected"'; ?> >否</option>
                            <option value="1" <?php if (1 === $obj['is_del']) echo 'selected="selected"'; ?> >是</option>
                        </select>
                    </td>
                </tr>
            </table>
            </fieldset>
        </form>
    </div>
    <div data-dojo-type="dijit/layout/ContentPane" region="bottom">
        <div style="text-align:center">
            <button data-dojo-type="dijit/form/Button" onclick="submitFormData('inventory_i_inventory_edit_form')" type="button">保存</button>
            <button data-dojo-type="dijit/form/Button" style="padding-left: 50px;" type="button"
                onclick="closeSingleEditTab();">关闭</button>
        </div>
    </div>
</div>
