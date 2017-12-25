<div data-dojo-type="dijit/layout/BorderContainer" style="width: 100%; height: 100%;" data-dojo-props="gutters:false">
    <div data-dojo-type="dijit/layout/ContentPane" region="center">
        <form data-dojo-type="dojox/form/Manager" action="PurchaseOrder/save" method="post"
        id="inventory_i_purchase_order_edit_form" data-dojo-id="inventory_i_purchase_order_edit_form">
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
                    <td>purchase_id：</td>
                    <td>
                        <input type="text" name="purchase_id" value="<?php echo $obj['purchase_id']; ?>"
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
                    <td>供应商：</td>
                    <td>
                        <input type="text" name="supplier" value="<?php echo $obj['supplier']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true"/>
                    </td>
                </tr>
                <tr>
                    <td>标题说明：</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $obj['title']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:50"/>
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
                    <td>采购商品金额：</td>
                    <td>
                        <input type="text" name="buy_amount" value="<?php echo $obj['buy_amount']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:-999999999.99,max:999999999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>快递费用：</td>
                    <td>
                        <input type="text" name="express_amount" value="<?php echo $obj['express_amount']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:-999999999.99,max:999999999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>消费税金额：</td>
                    <td>
                        <input type="text" name="buy_tax_amount" value="<?php echo $obj['buy_tax_amount']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:-999999999.99,max:999999999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>总金额：</td>
                    <td>
                        <input type="text" name="total_amount" value="<?php echo $obj['total_amount']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:-999999999.99,max:999999999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>人民币汇率：</td>
                    <td>
                        <input type="text" name="exchange_rate" value="<?php echo $obj['exchange_rate']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.####",min:-999999999.9999,max:999999999.9999}'/>
                    </td>
                </tr>
                <tr>
                    <td>支付总金额：</td>
                    <td>
                        <input type="text" name="pay_amount" value="<?php echo $obj['pay_amount']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:-999999999.99,max:999999999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>支付状态：</td>
                    <td>
                        <select name="pay_status" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                            <option value="">请选择</option>
                            <option value="0" <?php if (0 === $obj['pay_status']) echo 'selected="selected"'; ?> >初始</option>
                            <option value="5" <?php if (5 === $obj['pay_status']) echo 'selected="selected"'; ?> >部分支付</option>
                            <option value="6" <?php if (6 === $obj['pay_status']) echo 'selected="selected"'; ?> >已支付</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>已付：</td>
                    <td>
                        <input type="text" name="have_pay" value="<?php echo $obj['have_pay']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:-999999999.99,max:999999999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>状态：</td>
                    <td>
                        <select name="status" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                            <option value="">请选择</option>
                            <option value="0" <?php if (0 === $obj['status']) echo 'selected="selected"'; ?> >作废</option>
                            <option value="1" <?php if (1 === $obj['status']) echo 'selected="selected"'; ?> >正常</option>
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
            <button data-dojo-type="dijit/form/Button" onclick="submitFormData('inventory_i_purchase_order_edit_form')" type="button">保存</button>
            <button data-dojo-type="dijit/form/Button" style="padding-left: 50px;" type="button"
                onclick="closeSingleEditTab();">关闭</button>
        </div>
    </div>
</div>
