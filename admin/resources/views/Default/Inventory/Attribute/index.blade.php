<div data-dojo-type="dijit/layout/BorderContainer" data-dojo-props="gutters:true, liveSplitters:false">
    <div style="width: 400px" data-dojo-type="dijit/layout/ContentPane" data-dojo-props="region:'left', splitter:false">
        <div>
            <button data-dojo-type="dijit/form/Button" type="button" onclick="refreshInventoryProductAttributeTree();" >刷新</button>
            <button data-dojo-type="dijit/form/Button" type="button" onclick="expandInventoryProductAttributeTree();" >展开</button>
            <button data-dojo-type="dijit/form/Button" type="button" onclick="collapseInventoryProductAttributeTree();" >折叠</button>
            <span style="color: darkgray">右键点击条目进行增加或修改操作</span>
        </div>
        <div id="inventory_product_attribute_tree_div"></div>
    </div> <!-- menu -->
    <div data-dojo-type="dijit/layout/ContentPane" data-dojo-props="region:'center', tabStrip:true">
        <div style="height: 30px;">
            &nbsp;
        </div>
        <table id="inventory_product_attribute_table" class="grid_info_table" style="display: none">
            <thead>
            <th>
                条目
            </th>
            <th>
                内容
            </th>
            </thead>
            <tbody>
            <tr id="inventory_product_attribute_tr_parent" style="display: none">
                <td><label for="inventory_product_attribute_span_parent" >上级：</label></td>
                <td>
                    <span id="inventory_product_attribute_span_parent"></span>
                </td>
            </tr>
            <tr>
                <td><label for="inventory_product_attribute_span_id">id：</label></td>
                <td>
                    <span id="inventory_product_attribute_span_id"></span>
                </td>
            </tr>
            <tr>
                <td><label for="inventory_product_attribute_span_code">编号：</label></td>
                <td>
                    <span id="inventory_product_attribute_span_code"></span>
                </td>
            </tr>
            <tr>
                <td><label for="inventory_product_attribute_span_name">名称：</label></td>
                <td>
                    <span id="inventory_product_attribute_span_name"></span>
                </td>
            </tr>
            <tr>
                <td>图片：</td>
                <td>
                    <span id="inventory_product_attribute_span_image"></span>
                </td>
            </tr>
            <tr>
                <td><label for="inventory_product_attribute_span_level">级别：</label></td>
                <td>
                    <span id="inventory_product_attribute_span_level"></span>
                </td>
            </tr>
            <tr>
                <td ><label for="inventory_product_attribute_span_status">状态(0关闭1开启)：</label></td>
                <td>
                    <span id="inventory_product_attribute_span_status"></span>
                </td>
            </tr>
            </tbody>
        </table>
    </div><!-- end TabContainer -->
</div><!-- end BorderContainer -->

<div data-dojo-type="dijit/Dialog" id="inventory_product_attribute_edit_dialog" data-dojo-id="inventory_product_attribute_edit_dialog" title="编辑属性">
    <script type="dojo/on" data-dojo-event="hide">
        inventory_product_attribute_edit_form.reset();
        var hideKeys = ["id", "parent", "level"];
        for (var j = 0; j < hideKeys.length; ++j) {
            dojoDom.byId("inventory_product_attribute_edit_" + hideKeys[j]).value = "";
        }
    </script>
    <form data-dojo-type="dojox/form/Manager" id="inventory_product_attribute_edit_form" action="/Menu/save" method="post"  data-dojo-id="inventory_product_attribute_edit_form">
        <input style="display: none;" type="text" id="inventory_product_attribute_edit_id" data-dojo-type="dijit/form/TextBox" name="id"/>
        <input style="display: none;" type="text" id="inventory_product_attribute_edit_parent" data-dojo-type="dijit/form/TextBox" name="parent"/>
        <input style="display: none;" type="text" id="inventory_product_attribute_edit_level" data-dojo-type="dijit/form/TextBox" name="level"/>
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
        <table class="dijitDialogPaneContentArea">
            <tr>
                <td >状态：</td>
                <td>
                    <select id="inventory_product_attribute_edit_status" name="status" data-dojo-type="dijit/form/Select">
                        <option value="1">正常</option>
                        <option value="0">关闭</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>编号：</td>
                <td>
                    <input type="text" id="inventory_product_attribute_edit_code" name="code"
                           data-dojo-type="dijit/form/ValidationTextBox"
                           data-dojo-props="required:true,trim:true,maxLength:36"/>
                </td>
            </tr>
            <tr>
                <td>名称：</td>
                <td>
                    <input type="text" id="inventory_product_attribute_edit_name" name="name"
                           data-dojo-type="dijit/form/ValidationTextBox"
                           data-dojo-props="required:true,trim:true,maxLength:50"/>
                </td>
            </tr>
            <tr>
                <td>图片：</td>
                <td>
                    <input type="text" id="inventory_product_attribute_edit_image" name="image"
                           data-dojo-type="dijit/form/ValidationTextBox"
                           data-dojo-props="trim:true,maxLength:50"/>
                </td>
            </tr>
        </table>
    </form>
    <div class="dijitDialogPaneActionBar">
        <button data-dojo-type="dijit/form/Button" type="button" onclick="saveInventoryProductAttribute();" >保存</button>
        <button data-dojo-type="dijit/form/Button" type="button" data-dojo-props="onClick:function(){inventory_product_attribute_edit_form.reset();inventory_product_attribute_edit_dialog.hide();}">
            关闭
        </button>
    </div>
</div>
<script>
    function refreshInventoryProductAttributeTree() {
        hideElement("inventory_product_attribute_table");
        dijit.byId("inventory_product_attribute_tree").destroyRecursive();
        dojoDom.byId("inventory_product_attribute_tree_div").innerHTML = "";
        buildInventoryProductAttributeTree();
    }

    function expandInventoryProductAttributeTree() {
        dijit.byId("inventory_product_attribute_tree").expandAll();
    }

    function collapseInventoryProductAttributeTree() {
        hideElement("inventory_product_attribute_table");
        dijit.byId("inventory_product_attribute_tree").collapseAll();
    }


</script>

<script>
    var inventory_product_attribute_max_level = 2;
    function buildInventoryProductAttributeTree() {
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
                        if (parseInt(object.level) < inventory_product_attribute_max_level) {
                            result = this.query({parent: object.id});
                        }
                        return result;
                    }
                });

                // Wrap the store in Observable so that updates to the store are reflected to the Tree
                myStore = new Observable(myStore);

                var myModel = new ObjectStoreModel({
                    store: myStore,
                    labelAttr: "name",
                    query: { level: 0 },
                    mayHaveChildren: function(object) {
//                        result = this.store.query({parent: object.id});
//                        return result.length > 0;
                        var result = true;
                        if (object.level >= inventory_product_attribute_max_level) {
                            result = false;
                        }
                        return result;
                    }
                });

                var tree = new Tree({
                    id: "inventory_product_attribute_tree",
                    model: myModel,
//                    autoExpand: true,
                    getIconClass: function(item, opened) {
                        var result = "dijitLeaf";
                        if (item.level == 0) {
                            result = "dijitIconPackage";
                        }
                        else if (item.level < inventory_product_attribute_max_level) {
                            result = (opened ? "dijitFolderOpened" : "dijitFolderClosed");
                        }
                        return result;
                    },
                    onClick: function() {
                        var item = tree.selectedItem;
                        if (item != undefined && item != null) {
                            showElement("inventory_product_attribute_table");
                            inventory_product_attribute_edit_refresh(item);
                            var pName = "";
                            if (item.level == 0) {
                                hideElement("inventory_product_attribute_tr_parent");
                                dojoDom.byId("inventory_product_attribute_span_parent").innerHTML = "";
                            }
                            else if (item.level == 1) {
                                showElement("inventory_product_attribute_tr_parent");
                                dojoDom.byId("inventory_product_attribute_span_parent").innerHTML = "根";
                            }
                            else {
                                showElement("inventory_product_attribute_tr_parent");
                                var pItem = myStore.get(item.parent);
                                pName = pItem.name;
                                dojoDom.byId("inventory_product_attribute_span_parent").innerHTML = pName;
                            }
                        }
                    }
                });
                tree.placeAt("inventory_product_attribute_tree_div");
                tree.startup();

                <?php if ($canEdit) { ?>
                // 菜单
                var adminMenu = new Menu({
                    targetNodeIds: ["inventory_product_attribute_tree"],
                    selector: ".dijitTreeNode"
                });
                adminMenu.addChild(new MenuItem({
                    iconClass: "dijitIconNewTask",
                    label: "添加&nbsp;&nbsp;",
                    onClick: function(){
                        var item = registry.byNode(this.getParent().currentTarget).item;
                        if (item.level == inventory_product_attribute_max_level) {
                            Toast.error("不能添加下级属性，请在上级目录添加！")
                        }
                        else {
                            toInventoryProductAttributeEditDialog({parent: item.id, parent_name: item.name, level: parseInt(item.level) + 1});
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

                            toInventoryProductAttributeEditDialog(copy);
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
                            toInventoryProductAttributeEditDialog(item);
                        }
                    }
                }));
                adminMenu.startup();
                <?php } ?>
            };

            request(
                    "/Attribute/tree",
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

    function inventory_product_attribute_edit_refresh(item) {
        var tmp;
        for (var n in item) {
            if (item.hasOwnProperty(n) && n != "tag") {
                tmp = dojoDom.byId("inventory_product_attribute_span_" + n);
                if (tmp != undefined) {
                    tmp.innerHTML = item[n];
                }
            }
        }
    }
</script>
<script>
    function toInventoryProductAttributeEditDialog(item) {
        var prefix = "inventory_product_attribute_edit_";
        var showHide = [];
        var shLen = showHide.length;
        var ele;
        dijit.byId("inventory_product_attribute_edit_dialog").set("title", "修改");
        for (var n in item) {
            if (item.hasOwnProperty(n)) {
                if (n == "parent_name") {
                    var str = item[n] + " 添加子菜单";
                    dijit.byId("inventory_product_attribute_edit_dialog").set("title", str);
                }
                else if ("id" == n && item[n] == "") {
                    dijit.byId("inventory_product_attribute_edit_dialog").set("title", "复制");
                    ele = dijit.byId(prefix + n);
                    if (ele != undefined && ele != null && item.hasOwnProperty(n)) {
                        ele.set("value", item[n]);
                    }
                }
                else {
                    ele = dijit.byId(prefix + n);
                    if (ele != undefined && ele != null && item.hasOwnProperty(n)) {
                        ele.set("value", item[n]);
                    }
                }
            }
        }
        if (shLen > 0) {
            if (item.level < inventory_product_attribute_max_level) {
                for (var i = 0; i < shLen; ++i) {
                    hideElement(prefix + showHide[i] + "_tr");
                }
            }
            else {
                for (var j = 0; j < shLen; ++j) {
                    showElement(prefix + showHide[j] + "_tr");
                }
            }
        }
        inventory_product_attribute_edit_dialog.show();
    }

    function saveInventoryProductAttribute() {
        if (inventory_product_attribute_edit_form.validate()) {
            var insertFlag = dijit.byId('inventory_product_attribute_edit_id').get("value") == "";
            require([
                "dojo/request"
            ],
            function (request) {
                request(
                    "/Attribute/save",
                    {
                        handleAs: "json",
                        method: "post",
                        data: inventory_product_attribute_edit_form.gatherFormValues()
                    }
                ).then(
                    function (json) {
                        if (0 === json.flag) {
                            var data = json.result;
                            var saveTree = dijit.byId("inventory_product_attribute_tree");
                            if (insertFlag) {
                                saveTree.model.store.add(data);
                            }
                            else {
                                saveTree.model.store.put(data, {overwrite: true});
                                inventory_product_attribute_edit_refresh(data);
                            }
                            inventory_product_attribute_edit_form.reset();
                            inventory_product_attribute_edit_dialog.hide();

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
    }
</script>
<script>
    require(
        ["dojo/ready"],
        function(
            ready
        ) {
            ready(function() {
                buildInventoryProductAttributeTree();
            });
        }
    );

</script>

<script>
    function onMenuEditAdminPermissionChange(widgetCheck, value) {
        var obj = dijit.byId("inventory_product_attribute_edit_tag");
        var tagValue = obj.get("value");
        if (widgetCheck === false) {
            obj.set("value", tagValue - value);
        }
        else {
            obj.set("value", tagValue + value);
        }
    }
</script>