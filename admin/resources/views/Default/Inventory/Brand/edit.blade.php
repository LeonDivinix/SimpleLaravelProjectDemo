<div data-dojo-type="dijit/layout/BorderContainer" style="width: 100%; height: 100%;" data-dojo-props="gutters:false">
    <div data-dojo-type="dijit/layout/ContentPane" region="center">
        <form data-dojo-type="dojox/form/Manager" action="Brand/save" method="post"
              id="inventory_brand_edit_form" data-dojo-id="inventory_brand_edit_form">
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
                                   data-dojo-props="required:true,trim:true,minLength:6,maxLength:6"/>
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
                        <td>图片：</td>
                        <td>
                            <input type="text" name="image" value="<?php echo $obj['image']; ?>"
                                   data-dojo-type="dijit/form/ValidationTextBox"
                                   data-dojo-props="trim:true,maxLength:50"/>
                            <div id="ttht_item_edit_icon_sel" class="admin_uploadBtn">选择图片</div>
                        </td>
                    </tr>
                    <tr>
                        <td>状态：</td>
                        <td>
                            <select name="status" data-dojo-type="dijit/form/Select">
                                <option value="1">开启</option>
                                <option value="0" <?php if (0 === $obj['status']) echo 'selected="selected"'; ?> >关闭</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>
    <div data-dojo-type="dijit/layout/ContentPane" region="bottom">
        <div style="text-align:center">
            <button data-dojo-type="dijit/form/Button" onclick="submitFormData('inventory_brand_edit_form')" type="button">保存</button>
            <button data-dojo-type="dijit/form/Button" style="padding-left: 50px;" onclick="closeSingleEditTab();"
                type="button">关闭</button>
        </div>
    </div>
</div>
<script>
    require([
                "dojox/form/FileUploader"
            ],
            function(
                    FileUploader) {
                var fileMask = [
                    ["Jpeg File",  "*.jpg;*.jpeg"],
                    ["GIF File",   "*.gif"],
                    ["PNG File",   "*.png"]
                ];

                // 背景图
                var headUploader = new FileUploader({
                    uploadUrl:"/Brand/Upload",
                    uploadOnChange:true,
                    selectMultipleFiles:false,
                    fileMask:fileMask,
                    isDebug:false,
                    devMode:false
                }, "ttht_item_edit_icon_sel");
                dojo.connect(headUploader, "onComplete", function(dataArray){
                    console.info(dataArray);
//                    var result = dataArray[0].additionalParams;
//                    if (0 == result.status) {
//                        dojoDom.byId("ttht_item_edit_icon_div").innerHTML = '<a href="' + result.url
//                                + '" target="_blank"><img src="' + result.url
//                                + '?v=' + (new Date()).getTime() + '" height="40" > </a>';
//                        dojoDom.byId("ttht_item_edit_icon").value = dataArray[0].file;
//                        ttht_room_edit_bg_img = dataArray[0].file;
//                        ttht_item_edit_icon = dataArray[0].file;
//                    }
//                    else if (result.status > 900) {
//                        location.href = result.message;
//                    }
//                    else {
//                        Toast.error(result.message);
//                    }
                });

            });
</script>