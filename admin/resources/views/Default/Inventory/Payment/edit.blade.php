<div data-dojo-type="dijit/layout/BorderContainer" style="width: 100%; height: 100%;" data-dojo-props="gutters:false">
    <div data-dojo-type="dijit/layout/ContentPane" region="center">
        <form data-dojo-type="dojox/form/Manager" action="Payment/save" method="post"
        id="inventory_i_payment_edit_form" data-dojo-id="inventory_i_payment_edit_form">
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
                    <td>采购订单号：</td>
                    <td>
                        <input type="text" name="purchase_order_id" value="<?php echo $obj['purchase_order_id']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true"/>
                    </td>
                </tr>
                <tr>
                    <td>支付方式：</td>
                    <td>
                        <input type="text" name="pay_type" value="<?php echo $obj['pay_type']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:1"/>
                    </td>
                </tr>
                <tr>
                    <td>支付：</td>
                    <td>
                        <input type="text" name="pay" value="<?php echo $obj['pay']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:-999999999.99,max:999999999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>流水号：</td>
                    <td>
                        <input type="text" name="serial_number" value="<?php echo $obj['serial_number']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:36"/>
                    </td>
                </tr>
                <tr>
                    <td>留存图片：</td>
                    <td>
                        <input type="text" name="image" value="<?php echo $obj['image']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:50"/>
                    </td>
                </tr>
                <tr>
                    <td>create_time：</td>
                    <td>
                        <input type="text" name="create_time" value="<?php echo $obj['create_time']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:"/>
                    </td>
                </tr>
            </table>
            </fieldset>
        </form>
    </div>
    <div data-dojo-type="dijit/layout/ContentPane" region="bottom">
        <div style="text-align:center">
            <button data-dojo-type="dijit/form/Button" onclick="submitFormData('inventory_i_payment_edit_form')" type="button">保存</button>
            <button data-dojo-type="dijit/form/Button" style="padding-left: 50px;" type="button"
                onclick="closeSingleEditTab();">关闭</button>
        </div>
    </div>
</div>
