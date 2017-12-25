<div style="height: 600px" data-dojo-type="dijit/layout/ContentPane" >
    <form data-dojo-type="dojox/form/Manager" id="receive_detail_edit_form"  data-dojo-id="receive_detail_edit_form">
        <input type="text" disabled name="id"
               style="display: none"
               id="receive_detail_id"
               data-dojo-type="dijit/form/TextBox"
               data-dojo-props='required:true,trim:true'/>
        <input  type="text" name="sequence"
                style="display: none"
                id="receive_detail_sequence"
                data-dojo-type="dijit/form/ValidationTextBox"
                data-dojo-props="trim:true"/>
        <input  type="text" name="product_id"
                style="display: none"
                id="receive_detail_product_id"
                data-dojo-type="dijit/form/TextBox"/>
        <table border="0">
            <tr>
                <td valign="top">
                <fieldset style="width: 400px" data-dojo-type="dijit/Fieldset">
                    <legend>采购商品信息</legend>
                    <table border="0">
                        <tr >
                            <td width="100">采购明细序号：</td>
                            <td>
                                <input  type="text" disabled name="purchase_detail_sequence"
                                        id="receive_detail_purchase_detail_sequence"
                                        data-dojo-type="dijit/form/TextBox"/>
                            <td>
                        </tr>
                        <tr style="display: none">
                            <td>采购单明细id：</td>
                            <td>
                                <input type="text" name="purchase_detail_id"
                                       id="receive_detail_purchase_detail_id"
                                       data-dojo-type="dijit/form/TextBox"/>
                            <td>
                        </tr>
                        <tr  style="display: none">
                            <td>图片：</td>
                            <td>
                                <input type="text" name="product_image_id"
                                       id="receive_detail_product_image_id"
                                       data-dojo-type="dijit/form/ValidationTextBox"
                                       data-dojo-props="trim:true"/>
                            </td>
                        </tr>
                        <tr>
                            <td>商品编号：</td>
                            <td>
                                <input type="text" disabled name="product_code"
                                       onblur="getPurchaseProductByCode(this.value)"
                                       id="receive_detail_product_code"
                                       data-dojo-type="dijit/form/ValidationTextBox"
                                       data-dojo-props="trim:true,maxLength:36"/>
                            </td>
                        </tr>
                        <tr>
                            <td>条码：</td>
                            <td>
                                <input type="text" disabled name="product_commodity_codes"
                                       id="receive_detail_product_commodity_codes"
                                       data-dojo-type="dijit/form/ValidationTextBox"
                                       data-dojo-props="trim:true,maxLength:36"/>
                            </td>
                        </tr>
                        <tr>
                            <td>外文名：</td>
                            <td>
                                <input type="text" disabled name="product_name"
                                       id="receive_detail_product_name"
                                       data-dojo-type="dijit/form/ValidationTextBox"
                                       data-dojo-props="trim:true,maxLength:50"/>
                            </td>
                        </tr>
                        <tr>
                            <td>名称：</td>
                            <td>
                                <input type="text" disabled name="product_e_name"
                                       id="receive_detail_product_e_name"
                                       data-dojo-type="dijit/form/ValidationTextBox"
                                       data-dojo-props="trim:true,maxLength:50"/>
                            </td>
                        </tr>
                        <tr>
                            <td >分类：</td>
                            <td>

                                <input type="text" disabled name="product_category_name"
                                       id="receive_detail_product_category_name"
                                       data-dojo-type="dijit/form/ValidationTextBox"
                                       data-dojo-props="required:true,trim:true"/>
                                <input type="text"  name="product_category_id"
                                       style="display: none"
                                       id="receive_detail_product_category_id"
                                       data-dojo-type="dijit/form/ValidationTextBox"
                                       data-dojo-props="required:true,trim:true"/>
                            </td>
                        </tr>

                        <tr>
                            <td>品牌：</td>
                            <td>
                                <input type="text" disabled name="product_brand_name"
                                       id="receive_detail_product_brand_name"
                                       data-dojo-type="dijit/form/ValidationTextBox"
                                       data-dojo-props="required:true,trim:true"/>
                                <input type="text"  name="product_brand_id"
                                       style="display: none"
                                       id="receive_detail_product_brand_id"
                                       data-dojo-type="dijit/form/ValidationTextBox"
                                       data-dojo-props="required:true,trim:true"/>
                            </td>
                        </tr>
                        <tr>
                            <td>计量单位：</td>
                            <td>
                                <select name="product_unit" disabled data-dojo-type="dijit/form/Select"
                                        id="receive_detail_product_unit" data-dojo-props="required:true">
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
                                       id="receive_detail_product_pack"
                                       data-dojo-type="dijit/form/ValidationTextBox"
                                       data-dojo-props="required:true,trim:true,maxLength:20"/>
                            </td>
                        </tr>
                        <tr>
                            <td>重量单位：</td>
                            <td>
                                <select name="product_weight_unit" disabled data-dojo-type="dijit/form/Select"
                                        id="receive_detail_product_weight_unit" data-dojo-props="required:true">
                                    <option value=""></option>
                                    <?php foreach(\Library\Constant\BusinessConstant::$WEIGHT as $k => $v) { ?>
                                    <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr >
                            <td>货币单位：</td>
                            <td>
                                <select name="product_currency_unit" disabled data-dojo-type="dijit/form/Select"
                                        id="receive_detail_product_currency_unit" data-dojo-props="required:true">
                                    <option value=""></option>
                                    <?php foreach(\Library\Constant\BusinessConstant::$CURRENCY as $k => $v) { ?>
                                    <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr style="display: none">
                            <td>属性：</td>
                            <td>
                                <input type="text" name="product_attribute"
                                       id="receive_detail_product_attribute"
                                       data-dojo-type="dijit/form/ValidationTextBox"
                                       data-dojo-props="trim:true"/>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                </td>
                <td valign="top">
                    <fieldset style="width: 350px" data-dojo-type="dijit/Fieldset">
                        <legend>编辑信息</legend>
                        <table border="0">
                            <tr>
                                <td width="90">到货数量：</td>
                                <td>
                                    <input type="text" name="num"
                                           id="receive_detail_num"
                                           onblur="refreshPurchaseDetailTotal()"
                                           data-dojo-type="dijit/form/NumberTextBox"
                                           data-dojo-props='required:true,trim:true,constraints:{places:0,min:1,max:2147483647}'/>
                                </td>
                            </tr>
                            <tr>
                                <td>购买价：</td>
                                <td>
                                    <input type="text" name="product_buy_price"
                                           id="receive_detail_product_buy_price"
                                           onblur="refreshPurchaseDetailTotal()"
                                           data-dojo-type="dijit/form/NumberTextBox"
                                           data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:0,max:999999999.99}'/>
                                </td>
                            </tr>
                            <tr>
                                <td>消费税率%：</td>
                                <td>
                                    <input type="text" name="product_buy_tax_rate"
                                           id="receive_detail_product_buy_tax_rate"
                                           style="width: 180px"
                                           onblur="refreshPurchaseDetailTotal()"
                                           data-dojo-type="dijit/form/NumberTextBox"
                                           data-dojo-props='required:true,trim:true,constraints:{pattern: "###.##",min:0,max:999.99}'/>
                                    <span>%</span>
                                </td>
                            </tr>
                            <tr>
                                <td>消费税：</td>
                                <td>
                                    <input type="text" disabled name="product_buy_tax"
                                           id="receive_detail_product_buy_tax"
                                           data-dojo-type="dijit/form/NumberTextBox"
                                           data-dojo-props='trim:true,constraints:{pattern: "#########.####",min:0,max:999999999.9999}'/>
                                </td>
                            </tr>
                            <tr>
                                <td>消费税总额：</td>
                                <td>
                                    <input disabled type="text" name="product_buy_tax_amount"
                                           id="receive_detail_product_buy_tax_amount"
                                           data-dojo-type="dijit/form/NumberTextBox"
                                           data-dojo-props='trim:true,constraints:{pattern: "#########.####",min:0,max:999999999.9999}'/>
                                </td>
                            </tr>
                            <tr>
                                <td>商品金额：</td>
                                <td>
                                    <input disabled type="text" name="product_buy_amount"
                                           id="receive_detail_product_buy_amount"
                                           data-dojo-type="dijit/form/NumberTextBox"
                                           data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:0,max:999999999.99}'/>
                                </td>
                            </tr>
                            <tr>
                                <td>重量：</td>
                                <td>
                                    <input type="text" name="product_weight"
                                           id = "receive_detail_product_weight"
                                           onblur="refreshPurchaseDetailTotalWeight()"
                                           id="receive_detail_product_weight"
                                           data-dojo-type="dijit/form/NumberTextBox"
                                           data-dojo-props='trim:true, constraints:{pattern: "#########.####",min:0.0001,max:999999999.9999}'/>
                                </td>
                            </tr>
                            <tr>
                                <td>商品总重：</td>
                                <td>
                                    <input type="text" disabled name="total_weight"
                                           id="receive_detail_total_weight"
                                           data-dojo-type="dijit/form/NumberTextBox"
                                           data-dojo-props='trim:true'/>
                                </td>
                            </tr>
                            <tr>
                                <td>保质期：</td>
                                <td>
                                    <input type="text" name="product_life"
                                           style="width: 180px"
                                           id="receive_detail_product_life"
                                           data-dojo-type="dijit/form/NumberTextBox"
                                           data-dojo-props='required:true,trim:true,constraints:{places:0,min:0,max:999999999}'/>
                                    <span>天</span>
                                </td>
                            </tr>
                            <tr>
                                <td>生产日期：</td>
                                <td>
                                    <input type="text" name="product_date"
                                           id="receive_detail_product_date"
                                           data-dojo-type="dijit/form/DateTextBox"
                                           data-dojo-props='required:true,constraints:{datePattern:"yyyy-MM-dd", strict:true}'/>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </td>
            </tr>
        </table>
    </form>
    <input type="hidden" id="detail_edit_operate" name="detail_operate" />
    <table border="0">
        <tr>
            <td valign="top">
                图片选择：
            </td>
            <td>
                <div id="receive_detail_product_image_div">

                </div>
            </td>
        </tr>
        <tr>
            <td valign="top">
                属性选择：
            </td>
            <td>
                <div id="receive_detail_product_attribute_container"></div>
            </td>
        </tr>
    </table>
</div>
<div style="text-align:center">
    <button data-dojo-type="dijit/form/Button" onclick="saveReceiveDetailData('receive_detail_edit_form');" type="button">保存</button>
    <button data-dojo-type="dijit/form/Button" style="padding-left: 50px;" onclick="closeReceiveDetailDialog('receive_detail_edit_form')" type="button">关闭</button>
</div>
