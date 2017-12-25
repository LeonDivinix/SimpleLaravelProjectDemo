<div id = "<?php echo $dialogId ?>_grid" style="height: 600px; width: 100%; margin:0; padding:0"></div>
<div style="text-align:center; padding-top: 10px">
    <button data-dojo-type="dijit/form/Button" onclick="fromDialog<?php echo $dialogId; ?>(GRID_PREFIX + '<?php echo $dialogId ?>_grid')" type="button">确定</button>
    <button data-dojo-type="dijit/form/Button" onclick="closeDialog('<?php echo $dialogId ?>');" type="button">关闭</button>
</div>
<script>
    require(
        ["dojo/domReady!"],
        function() {
            var moduleName = "BrandDialog"; // 模块名称
            var listUrl = moduleName + "/list"; // 获得列表链接
            var gridRenderId = "<?php echo $dialogId ?>_grid"; // 渲染grid的id
            var queryFormId = "<?php echo $dialogId ?>_query_form"; // 查询用form的id

            // grid列属性配置
            var columnModel = [
                {id: "id", field: "id", name: "id", width: '180px', editable: false},
                {id: "code", field: "code", name: "编号", width: "80px", editable: false},
                {id: "name", field: "name", name: "名称", width: "200px", editable: false},
               // {id: "image", field: "image", name: "单价", width: "50px", editable: false},
                {id: "status", field: "status", name: "发货商", width: "70px", editable: false,
                    decorator: function(cellData) {
                        if (cellData == 1)
                            return "开启";
                        else
                            return "关闭";
                    }}
            ];

            // 查询form内容
            var queryFormContent = '<div data-dojo-type="dojox/form/Manager" id="<?php echo $dialogId ?>_query_form"  data-dojo-id="<?php echo $dialogId ?>_query_form">'
                + '<div data-dojo-type="dojox/layout/TableContainer" data-dojo-props="labelWidth:80, cols:4, width:800, customClass:\'labelsAndValues\'">'
                + '<div data-dojo-type="dijit/form/TextBox" style="width: 120px" data-dojo-props="trim:true,name:\'id\'" title="id:"></div>'
                + '<div data-dojo-type="dijit/form/TextBox" style="width: 120px" data-dojo-props="trim:true,name:\'name\'" title="名称:"></div>'
                + '<div data-dojo-type="dijit/form/TextBox" style="width: 120px" data-dojo-props="trim:true,name:\'type\'" title="分类id:"></div>'
                + '<div data-dojo-type="dijit/form/TextBox" style="width: 120px" data-dojo-props="trim:true,name:\'typeName\'" title="分类名称:"></div>'
                + '</div></div>';

            createSingleSelectGrid({
                // 页面相关设置
                listUrl: listUrl,

                // 网格设置
                gridRenderId: gridRenderId,
                columnModel: columnModel,

                // 查询form设置
                queryFormId: queryFormId,
                queryFormContent: queryFormContent
            });
        }
    );
    function fromDialog<?php echo $dialogId; ?>(id) {
        var showId= '<?php echo $showId ?>';
        var saveId= '<?php echo $saveId ?>';
        var dialogId= '<?php echo $dialogId ?>';
        var showCode = '<?php echo $showCode; ?>';
        var grid = dijit.byId(id);
        var sel = grid.select.row.getSelected();
        if (sel.length > 0) {
            var data = grid.row(sel).data();
            dojoDom.byId(showId).innerHTML = data.name;
            dojoDom.byId(saveId).value = data.id;
            dojoDom.byId(showCode).value = data.code;
            closeDialog(dialogId);
        }
        else {
            Toast.error('请选择条目！');
        }
    }
</script>