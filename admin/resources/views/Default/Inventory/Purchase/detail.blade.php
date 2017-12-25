<form data-dojo-type="dojox/form/Manager" id="detail_edit_form"  data-dojo-id="detail_edit_form">
    <table border="0">
        <tr>
            <td valign="top">
            <fieldset style="width: 300px" data-dojo-type="dijit/Fieldset">
                <legend>商品参考信息</legend>
                <table border="0">
                    <tr>
                        <td>名称：</td>
                        <td>
                            <input disabled type="text" name="product_name"
                                   id="purchase_detail_product_name"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="required:true,trim:true,maxLength:50"/>
                        </td>
                    </tr>
                    <tr>
                        <td>外文名：</td>
                        <td>
                            <input disabled type="text" name="product_e_name"
                                   id="purchase_detail_product_e_name"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="required:true,trim:true,maxLength:50"/>
                        </td>
                    </tr>
                    <tr>
                        <td>条码：</td>
                        <td>

                            <input type="text" disabled name="product_commodity_codes"
                                   id="purchase_detail_product_commodity_codes"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="required:true,trim:true"/>
                        </td>
                    </tr>
                    <tr>
                        <td>分类：</td>
                        <td>

                            <input type="text" disabled name="product_category_name"
                                   id="purchase_detail_product_category_name"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="required:true,trim:true"/>
                            <input type="text" style="display: none" name="product_category_id"
                                   id="purchase_detail_product_category_id"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="required:true,trim:true"/>
                        </td>
                    </tr>

                    <tr>
                        <td>品牌：</td>
                        <td>
                            <input type="text" disabled name="product_brand_name"
                                   id="purchase_detail_product_brand_name"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="required:true,trim:true"/>
                            <input type="text" style="display: none" name="product_brand_id"
                                   id="purchase_detail_product_brand_id"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="required:true,trim:true"/>
                        </td>
                    </tr>
                    <tr>
                        <td>计量单位：</td>
                        <td>
                            <select name="product_unit" disabled data-dojo-type="dijit/form/Select"
                                    id="purchase_detail_product_unit" data-dojo-props="required:true">
                                <option value=""></option>
                                <?php foreach(\Library\Constant\BusinessConstant::$PRODUCT_UNIT as $k => $v) { ?>
                                <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>规格：</td>
                        <td>
                            <input type="text" disabled name="product_pack"
                                   id="purchase_detail_product_pack"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="required:true,trim:true,maxLength:20"/>
                        </td>
                    </tr>
                    <tr>
                        <td>重量单位：</td>
                        <td>
                            <select  name="product_weight_unit" disabled data-dojo-type="dijit/form/Select"
                                     id="purchase_detail_product_weight_unit" data-dojo-props="required:true">
                                <option value=""></option>
                                <?php foreach(\Library\Constant\BusinessConstant::$WEIGHT as $k => $v) { ?>
                                <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>重量：</td>
                        <td>
                            <input type="text" disabled name="product_weight"
                                   id="purchase_detail_product_weight"
                                   data-dojo-type="dijit/form/NumberTextBox"
                                   data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.####",min:0.0001,max:999999999.9999}'/>
                        </td>
                    </tr>
                    <tr>
                        <td>有效期：</td>
                        <td>
                            <input type="text" disabled name="product_life"
                                   id="purchase_detail_product_life"
                                   data-dojo-type="dijit/form/NumberTextBox"
                                   data-dojo-props='required:true,trim:true,constraints:{min:0,max:999999999}'/>
                        </td>
                    </tr>
                    <tr>
                        <td>货币单位：</td>
                        <td>
                            <select name="product_currency_unit" disabled data-dojo-type="dijit/form/Select"
                                    id="purchase_detail_product_currency_unit" data-dojo-props="required:true">
                                <option value=""></option>
                                <?php foreach(\Library\Constant\BusinessConstant::$CURRENCY as $k => $v) { ?>
                                <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </fieldset>


            </td>
            <td valign="top">
                <fieldset style="width: 350px;" data-dojo-type="dijit/Fieldset">
                    <legend>编辑信息</legend>
                    <table border="0">
                        <tr>
                            <td width="100">是否删除：</td>
                            <td>
                                <input style="display: none" type="text" name="sequence"
                                       id="purchase_detail_sequence"
                                       data-dojo-type="dijit/form/ValidationTextBox"
                                       data-dojo-props="trim:true"/>
                                <select name="is_del" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                                    <option value="0" >否</option>
                                    <option value="1" >是</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>商品编号：</td>
                            <td>
                                <input type="text" name="product_code"
                                       onblur="getPurchaseProductByCode(this.value)"
                                       id="purchase_detail_product_code"
                                       style="width: 150px"
                                       data-dojo-type="dijit/form/ValidationTextBox"
                                       data-dojo-props="required:true,trim:true,maxLength:36"/>
                                <input style="display: none" type="text" name="product_id"
                                       id="purchase_detail_product_id"
                                       data-dojo-type="dijit/form/TextBox"/>
                                <button data-dojo-type="dijit/form/Button" type="button"
                                        onclick="showPurchaseProductDialog()">选择</button>
                            </td>
                        </tr>
                        <tr>
                            <td>采购数量：</td>
                            <td>
                                <input type="text" name="purchase_number"
                                       id="purchase_detail_purchase_number"
                                       onblur="refreshPurchaseDetailTotal()"
                                       data-dojo-type="dijit/form/NumberTextBox"
                                       data-dojo-props='required:true,trim:true,constraints:{places:0,min:1,max:2147483647}'/>
                            </td>
                        </tr>

                        <tr>
                            <td>购买价：</td>
                            <td>
                                <input type="text" name="product_buy_price"
                                       id="purchase_detail_product_buy_price"
                                       onblur="refreshPurchaseBuyAmount()"
                                       data-dojo-type="dijit/form/NumberTextBox"
                                       data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:0,max:999999999.99}'/>
                            </td>
                        </tr>
                        <tr>
                            <td>消费税率%：</td>
                            <td>
                                <input type="text" name="product_buy_tax_rate"
                                       id="purchase_detail_product_buy_tax_rate"
                                       onblur="refreshPurchaseBuyTax()"
                                       data-dojo-type="dijit/form/NumberTextBox"
                                       data-dojo-props='required:true,trim:true,constraints:{pattern: "###.##",min:0,max:999.99}'/>
                            </td>
                        </tr>
                        <tr>
                            <td>消费税：</td>
                            <td>
                                <input disabled type="text" name="product_buy_tax"
                                       id="purchase_detail_product_buy_tax"
                                       data-dojo-type="dijit/form/NumberTextBox"
                                       data-dojo-props='trim:true,constraints:{pattern: "#########.####",min:0,max:999999999.9999}'/>
                            </td>
                        </tr>
                        <tr>
                            <td>消费税总额：</td>
                            <td>
                                <input disabled type="text" name="product_buy_tax_amount"
                                       id="purchase_detail_product_buy_tax_amount"
                                       data-dojo-type="dijit/form/NumberTextBox"
                                       data-dojo-props='trim:true,constraints:{pattern: "#########.####",min:0,max:999999999.9999}'/>
                            </td>
                        </tr>
                        <tr>
                            <td>商品金额：</td>
                            <td>
                                <input disabled type="text" name="product_buy_amount"
                                       id="purchase_detail_product_buy_amount"
                                       data-dojo-type="dijit/form/NumberTextBox"
                                       data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:0,max:999999999.99}'/>
                            </td>
                        </tr>
                        <tr>
                            <td>总金额：</td>
                            <td>
                                <input type="text" disabled name="purchase_amount"
                                       id="purchase_detail_purchase_amount"
                                       data-dojo-type="dijit/form/NumberTextBox"
                                       data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.####",min:0,max:999999999.9999}'/>
                            </td>
                        </tr>
                        <tr>
                            <td>商品总重：</td>
                            <td>
                                <input type="text" disabled name="purchase_weight"
                                       id="purchase_detail_purchase_weight"
                                       data-dojo-type="dijit/form/NumberTextBox"
                                       data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.####",min:0,max:999999999.9999}'/>
                            </td>
                        </tr>
                        <tr style="display: none">
                            <td>属性：</td>
                            <td>
                                <input type="text" name="product_attribute"
                                       id="purchase_detail_product_attribute"
                                       data-dojo-type="dijit/form/ValidationTextBox"
                                       data-dojo-props="trim:true"/>
                            </td>
                        </tr>
                        <tr style="display: none">
                            <td>图片：</td>
                            <td>
                                <input type="text" name="product_image_id"
                                       id="purchase_detail_product_image_id"
                                       data-dojo-type="dijit/form/ValidationTextBox"
                                       data-dojo-props="trim:true"/>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
    </table>
</form>
<table border="0">
    <tr>
        <td valign="top">
            图片选择：
        </td>
        <td>
            <div id="purchase_detail_product_image_div">

            </div>
        </td>
    </tr>
    <tr>
        <td valign="top">
            属性选择：
        </td>
        <td>
            <div id="purchase_detail_product_attribute_container"></div>
        </td>
    </tr>
</table>
<div style="text-align:center">
    <button data-dojo-type="dijit/form/Button" onclick="savePurchaseDetailData('detail_edit_form');" type="button">保存</button>
    <button data-dojo-type="dijit/form/Button" onclick="closePurchaseDetailDialog('detail_edit_form')" type="button">关闭</button>
</div>
<input type="hidden" id="detail_edit_operate" name="detail_operate" />
<input type="hidden" id="detail_edit_id" />