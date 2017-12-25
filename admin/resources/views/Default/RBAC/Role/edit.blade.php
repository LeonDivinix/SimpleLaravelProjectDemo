<div style="width: 100%; height: 100%;">
    <div data-dojo-type="dijit/layout/BorderContainer" design="headline" data-dojo-props="gutters:false" style="width: 100%; height: 100%;" data-dojo-attach-point="outerBC">
        <div data-dojo-type="dijit/layout/ContentPane" region="center">
            <div  style="padding-top: 10px;">
                <form data-dojo-type="dojox/form/Manager" id="admin_role_edit_form" action="Role/save" method="post"  data-dojo-id="admin_role_edit_form">
                    <input type="hidden" name="id" value="<?php echo $obj['id']; ?>" />
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                    <input type="hidden" name="operate" value="<?php echo $operate; ?>"/>
                    <fieldset style="width: 800px" data-dojo-type="dijit/Fieldset">
                        <legend>角色信息</legend>
                        <table border="0">
                            <tr>
                                <td class="tableContainer-labelCell editLabelsAndValues-labelCell" style="width: 130px">角色名称：</td>
                                <td>
                                    <input type="text" name="title" value="<?php echo $obj['title']; ?>"
                                        data-dojo-type="dijit/form/ValidationTextBox" data-dojo-props="required:true,trim:true,maxLength:50" />
                                </td>
                            </tr>

                            <tr>
                                <td class="tableContainer-labelCell editLabelsAndValues-labelCell" >序号：</td>
                                <td>
                                    <input type="text" name="sort" value="<?php echo $obj['sort']; ?>"
                                        data-dojo-type="dijit/form/NumberTextBox" data-dojo-props="required:true,trim:true,constraints:{places:0}"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="tableContainer-labelCell editLabelsAndValues-labelCell" >备注：</td>
                                <td>
                                    <input type="text" name="remark" value="<?php echo $obj['remark']; ?>"
                                           data-dojo-type="dijit/form/TextBox" data-dojo-props="trim:true,maxLength:100" />
                                </td>
                            </tr>
                            <tr>
                                <td class="tableContainer-labelCell editLabelsAndValues-labelCell" >状态：</td>
                                <td>
                                    <select name="status" data-dojo-type="dijit/form/Select">
                                        <option value="1" >开启</option>
                                        <option value="0" <?php if (0 === $obj['status']) echo 'selected="selected"'; ?> >关闭</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </fieldset>

                    <fieldset style="width: 800px" data-dojo-type="dijit/Fieldset">
                        <legend>权限信息</legend>
                        <input type="hidden" name="role_menu_prefix" value="admin_menu_" />
                        <?php foreach ($menuList as $v) { ?>
                            <div style="padding-top: 5px;width: 790px;" data-dojo-type="dijit/TitlePane"
                                data-dojo-props="title: '<?php echo $v["title"]; ?>', open:true">
                                <table class="admin_line_table">
                                <?php foreach($v["children"] as $c) { ?>
                                    <tr>
                                        <td width="150">&nbsp;
                                    <?php echo $c["title"], '(', $c["tag"], ')'; ?>
                                        </td>
                                        <td width="300">&nbsp;
                                            <input data-dojo-type="dijit/form/CheckBox"
                                                   id="admin_menu_<?php echo $c["id"] ?>_0"
                                                <?php
                                                    if (isset($roleMenuMap[$c["id"]])) {
                                                        echo " checked";
                                                    }
                                                ?>
                                                   name="admin_menu_<?php echo $c["id"] ?>_0"  value="1" />
                                            <label for="admin_menu_<?php echo $c["id"] ?>_0">查询</label>
                                            <?php foreach(\Library\Constant\ConfigConstant::$ADMIN_PERMISSION as $k => $p) { ?>
                                                <input data-dojo-type="dijit/form/CheckBox"
                                                   id="admin_menu_<?php echo $c["id"]; ?>_<?php echo $k ?>"
                                                   name="admin_menu_<?php echo $c["id"]; ?>_<?php echo $k ?>"
                                                   <?php
                                                       if (($c["tag"] & $k) != $k) {
                                                           echo "disabled";
                                                       }
                                                       else if (isset($roleMenuMap[$c["id"]])) {
                                                           if (($roleMenuMap[$c["id"]] & $k) == $k ) {
                                                               echo "checked";
                                                           }
                                                       }
                                                   ?>
                                                   value="1" />
                                                <label for="admin_menu_<?php echo $c["id"]; ?>_<?php echo $k ?>"><?php echo $p ?></label>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </table>
                            </div>
                        <?php } ?>
                    </fieldset>
                </form>
            </div>
        </div>
        <div data-dojo-type="dijit/layout/ContentPane" region="bottom">
            <div style="text-align:center" class="">
                <button data-dojo-type="dijit/form/Button" style="padding-left: 50px" onclick="submitFormData('admin_role_edit_form')" type="button">保存</button>
                <button data-dojo-type="dijit/form/Button" style="padding-left: 50px" onclick="closeSingleEditTab();" type="button">关闭</button>
            </div>
        </div>
    </div>
</div>
