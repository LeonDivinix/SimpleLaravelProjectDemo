<div>
    <button data-dojo-type="dijit/form/Button" type="button" onclick="refreshDialogProductCategoryTree();" >刷新</button>
    <button data-dojo-type="dijit/form/Button" type="button" onclick="expandDialogProductCategoryTree();" >展开</button>
    <button data-dojo-type="dijit/form/Button" type="button" onclick="collapseDialogProductCategoryTree();" >折叠</button>
</div>
<div data-dojo-type="dijit/layout/ContentPane" style="height: 460px; width: 100%; margin:0; padding:0">
    <div id="dialog_product_category_tree_div"></div>
</div>
<div>
    <span>当前选择:</span><span id="dialog_product_category_sel_name"></span>
    <input type="hidden" id="dialog_product_category_sel_id" />
    <input type="hidden" id="dialog_product_category_sel_code" />
</div>
<div style="text-align:center; padding-top: 10px">
    <button data-dojo-type="dijit/form/Button"
            onclick="selProductCategory('<?php echo $dialogId; ?>', '<?php echo $saveId; ?>', '<?php echo $showId; ?>', '<?php echo $showCode; ?>');"
            type="button">确定</button>
    <button data-dojo-type="dijit/form/Button" style="padding-left: 50px"
            onclick="closeDialog('<?php echo $dialogId; ?>');" type="button">关闭</button>
</div>
<script>
    function selProductCategory(dialogId, saveId, showId, showCode) {
        var id = dojoDom.byId("dialog_product_category_sel_id").value;
        var code = dojoDom.byId("dialog_product_category_sel_code").value;
        var name = dojoDom.byId("dialog_product_category_sel_name").innerHTML;
        if (id != "") {
            dojoDom.byId(showId).innerHTML = name;
            dojoDom.byId(saveId).value = id;
            dojoDom.byId(showCode).value = code;
            closeDialog(dialogId);
        }
        else {
            Toast.error("请选择分类！");
        }
    }

    function refreshDialogProductCategoryTree() {
        dijit.byId("dialog_product_category_tree").destroyRecursive();
        dojoDom.byId("dialog_product_category_tree_div").innerHTML = "";
        buildDialogProductCategoryTree();
    }

    function expandDialogProductCategoryTree() {
        dijit.byId("dialog_product_category_tree").expandAll();
    }

    function collapseDialogProductCategoryTree() {
        dijit.byId("dialog_product_category_tree").collapseAll();
    }

    function buildDialogProductCategoryTree() {
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
                        result = this.query({parent: object.id});
                        return result;
                    }
                });

                myStore = new Observable(myStore);
                var myModel = new ObjectStoreModel({
                    store: myStore,
                    labelAttr: "name",
                    query: { level: 0 },
                    mayHaveChildren: function(object) {
                        result = this.store.query({parent: object.id});
                        return result.length > 0;
                    }
                });
                var tree = new Tree({
                    id: "dialog_product_category_tree",
                    model: myModel,
//                    autoExpand: true,
                    getIconClass: function(item, opened) {
                        var result = "dijitLeaf";
                        if (item.level == 0) {
                            result = "dijitIconPackage";
                        }
                        else if (this.model.mayHaveChildren(item)) {
                            result = (opened ? "dijitFolderOpened" : "dijitFolderClosed");
                        }
                        return result;
                    },
                    onClick: function() {
                        var item = tree.selectedItem;
                        if (item != undefined && item != null) {
                            var showSpan = dojoDom.byId('dialog_product_category_sel_name');
                            var saveInput = dojoDom.byId('dialog_product_category_sel_id');
                            var codeInput = dojoDom.byId('dialog_product_category_sel_code');
                            if (tree.model.store.query({parent: item.id}).length > 0) {
                                showSpan.innerHTML = "";
                                saveInput.value = "";
                                codeInput.value = "";
                            }
                            else {
                                showSpan.innerHTML = item.name;
                                saveInput.value = item.id;
                                codeInput.value = item.code;
                            }
                        }
//                        var item = tree.selectedItem;
//                        if (item != undefined && item != null) {
//                            showElement("inventory_product_category_table");
//                            inventory_product_category_edit_refresh(item);
//                            var pName = "";
//                            if (item.level == 0) {
//                                hideElement("inventory_product_category_tr_parent");
//                                dojoDom.byId("inventory_product_category_span_parent").innerHTML = "";
//                            }
//                            else if (item.level == 1) {
//                                showElement("inventory_product_category_tr_parent");
//                                dojoDom.byId("inventory_product_category_span_parent").innerHTML = "根";
//                            }
//                            else {
//                                showElement("inventory_product_category_tr_parent");
//                                var pItem = myStore.get(item.pid);
//                                pName = pItem.name;
//                                dojoDom.byId("inventory_product_category_span_parent").innerHTML = pName;
//                            }
//                        }
                    }
                });
                tree.placeAt("dialog_product_category_tree_div");
                tree.startup();
            };

            request(
                "/Category/tree",
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
    buildDialogProductCategoryTree();
</script>
