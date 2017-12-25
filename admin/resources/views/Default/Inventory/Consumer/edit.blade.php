<div data-dojo-type="dijit/layout/BorderContainer" style="width: 100%; height: 100%;" data-dojo-props="gutters:false">
    <div data-dojo-type="dijit/layout/ContentPane" region="center">
        <form data-dojo-type="dojox/form/Manager" action="Consumer/save" method="post"
        id="inventory_i_consumer_edit_form" data-dojo-id="inventory_i_consumer_edit_form">
            <input type="hidden" name="id" value="<?php echo $obj['id']; ?>" />
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
            <input type="hidden" name="operate" value="<?php echo $operate; ?>"/>
            <fieldset style="width: 800px" data-dojo-type="dijit/Fieldset">
            <legend></legend>
            <table border="0">
                <tr>
                    <td>编号：</td>
                    <td>
                        <input type="text" name="code" value="<?php echo $obj['code']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:16"/>
                    </td>
                </tr>
                <tr>
                    <td>姓名：</td>
                    <td>
                        <input type="text" name="name" value="<?php echo $obj['name']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:20"/>
                    </td>
                </tr>
                <tr>
                    <td>手机：</td>
                    <td>
                        <input type="text" name="mobile" value="<?php echo $obj['mobile']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:20"/>
                    </td>
                </tr>
                <tr>
                    <td>电话：</td>
                    <td>
                        <input type="text" name="phone" value="<?php echo $obj['phone']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:20"/>
                    </td>
                </tr>
                <tr>
                    <td>email：</td>
                    <td>
                        <input type="text" name="email" value="<?php echo $obj['email']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:50"/>
                    </td>
                </tr>
                <tr>
                    <td>qq：</td>
                    <td>
                        <input type="text" name="qq" value="<?php echo $obj['qq']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:20"/>
                    </td>
                </tr>
                <tr>
                    <td>微信：</td>
                    <td>
                        <input type="text" name="wechat" value="<?php echo $obj['wechat']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:20"/>
                    </td>
                </tr>
                <tr>
                    <td>性别：</td>
                    <td>
                        <input type="text" name="gender" value="<?php echo $obj['gender']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:1"/>
                    </td>
                </tr>
                <tr>
                    <td>生日：</td>
                    <td>
                        <input type="text" name="birthday" value="<?php echo $obj['birthday']; ?>"
                        data-dojo-type="dijit/form/DateTextBox"
                        data-dojo-props="trim:true"/>
                    </td>
                </tr>
                <tr>
                    <td>省：</td>
                    <td>
                        <input type="text" name="province" value="<?php echo $obj['province']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{places:0,min:0,max:2147483647}'/>
                    </td>
                </tr>
                <tr>
                    <td>市：</td>
                    <td>
                        <input type="text" name="city" value="<?php echo $obj['city']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{places:0,min:0,max:2147483647}'/>
                    </td>
                </tr>
                <tr>
                    <td>地区：</td>
                    <td>
                        <input type="text" name="area" value="<?php echo $obj['area']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{places:0,min:0,max:2147483647}'/>
                    </td>
                </tr>
                <tr>
                    <td>地址：</td>
                    <td>
                        <input type="text" name="address" value="<?php echo $obj['address']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:100"/>
                    </td>
                </tr>
                <tr>
                    <td>邮编：</td>
                    <td>
                        <input type="text" name="post_code" value="<?php echo $obj['post_code']; ?>"
                        data-dojo-type="dijit/form/ValidationTextBox"
                        data-dojo-props="required:true,trim:true,maxLength:20"/>
                    </td>
                </tr>
                <tr>
                    <td>状态：</td>
                    <td>
                        <input type="text" name="status" value="<?php echo $obj['status']; ?>"
                        data-dojo-type="dijit/form/NumberTextBox"
                        data-dojo-props='required:true,trim:true,constraints:{places:0,min:0,max:32767}'/>
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
            <button data-dojo-type="dijit/form/Button" onclick="submitFormData('inventory_i_consumer_edit_form')" type="button">保存</button>
            <button data-dojo-type="dijit/form/Button" style="padding-left: 50px;" type="button"
                onclick="closeSingleEditTab();">关闭</button>
        </div>
    </div>
</div>
