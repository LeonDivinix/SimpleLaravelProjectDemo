<div data-dojo-type="dijit/layout/BorderContainer" style="width: 100%; height: 100%;" data-dojo-props="gutters:false">
    <div data-dojo-type="dijit/layout/ContentPane" region="center">
        <form data-dojo-type="dojox/form/Manager" id="admin_user_edit_form" action="User/save" method="post"  data-dojo-id="admin_user_edit_form">
            <input type="hidden" name="id" value="<?php echo isset($obj['id']) ?  $obj['id'] : ""; ?>" />
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
            <input type="hidden" name="operate" value="<?php echo $operate; ?>"/>
            <fieldset style="width: 800px" data-dojo-type="dijit/Fieldset">
                <legend></legend>
                <table border="0">
                    <tr>
                        <td style="width: 100px">状态：</td>
                        <td>
                            <select name="status" data-dojo-type="dijit/form/Select">
                                <option value="1">正常</option>
                                <option value="0" <?php if($obj['status'] === 0) echo 'selected="selected"'; ?> >停用</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td  >角色：</td>
                        <td>
                            <select name="role_id" data-dojo-type="dijit/form/Select" data-dojo-props="required:true">
                                <option value="">请选择</option>
                                <?php foreach($obj["roles"] as $v) { ?>
                                <option value="<?php echo $v['id']; ?>" <?php if ($v['id'] == $obj['role_id']) echo 'selected="selected"'; ?> >
                                    <?php echo $v['title']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td  >生日：</td>
                        <td>
                            <input type="text" name="birth" value="<?php echo $obj['birth']; ?>"
                                   data-dojo-type="dijit/form/DateTextBox"
                                   data-dojo-props='trim:true' />
                        </td>
                    </tr>
                </table>
            </fieldset>
            <fieldset style="width: 800px" data-dojo-type="dijit/Fieldset">
            <legend></legend>
                <table border="0">
                    <tr>
                        <td style="width: 100px">登录名：</td>
                        <td>
                            <input type="text" name="name" value="<?php echo $obj['name']; ?>"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="required:true,trim:true,maxLength:20" />
                        </td>
                    </tr>
                    <tr>
                        <td  >工号：</td>
                        <td>
                            <input type="text" name="code" value="<?php echo $obj['code']; ?>"
                                   data-dojo-type="dijit/form/TextBox"
                                   data-dojo-props="trim:true,maxLength:10" />
                        </td>
                    </tr>
                    <tr>
                        <td  >真实姓名：</td>
                        <td>
                            <input type="text" name="real_name" value="<?php echo $obj['real_name']; ?>"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="required:true,trim:true,maxLength:50" />
                        </td>
                    </tr>
                    <tr>
                        <td  >密码：</td>
                        <td>
                            <input type="text" name="password"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="<?php if (empty($obj["id"])) echo "required:true,"; ?> trim:true,maxLength:32" />
                        </td>
                    </tr>
                    <tr>
                        <td  >分机号：</td>
                        <td>
                            <input type="text" name="phone" value="<?php echo $obj['phone']; ?>"
                                   data-dojo-type="dijit/form/TextBox"
                                   data-dojo-props="trim:true,maxLength:20" />
                        </td>
                    </tr>
                    <tr>
                        <td  >手机号：</td>
                        <td>
                            <input type="text" name="mobile" value="<?php echo $obj['mobile']; ?>"
                                   data-dojo-type="dijit/form/TextBox"
                                   data-dojo-props='trim:true,maxLength:15' />
                        </td>
                    </tr>
                    <tr>
                        <td  >Email：</td>
                        <td>
                            <input type="text" name="email" value="<?php echo $obj['email']; ?>"
                                   data-dojo-type="dijit/form/TextBox"
                                   data-dojo-props="trim:true,maxLength:50" />
                        </td>
                    </tr>
                    <tr>
                        <td  >联系地址：</td>
                        <td>
                            <textarea name="remark" rows="6" cols="27"
                                      data-dojo-type="dijit/form/Textarea"
                                      data-dojo-props="trim:true,maxLength:100">
                                <?php echo $obj['address']; ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td  >备注：</td>
                        <td>
                            <textarea name="remark" rows="6" cols="27"
                                      data-dojo-type="dijit/form/Textarea"
                                      data-dojo-props="trim:true,maxLength:100">
                                <?php echo $obj['remark']; ?>
                            </textarea>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>
    <div data-dojo-type="dijit/layout/ContentPane" region="bottom">
        <div style="text-align:center">
            <button data-dojo-type="dijit/form/Button" onclick="submitFormData('admin_user_edit_form')" type="button">保存</button>
            <button data-dojo-type="dijit/form/Button" onclick="closeSingleEditTab();" type="button">关闭</button>
        </div>
    </div>
</div>