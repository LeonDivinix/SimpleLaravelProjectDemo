<div data-dojo-type="dijit/layout/BorderContainer" style="width: 100%; height: 100%;" data-dojo-props="gutters:false">
    <div data-dojo-type="dijit/layout/ContentPane" region="center">
        <form data-dojo-type="dojox/form/Manager" action="Supplier/save" method="post"
              id="inventory_supplier_edit_form" data-dojo-id="inventory_supplier_edit_form">
            <input type="hidden" name="id" value="<?php echo $obj['id']; ?>" />
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
            <input type="hidden" name="operate" value="<?php echo $operate; ?>"/>
            <fieldset style="width: 800px" data-dojo-type="dijit/Fieldset">
                <legend></legend>
                <table border="0">
                    <tr>
                        <td>状态：</td>
                        <td>
                            <select name="status" data-dojo-type="dijit/form/Select">
                                <option value="1" >开启</option>
                                <option value="0" <?php if (0 === $obj['status']) echo 'selected="selected"'; ?> >关闭</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>类型：</td>
                        <td>
                            <select name="type" data-dojo-type="dijit/form/Select">
                                <option value="0">个人</option>
                                <option value="1" <?php if (1 === $obj['type']) echo 'selected="selected"'; ?> >公司</option>
                            </select>
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
                        <td>名称：</td>
                        <td>
                            <input type="text" name="name" value="<?php echo $obj['name']; ?>"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="required:true,trim:true,maxLength:50"/>
                        </td>
                    </tr>
                    <tr>
                        <td>简称：</td>
                        <td>
                            <input type="text" name="short_name" value="<?php echo $obj['short_name']; ?>"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="trim:true,maxLength:20"/>
                        </td>
                    </tr>
                    <tr>
                        <td>联系人：</td>
                        <td>
                            <input type="text" name="linkman" value="<?php echo $obj['linkman']; ?>"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="required:true,trim:true,maxLength:50"/>
                        </td>
                    </tr>
                    <tr>
                        <td>图片：</td>
                        <td>
                            <input type="text" name="image" value="<?php echo $obj['image']; ?>"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="maxLength:50"/>
                        </td>
                    </tr>
                    <tr>
                        <td>手机：</td>
                        <td>
                            <input type="text" name="mobile" value="<?php echo $obj['mobile']; ?>"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="required:true,trim:true,maxLength:50"/>
                        </td>
                    </tr>
                    <tr>
                        <td>电话：</td>
                        <td>
                            <input type="text" name="phone" value="<?php echo $obj['phone']; ?>"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="required:true,trim:true,maxLength:50"/>
                        </td>
                    </tr>
                    <tr>
                        <td>email：</td>
                        <td>
                            <input type="text" name="email" value="<?php echo $obj['email']; ?>"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="maxLength:50"/>
                        </td>
                    </tr>
                    <tr>
                        <td>微信：</td>
                        <td>
                            <input type="text" name="wechat" value="<?php echo $obj['wechat']; ?>"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="maxLength:50"/>
                        </td>
                    </tr>
                    <tr>
                        <td>支付宝：</td>
                        <td>
                            <input type="text" name="alipay" value="<?php echo $obj['alipay']; ?>"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="maxLength:50"/>
                        </td>
                    </tr>
                    <tr>
                        <td>账户：</td>
                        <td>
                            <input type="text" name="account" value="<?php echo $obj['account']; ?>"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="maxLength:50"/>
                        </td>
                    </tr>
                    <tr>
                        <td>开户行：</td>
                        <td>
                            <input type="text" name="bank" value="<?php echo $obj['bank']; ?>"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="maxLength:50"/>
                        </td>
                    </tr>
                    <tr>
                        <td>地址：</td>
                        <td>
                            <input type="text" name="address" value="<?php echo $obj['address']; ?>"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="trim:true,maxLength:50"/>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>
    <div data-dojo-type="dijit/layout/ContentPane" region="bottom">
        <div style="text-align:center">
            <button data-dojo-type="dijit/form/Button" onclick="submitFormData('inventory_supplier_edit_form')" type="button">保存</button>
            <button data-dojo-type="dijit/form/Button" onclick="closeSingleEditTab();" type="button">关闭</button>
        </div>
    </div>
</div>