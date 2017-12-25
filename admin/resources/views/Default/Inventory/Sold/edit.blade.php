<div data-dojo-type="dijit/layout/BorderContainer" style="width: 100%; height: 100%;" data-dojo-props="gutters:false">
    <div data-dojo-type="dijit/layout/ContentPane" region="center">
        <form data-dojo-type="dojox/form/Manager" action="Sold/save" method="post"
        id="inventory_i_sold_edit_form" data-dojo-id="inventory_i_sold_edit_form">
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
                    <td>编号：</td>
                    <td>
                        <input type="text" name="code" value="<?php echo $obj['code']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:36"/>
                    </td>
                </tr>
                <tr>
                    <td>成本金额：</td>
                    <td>
                        <input type="text" name="cost" value="<?php echo $obj['cost']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:-999999999.99,max:999999999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>商品金额：</td>
                    <td>
                        <input type="text" name="amount" value="<?php echo $obj['amount']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:-999999999.99,max:999999999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>快递金额：</td>
                    <td>
                        <input type="text" name="express_amount" value="<?php echo $obj['express_amount']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:-999999999.99,max:999999999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>税金额：</td>
                    <td>
                        <input type="text" name="tax_amount" value="<?php echo $obj['tax_amount']; ?>"
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
                    <td>是否包邮：</td>
                    <td>
                        <input type="text" name="express_flag" value="<?php echo $obj['express_flag']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:1"/>
                    </td>
                </tr>
                <tr>
                    <td>毛利：</td>
                    <td>
                        <input type="text" name="profit" value="<?php echo $obj['profit']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:-999999999.99,max:999999999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>总重量：</td>
                    <td>
                        <input type="text" name="total_weight" value="<?php echo $obj['total_weight']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{pattern: "#########.##",min:-999999999.99,max:999999999.99}'/>
                    </td>
                </tr>
                <tr>
                    <td>客户id：</td>
                    <td>
                        <input type="text" name="consumer_id" value="<?php echo $obj['consumer_id']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true"/>
                    </td>
                </tr>
                <tr>
                    <td>快递图片留存：</td>
                    <td>
                        <input type="text" name="express_pic" value="<?php echo $obj['express_pic']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:20"/>
                    </td>
                </tr>
                <tr>
                    <td>客户地址：</td>
                    <td>
                        <input type="text" name="address" value="<?php echo $obj['address']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:100"/>
                    </td>
                </tr>
                <tr>
                    <td>客户联系方式：</td>
                    <td>
                        <input type="text" name="contact" value="<?php echo $obj['contact']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:20"/>
                    </td>
                </tr>
                <tr>
                    <td>状态：</td>
                    <td>
                        <select name="status" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                            <option value="">请选择</option>
                            <option value="0" <?php if (0 === $obj['status']) echo 'selected="selected"'; ?> >初始</option>
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
            <button data-dojo-type="dijit/form/Button" onclick="submitFormData('inventory_i_sold_edit_form')" type="button">保存</button>
            <button data-dojo-type="dijit/form/Button" style="padding-left: 50px;" type="button"
                onclick="closeSingleEditTab();">关闭</button>
        </div>
    </div>
</div>
