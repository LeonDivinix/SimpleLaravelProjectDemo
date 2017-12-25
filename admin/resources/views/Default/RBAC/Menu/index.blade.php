<div data-dojo-type="dijit/layout/BorderContainer" data-dojo-props="gutters:true, liveSplitters:false">
    <div style="width: 400px" data-dojo-type="dijit/layout/ContentPane" data-dojo-props="region:'left', splitter:false">
        <div>
            <button data-dojo-type="dijit/form/Button" type="button" onclick="refreshAdminMenuTree();" >刷新</button>
            <button data-dojo-type="dijit/form/Button" type="button" onclick="expandAdminMenuTree();" >展开</button>
            <button data-dojo-type="dijit/form/Button" type="button" onclick="collapseAdminMenuTree();" >折叠</button>
            <span style="color: darkgray">右键点击条目进行增加或修改操作</span>
        </div>
        <div id="admin_menu_tree_div"></div>
    </div> <!-- menu -->
    <div data-dojo-type="dijit/layout/ContentPane" data-dojo-props="region:'center', tabStrip:true">
        <div style="height: 30px;">
            &nbsp;
        </div>
        <table id="admin_menu_table" class="grid_info_table" style="display: none">
            <thead>
            <tr>
                <th>
                    条目
                </th>
                <th>
                    内容
                </th>
            </tr>
            </thead>
            <tbody>
            <tr id="admin_menu_tr_type" style="display: none">
                <td><label for="admin_menu_span_type" >上级：</label></td>
                <td>
                    <span id="admin_menu_span_type"></span>
                </td>
            </tr>
            <tr>
                <td><label for="admin_menu_span_id">id：</label></td>
                <td>
                    <span id="admin_menu_span_id"></span>
                </td>
            </tr>
            <tr>
                <td><label for="admin_menu_span_title">标题：</label></td>
                <td>
                    <span id="admin_menu_span_title"></span>
                </td>
            </tr>
            <tr>
                <td><label for="admin_menu_span_level">级别：</label></td>
                <td>
                    <span id="admin_menu_span_level"></span>
                </td>
            </tr>
            <tr id="admin_menu_span_url_tr">
                <td><label for="admin_menu_span_url">链接：</label></td>
                <td>
                    <span id="admin_menu_span_url"></span>
                </td>
            </tr>
            <tr id="admin_menu_span_tag_tr">
                <td><label for="admin_menu_span_tag">权限标签：</label></td>
                <td>
                    <span id="admin_menu_span_tag"></span>
                </td>
            </tr>
            <tr id="admin_menu_span_map_tr">
                <td><label for="admin_menu_span_map">映射表：</label></td>
                <td>
                    <span id="admin_menu_span_map"></span>
                </td>
            </tr>
            <tr>
                <td ><label for="admin_menu_span_status">状态(0关闭1开启)：</label></td>
                <td>
                    <span id="admin_menu_span_status"></span>
                </td>
            </tr>
            <tr>
                <td><label for="admin_menu_span_sort">排序：</label></td>
                <td>
                    <span id="admin_menu_span_sort"></span>
                </td>
            </tr>
            <tr>
                <td><label for="admin_menu_span_remark">备注：</label></td>
                <td>
                    <div id="admin_menu_span_remark" style="width: 300px;"></div>
                </td>
            </tr>
            <tr>
                <td><label for="admin_menu_span_create_at">创建时间：</label></td>
                <td>
                    <div id="admin_menu_span_create_at" style="width: 300px;"></div>
                </td>
            </tr>
            <tr>
                <td><label for="admin_menu_span_create_by">创建人：</label></td>
                <td>
                    <div id="admin_menu_span_create_by" style="width: 300px;"></div>
                </td>
            </tr>
            <tr>
                <td><label for="admin_menu_span_update_at">修改时间：</label></td>
                <td>
                    <div id="admin_menu_span_update_at" style="width: 300px;"></div>
                </td>
            </tr>
            <tr>
                <td><label for="admin_menu_span_update_by">修改人：</label></td>
                <td>
                    <div id="admin_menu_span_update_by" style="width: 300px;"></div>
                </td>
            </tr>
            </tbody>
        </table>
    </div><!-- end TabContainer -->
</div><!-- end BorderContainer -->

<script>
    var admin_menu_edit_adminPermition = <?php echo json_encode(\Library\Constant\ConfigConstant::$ADMIN_PERMISSION) ?>;
    function refreshAdminMenuTree() {
        hideElement("admin_menu_table");
        dijit.byId("admin_menu_tree").destroyRecursive();
        dojoDom.byId("admin_menu_tree_div").innerHTML = "";
        buildAdminMenuTree();
    }

    function expandAdminMenuTree() {
        dijit.byId("admin_menu_tree").expandAll();
    }

    function collapseAdminMenuTree() {
        hideElement("admin_menu_table");
        dijit.byId("admin_menu_tree").collapseAll();
    }


</script>
<script>
    function buildAdminMenuTree() {
        require([
            "dojo/store/Memory",
            "dojo/store/Observable",
            "dijit/tree/ObjectStoreModel",
            "dijit/Tree",
            "dijit/Menu",
            "dijit/MenuItem",
            "dijit/MenuSeparator",
            "dijit/registry",
            "dojo/request",
            "dojo/domReady!"
        ], function(Memory, Observable, ObjectStoreModel, Tree, Menu, MenuItem, MenuSeparator, registry, request) {
            var buildTree = function(data) {
                var myStore = new Memory({
                    data: data,
                    getChildren: function(object) {
                        var result = [];
                        if (parseInt(object.level) < 2) {
                            result = this.query({pid: object.id});
                        }
                        return result;
                    }
                });

                // Wrap the store in Observable so that updates to the store are reflected to the Tree
                myStore = new Observable(myStore);

                var myModel = new ObjectStoreModel({
                    store: myStore,
                    labelAttr: "title",
                    query: { id: "ea6433bb-7a90-4e96-9c56-fa0cb64c8f57" },
                    mayHaveChildren: function(object) {
                        var result = true;
                        if (object.level > 1) {
                            result = false;
                        }
                        return result;
                    }
                });

                var tree = new Tree({
                    id: "admin_menu_tree",
                    model: myModel,
                    autoExpand: true,
                    getIconClass: function(item, opened) {
                        var result = "dijitLeaf";
                        if (item.level == 0) {
                            result = "dijitIconPackage";
                        }
                        else if (item.level < 2) {
                            result = (opened ? "dijitFolderOpened" : "dijitFolderClosed");
                        }
                        return result;
                    },
                    onClick: function() {
                        var item = tree.selectedItem;
                        if (item != undefined && item != null) {
                            showElement("admin_menu_table");
                            admin_menu_edit_refresh(item);
                            var pName = "";
                            if (item.level == 2) {
                                showElement("admin_menu_tr_type");
                                showElement("admin_menu_span_tag_tr");
                                showElement("admin_menu_span_map_tr");
                                showElement("admin_menu_span_url_tr");
                                var pItem = myStore.get(item.pid);
                                pName = pItem.title;
                                dojoDom.byId("admin_menu_span_type").innerHTML = pName;
                            }
                            else if (item.level == 1) {
                                showElement("admin_menu_tr_type");
                                hideElement("admin_menu_span_tag_tr");
                                hideElement("admin_menu_span_map_tr");
                                hideElement("admin_menu_span_url_tr");
                                dojoDom.byId("admin_menu_span_type").innerHTML = "根";
                            }
                            else {
                                hideElement("admin_menu_tr_type");
                                hideElement("admin_menu_span_tag_tr");
                                hideElement("admin_menu_span_map_tr");
                                hideElement("admin_menu_span_url_tr");
                                dojoDom.byId("admin_menu_span_type").innerHTML = "";
                            }
                        }
                    }
                });
                tree.placeAt("admin_menu_tree_div");
                tree.startup();

                <?php if ($canEdit) { ?>
                // 菜单
                var adminMenu = new Menu({
                    targetNodeIds: ["admin_menu_tree"],
                    selector: ".dijitTreeNode"
                });
                adminMenu.addChild(new MenuItem({
                    iconClass: "dijitIconNewTask",
                    label: "添加&nbsp;&nbsp;",
                    onClick: function(){
                        var item = registry.byNode(this.getParent().currentTarget).item;
                        if (item.level == 2) {
                            Toast.error("不能添加下级属性，请在上级目录添加！")
                        }
                        else {
                            toAdminMenuEditDialog({id:"", pid: item.id, parent_title: item.title, level: parseInt(item.level) + 1});
                        }
                    }
                }));
                adminMenu.addChild(new MenuItem({
                    iconClass: "dijitIconNewTask",
                    label: "复制&nbsp;&nbsp;",
                    onClick: function(){
                        var item = registry.byNode(this.getParent().currentTarget).item;
                        var copy = {id: ""};
                        for (var n in item) {
                            if (item.hasOwnProperty(n) && n != "id") {
                                copy[n] = item[n];
                            }
                        }
                        if (item.level == 0) {
                            Toast.error("能复制根分类！")
                        }
                        else {

                            toAdminMenuEditDialog(copy);
                        }
                    }
                }));
                adminMenu.addChild(new MenuItem({
                    iconClass: "dijitIconEditTask",
                    label: "修改&nbsp;&nbsp;",
                    onClick: function(event){
                        var item = registry.byNode(this.getParent().currentTarget).item;
                        if (item.level == 0) {
                            Toast.error("不能修改根分类！")
                        }
                        else {
                            toAdminMenuEditDialog(item);
                        }
                    }
                }));
                adminMenu.startup();
                <?php } ?>
            };

            request(
                    "/Menu/tree",
                    {
                        handleAs: "json",
                        method: "get",
                        timeout: 300000 // 5分钟过期
                    }
            ).then(
                    function (json) {
                        if (0 === json.flag) {
                            buildTree(json.result);
                        }
                        else if (999 == json.flag) {
                            location.href = json.message;
                        }
                        else {
                            Toast.error(json.message);
                        }
                    },
                    function (err) {
                        //
                    }
            );
        });
    }

    function admin_menu_edit_refresh(item) {
        var tmp;
        for (var n in item) {
            if (item.hasOwnProperty(n) && n != "tag") {
                tmp = dojoDom.byId("admin_menu_span_" + n);
                if (tmp != undefined) {
                    tmp.innerHTML = item[n];
                }
            }
        }

        if (item.hasOwnProperty("tag")) {
            var tagStr = "";
            for (var k in admin_menu_edit_adminPermition) {
                if (admin_menu_edit_adminPermition.hasOwnProperty(k)) {
                    if ((k & item.tag) == k) {
                        tagStr += '<span style="color: royalblue">' + admin_menu_edit_adminPermition[k]
                                + '&nbsp;</span>';
                    }
                    else {
                        tagStr += '<span style="color: darkgray">' + admin_menu_edit_adminPermition[k]
                                + '&nbsp;</span>';
                    }
                }
            }
            dojoDom.byId("admin_menu_span_tag").innerHTML = tagStr;
        }
    }
</script>
<script>
    function toAdminMenuEditDialog(item) {
        var prefix = "admin_menu_edit_";
        var showHide = ["url", "tag", "map"];
        var shLen = showHide.length;
        var ele;
        dijit.byId("admin_menu_edit_dialog").set("title", "修改");
        for (var n in item) {
            if (item.hasOwnProperty(n)) {
                if (n == "parent_title") {
                    var str = item[n] + " 添加子菜单";
                    dijit.byId("admin_menu_edit_dialog").set("title", str);
                }
                else if ("id" == n && item[n] == "") {
                    dijit.byId("admin_menu_edit_dialog").set("title", "复制");
                    ele = dijit.byId(prefix + n);
                    if (ele != undefined && ele != null && item.hasOwnProperty(n)) {
                        ele.set("value", item[n]);
                    }
                }
                else {
                    ele = dijit.byId(prefix + n);
                    if (ele != undefined && ele != null && item.hasOwnProperty(n) && n != "tag") {
                        ele.set("value", item[n]);
                    }
                }
            }
        }
        if (item.hasOwnProperty("tag")) {
            var tmp;
            for (var k in admin_menu_edit_adminPermition) {
                if (admin_menu_edit_adminPermition.hasOwnProperty(k)) {
                    if ((k & item.tag) == k) {
                        tmp = dijit.byId("admin_menu_edit_permission_" + k);
                        if (undefined != tmp) {
                            tmp.set("checked", true);
                        }
                    }
                }
            }
        }

        if (item.level == 1) {
            for (var i = 0; i < shLen; ++i) {
                hideElement(prefix + showHide[i] + "_tr");
            }
        }
        else {
            for (var j = 0; j < shLen; ++j) {
                showElement(prefix + showHide[j] + "_tr");
            }
        }
        admin_menu_edit_dialog.show();
    }

    function saveAdminMenu() {
        if (admin_menu_edit_form.validate()) {
            var insertFlag = dijit.byId('admin_menu_edit_id').get("value") == "";
            request(
                "/Menu/save",
                {
                    handleAs: "json",
                    method: "post",
                    data: admin_menu_edit_form.gatherFormValues(),
                    timeout: 300000 // 5分钟过期
                }
            ).then(
                function (json) {
                    if (0 === json.flag) {
                        var data = json.result;
                        var adminMenuTree = dijit.byId("admin_menu_tree");
                        if (insertFlag) {
                            adminMenuTree.model.store.add(data);
                        }
                        else {
                            adminMenuTree.model.store.put(data, {overwrite: true});
                            admin_menu_edit_refresh(data);
                        }
                        admin_menu_edit_form.reset();
                        admin_menu_edit_dialog.hide();

                    }
                    else if (999 == json.flag) {
                        location.href = json.message;
                    }
                    else {
                        Toast.error(json.message);
                    }
                },
                function (err) {
                    //
                }
            );
        }
    }
</script>

<script>
    buildAdminMenuTree();
</script>


<div data-dojo-type="dijit/Dialog" id="admin_menu_edit_dialog" data-dojo-id="admin_menu_edit_dialog" title="编辑菜单">
    <script type="dojo/on" data-dojo-event="hide">
        admin_menu_edit_form.reset();
        var hideKeys = ["id", "pid", "level"];
        for (var j = 0; j < hideKeys.length; ++j) {
            dojoDom.byId("admin_menu_edit_" + hideKeys[j]).value = "";
        }
    </script>
    <form data-dojo-type="dojox/form/Manager" id="admin_menu_edit_form" action="/Menu/save" method="post"  data-dojo-id="admin_menu_edit_form">
        <input style="display: none;" type="text" id="admin_menu_edit_id" data-dojo-type="dijit/form/TextBox" name="id"/>
        <input style="display: none;" type="text" id="admin_menu_edit_pid" data-dojo-type="dijit/form/TextBox" name="pid"/>
        <input style="display: none;" type="text" id="admin_menu_edit_level" data-dojo-type="dijit/form/TextBox" name="level"/>
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
        <table class="dijitDialogPaneContentArea">
            <tr>
                <td >状态：</td>
                <td>
                    <select id="admin_menu_edit_status" name="status" data-dojo-type="dijit/form/Select">
                        <option value="1">正常</option>
                        <option value="0">关闭</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>标题</td>
                <td>
                    <input id="admin_menu_edit_title" type="text" name="title" data-dojo-type="dijit/form/ValidationTextBox" data-dojo-props="required:true,trim:true,maxLength:50"/>
                </td>
            </tr>
            <tr>
                <td>排序：</td>
                <td>
                    <input id="admin_menu_edit_sort" type="text" name="sort" data-dojo-type="dijit/form/NumberTextBox"  data-dojo-props="required:true,constraints:{min:-2147483648,max:2147483647,places:0}"/>
                </td>
            </tr>
            <tr id="admin_menu_edit_url_tr">
                <td>url</td>
                <td>
                    <input id="admin_menu_edit_url" type="text" name="url" data-dojo-type="dijit/form/ValidationTextBox" data-dojo-props="trim:true,maxLength:50"/>
                </td>
            </tr>
            <tr id="admin_menu_edit_tag_tr">
                <td>权限标签：</td>
                <td>

                    <?php
                        foreach(\Library\Constant\ConfigConstant::$ADMIN_PERMISSION as $key => $value) {
                    ?>
                    <input id="admin_menu_edit_permission_<?php echo $key; ?>"
                           name="admin_menu_edit_permission_<?php echo $key; ?>"
                           data-dojo-type="dijit/form/CheckBox"
                           value="<?php echo $key; ?>"
                           onChange="onMenuEditAdminPermissionChange(this.get('value'), <?php echo $key; ?>)" />
                    <label for="admin_menu_edit_permission_<?php echo $key; ?>"><?php echo $value; ?></label>
                    <?php } ?>
                    <input id="admin_menu_edit_tag" style="width: 50px;" disabled size="10" type="text" name="tag" value="0" data-dojo-type="dijit/form/NumberTextBox"/>
                </td>
            </tr>
            <tr id="admin_menu_edit_map_tr">
                <td>映射表</td>
                <td>
                    <input id="admin_menu_edit_map" type="text" name="map" data-dojo-type="dijit/form/ValidationTextBox" data-dojo-props="trim:true,maxLength:50"/>
                </td>
            </tr>
            <tr>
                <td>备注：</td>
                <td>
                <textarea id="admin_menu_edit_remark" name="remark" data-dojo-type="dijit/form/Textarea" cols="27"  data-dojo-props="trim:true,maxLength:100"></textarea>
                </td>
            </tr>
        </table>
    </form>
    <div class="dijitDialogPaneActionBar">
        <button data-dojo-type="dijit/form/Button" type="button" onclick="saveAdminMenu();" >保存</button>
        <button data-dojo-type="dijit/form/Button" type="button" data-dojo-props="onClick:function(){admin_menu_edit_form.reset();admin_menu_edit_dialog.hide();}">
            关闭
        </button>
    </div>
</div>
<script>
    function onMenuEditAdminPermissionChange(widgetCheck, value) {
        var obj = dijit.byId("admin_menu_edit_tag");
        var tagValue = obj.get("value");
        if (widgetCheck === false) {
            obj.set("value", tagValue - value);
        }
        else {
            obj.set("value", tagValue + value);
        }
    }
</script>