/**
 * Created by leon on 2016/10/31.
 * 各种表格创建
 */
function toExcel(excelUrl, queryFormId, menuId) {
    var fieldFields = dijit.byId(queryFormId).gatherFormValues();
    var condition = "?menuId=" + menuId;
    for (var n in fieldFields) {
        if (fieldFields.hasOwnProperty(n) && '' !== fieldFields[n] && null != fieldFields[n]) {
            condition += "&" + n + "=" + encodeURIComponent(fieldFields[n]);
        }
    }
    location.href = RootDomainUrl + excelUrl + condition;
}

function toXml(toXmlUrl, menuId) {
    location.href = RootDomainUrl + toXmlUrl + "?menuId=" + menuId;
}

function dealParams(fieldFields) {
    var params = {};
    for (var n in fieldFields) {
        if (fieldFields.hasOwnProperty(n) && '' !== fieldFields[n] && null != fieldFields[n]) {
            params[n] = fieldFields[n];
        }
    }
    return params;
}

function adminLockGridColumn(isCheck, id) {
    var gridId = buildGridId(id);
    if (false === isCheck) {
        dijit.byId(gridId).columnLock.unlock();
    }
    else {
        var indexObj = dom.byId(buildGridLockInputId(id));
        if (undefined != indexObj && null != indexObj) {
            dijit.byId(gridId).columnLock.lock(indexObj.value);
        }
    }
}

function adminLockGridColumnIndex(index, id) {
    var gridId = buildGridId(id);
    var checker = dom.byId(buildGridLockCheckboxId(id));
    if (undefined != checker && null != checker && checker.checked) {
        dijit.byId(gridId).columnLock.lock(index);
    }
}

function adminHideGridColumn(isCheck, id, column) {
    var gridId = buildGridId(id);
    if (column === 0) {
        var form = dijit.byId(buildGridHideColumnFormId(id));
        if (undefined != form) {
            var checkers = form.gatherFormValues();
            var tmp;
            for (var n in checkers) {
                if (checkers.hasOwnProperty(n)) {
                    tmp = dijit.byId(n);
                    if (undefined != tmp) {
                        tmp.set("checked", isCheck);
                    }
                }
            }
        }
    }
    if (false === isCheck) {
        dijit.byId(gridId).hiddenColumns.remove(column);
    }
    else {
        dijit.byId(gridId).hiddenColumns.add(column);
    }
}

function createCommonIndex(tabConfig) {
    require([
            "dojo/store/JsonRest",
            'dijit/Toolbar',
            'dijit/ToolbarSeparator',
            'dijit/form/Button',
            "gridx/Grid",
            "gridx/core/model/cache/Async",
            "gridx/modules/ColumnResizer",
            "gridx/modules/Filter",
            "gridx/modules/Pagination",
            "gridx/modules/pagination/PaginationBar",
            "gridx/modules/SingleSort",
            'gridx/support/LinkPager',
            'gridx/support/Summary',
            'gridx/support/GotoPageButton',
            "gridx/modules/Bar",
            'gridx/modules/select/Row',
            "gridx/modules/CellWidget",
            "gridx/modules/Edit",
            "dojox/widget/DialogSimple",
            "gridx/modules/VirtualVScroller",
            "gridx/modules/Dod",
            "gridx/modules/extendedSelect/Row",
            "gridx/modules/RowHeader",
            "gridx/modules/ColumnLock",
            "gridx/modules/move/Column",
            "gridx/modules/select/Column",
            "gridx/modules/dnd/Column",
            "gridx/modules/extendedSelect/Column",
            "dijit/form/DropDownButton",
            "dijit/TooltipDialog",
            "gridx/modules/HiddenColumns"
        ],
        function(
            Store,
            Toolbar,
            ToolbarSeparator,
            Button,
            Grid,
            cache,
            ColumnResizer,
            Filter,
            Pagination,
            PaginationBar,
            SingleSort,
            LinkPager,
            Summary,
            GotoPageButton,
            Bar,
            SelectRow,
            CellWidget,
            Edit,
            Dialog,
            VirtualVScroller,
            Dod,
            extendedSelectRow,
            RowHeader,
            ColumnLock,
            MoveColumn,
            SelectColumn,
            DndColumn,
            extendedSelectColumn,
            DropDownButton,
            TooltipDialog,
            HiddenColumns
        ) {
            var listUrl = tabConfig.listUrl;
            if (listUrl.indexOf("?") == -1) {
                listUrl += "?menuId=" + tabConfig.menuId;
            }
            else {
                listUrl += "&menuId=" + tabConfig.menuId;
            }
            var store = new Store({
                target: RootDomainUrl + listUrl,
                headers: {"SIZEPERPAGE": GRID_PAGE_SIZE}
            });



            // 构建操作工具栏
            var separatorFlag = false;
            var needSeparator = 0;
            var gridTopBar = new Toolbar({});
            if (undefined != tabConfig.addUrl && '' != tabConfig.addUrl) {
                gridTopBar.addChild(new Button({
                    label: '增加',
                    iconClass: "dijitCommonIcon dijitIconNewTask",
                    onClick: function () {
                        toSingleEditTab(tabConfig.addUrl, "增加" + tabConfig.title, tabConfig.menuId);
                    }
                }));
                ++needSeparator;
            }

            // 自定义
            if (undefined != tabConfig.customCallback && '' != tabConfig.customCallback) {
                gridTopBar.addChild(new Button({
                    label: tabConfig.customTitle,
                    iconClass: "dijitCommonIcon dijitIconUsers",
                    onClick: function () {
                        tabConfig.customCallback();
                    }
                }));
                ++needSeparator;
            }

            if (undefined != tabConfig.exportUrl && '' != tabConfig.exportUrl) {
                gridTopBar.addChild(new Button({
                    label: '导出',
                    iconClass: "dijitEditorIcon dijitEditorIconSave",
                    onClick: function () {
                        toExcel(tabConfig.exportUrl, tabConfig.queryFormId, tabConfig.menuId);
                    }
                }));
                ++needSeparator;
            }
            // 批量导入
            if (undefined != tabConfig.importUrl && '' != tabConfig.importUrl) {
                gridTopBar.addChild(new Button({
                    label: '导入',
                    iconClass: "dijitEditorIcon dijitEditorIconIndent",
                    onClick: function () {
                        toSingleEditPanel("/Nba/Importdialog/import?module=" + tabConfig.importUrl, "导入" +
                            tabConfig.title, tabConfig.menuId);
                    }
                }));
                gridTopBar.addChild(new ToolbarSeparator());
                separatorFlag = true;
            }
            if (!separatorFlag && needSeparator > 0) {
                gridTopBar.addChild(new ToolbarSeparator());
            }
            var columnModelLength = tabConfig.columnModel.length;
            var hideColumnStr = "";
            var hideColumnCheckboxId = "";
            for (var k = 0; k < columnModelLength; ++k) {
                if (GRID_OPERATE_COLUMN_ID != tabConfig.columnModel[k].id && '' != tabConfig.columnModel[k].id) {
                    hideColumnCheckboxId = "admin_grid_hide_column_" + tabConfig.menuId + '_' + tabConfig.columnModel[k].id;
                    hideColumnStr += '<tr>' +
                        '	<td class="tableContainer-labelCell editLabelsAndValues-labelCell">' +
                        '		<input id="' + hideColumnCheckboxId + '"' +
                        '           name="' + hideColumnCheckboxId + '"' +
                        '			data-dojo-type="dijit/form/CheckBox" value="1"';
                    if (GRID_PRIMARY_KEY == tabConfig.columnModel[k].id) {
                        hideColumnStr += " checked ";
                    }
                    hideColumnStr += '			onChange="adminHideGridColumn(this.checked, \'' + tabConfig.menuId + '\', \'' + tabConfig.columnModel[k].id + '\');" />' +
                        '	</td>' +
                        '	<td><label for="' + hideColumnCheckboxId + '">' + tabConfig.columnModel[k].name +
                        '   </label></td>' + '</tr>';
                }
            }
            var lockCheckBoxId = buildGridLockCheckboxId(tabConfig.menuId);
            var lockInputId = buildGridLockInputId(tabConfig.menuId);
            var hideColumnFormId = buildGridHideColumnFormId(tabConfig.menuId);
            var filterDialog = new TooltipDialog({
                content:
                '<div style="padding-left: 2em;"><input id="' + lockCheckBoxId + '"' +
                '       data-dojo-type="dijit/form/CheckBox" value="1"' +
                '       onChange="adminLockGridColumn(this.checked, \'' + tabConfig.menuId + '\');" />' +
                '<label for="' + lockCheckBoxId + '">锁定列：</label>' +
                '<input id="' + lockInputId + '"' +
                '       data-dojo-type="dijit/form/NumberSpinner" style="width: 40px;" value="3"' +
                '       data-dojo-props="smallDelta:1, constraints:{min:1,max:10,places:0}"' +
                '       onclick="adminLockGridColumnIndex(this.value, \'' + tabConfig.menuId + '\');" /></div>' +

                '<fieldset style="width: 200px" data-dojo-type="dijit/Fieldset">' +
                '    <legend>隐藏列</legend>' +
                '    <form data-dojo-type="dojox/form/Manager"' +
                '          id="' + hideColumnFormId + '"' +
                '          data-dojo-id="' + hideColumnFormId + '">' +
                '    <table border="0">' +
                '        <tr><td class="tableContainer-labelCell editLabelsAndValues-labelCell">' +
                '                全选' +
                '            </td>' +
                '            <td>' +
                '                <input' +
                '                    data-dojo-type="dijit/form/CheckBox" value="1"' +
                '                    onChange="adminHideGridColumn(this.checked, \'' + tabConfig.menuId + '\', 0);" />' +
                '            </td></tr>' + hideColumnStr +
                '</table></form></fieldset>'
            });

            gridTopBar.addChild(new DropDownButton({
                label: '过滤',
                iconClass:"dijitCommonIcon dijitIconFilter",
                dropDown: filterDialog
            }));

            gridTopBar.addChild(new Button({
                label: '刷新',
                iconClass:"dijitCommonIcon dijitIconUndo",
                onClick: function(){
                    dijit.byId(tabConfig.queryFormId).reset();
                    grid.sort.clear();
                    grid.select.column.clear();
                    grid.select.row.clear();
                    grid.filter.refresh();
                }
            }));

            gridTopBar.addChild(new Button({
                label: '查询',
                iconClass:"dijitCommonIcon dijitIconSearch",
                onClick: function(){
                    grid.filter.refresh();
                }
            }));

            var setInfoContent = function(rowId, node) {
                request(
                    RootDomainUrl + tabConfig.infoUrl + "?id=" + rowId + "&menuId=" + tabConfig.menuId,
                    {
                        handleAs: "json",
                        sync: true,
                        timeout: 300000 // 5分钟过期
                    }
                ).then(function(json) {
                    if (0 === json.flag) {
                        node.innerHTML = json.result;
                        parser.parse(node);
                    }
                    else if (900 < json.flag) {
                        location.href = json.message;
                    }
                    else {
                        alert(json.message);
                    }
                });
            };

            window.detailProvider = function(grid, rowId, detailNode, renderred) {
                setInfoContent(rowId, detailNode);
                window.setTimeout(function(){
                    renderred.callback();
                }, 300);
                return renderred;
            };

            // 构建grid
            var modules = [
                SelectRow,
                ColumnResizer,
                Filter,
                Bar,
                SingleSort,
                Pagination,
                CellWidget,
                Edit,
                ColumnLock,
                SelectColumn,
                RowHeader,
                extendedSelectColumn,
                MoveColumn,
                DndColumn,
                HiddenColumns
            ];
            if (undefined != tabConfig.infoUrl && "" != tabConfig.infoUrl) {
                modules.push({
                    moduleClass: Dod,
                    defaultShow: false,
                    useAnimation: false,
                    showExpando: true,
                    onHide: function(row) {this.refresh(row)},
                    detailProvider: detailProvider
                });
            }

            var grid = new Grid({
                id : buildGridId(tabConfig.menuId),
                store:  store,
                cacheClass: cache,
                filterServerMode: true,
                filterSetupFilterQuery: function(){
                    return dealParams(dijit.byId(tabConfig.queryFormId).gatherFormValues());
                },
                structure: tabConfig.columnModel,
                modules: modules,
                selectRowTriggerOnCell: true,
                paginationInitialPageSize: GRID_PAGE_SIZE,
                barTop: [
                    [
                        {content: tabConfig.queryFormContent}
                    ],
                    [
                        gridTopBar
                    ]
                ]
                ,
                barBottom: [
                    [
                        {pluginClass: Summary, showRange:true, showSelect:false, style: 'width:300px'},
                        {pluginClass: LinkPager, style: 'text-align: center;'},
                        {pluginClass: GotoPageButton, style: 'text-align: center;width:300px'}
                    ]
                ]
            });

            grid.placeAt(dojo.byId(tabConfig.gridRenderId));
            grid.startup();
            adminHideGridColumn(true, tabConfig.menuId, GRID_PRIMARY_KEY); // 默认隐藏id
        });
}
// 创建dialog单选Grid
function createSingleSelectGrid(tabConfig) {
    require([
            "dojo/store/JsonRest",
            'dijit/Toolbar',
            'dijit/form/Button',
            "gridx/Grid",
            "gridx/core/model/cache/Async",
            "gridx/modules/ColumnResizer",
            "gridx/modules/Filter",
            "gridx/modules/Pagination",
            "gridx/modules/pagination/PaginationBar",
            "gridx/modules/SingleSort",
            'gridx/support/LinkPager',
            'gridx/support/Summary',
            'gridx/support/GotoPageButton',
            "gridx/modules/Bar",
            'gridx/modules/select/Row',
            "gridx/modules/HiddenColumns"
        ],
        function(
            Store,
            Toolbar,
            Button,
            Grid,
            cache,
            ColumnResizer,
            Filter,
            Pagination,
            PaginationBar,
            SingleSort,
            LinkPager,
            Summary,
            GotoPageButton,
            Bar,
            SelectRow,
            HiddenColumns
        ) {
            var listUrl = tabConfig.listUrl;
            var store = new Store({
                target: RootDomainUrl + listUrl,
                headers: {"SIZEPERPAGE": GRID_PAGE_SIZE}
            });

            // 构建操作工具栏
            var gridTopBar = new Toolbar({});
            gridTopBar.addChild(new Button({
                label: '重置',
                iconClass:"dijitCommonIcon dijitIconClear",
                onClick: function(){
                    dijit.byId(tabConfig.queryFormId).reset();
                }
            }));

            gridTopBar.addChild(new Button({
                label: '查询',
                iconClass:"dijitCommonIcon dijitIconSearch",
                onClick: function(){
                    grid.filter.refresh();
                }
            }));

            // 构建grid
            var grid = new Grid({
                id : GRID_PREFIX + tabConfig.gridRenderId,
                store:  store,
                cacheClass: cache,
                filterServerMode: true,
                filterSetupFilterQuery: function(){
                    return dealParams(dijit.byId(tabConfig.queryFormId).gatherFormValues());
                },
                structure: tabConfig.columnModel,
                modules: [
                    HiddenColumns,
                    SelectRow,
                    ColumnResizer,
                    Filter,
                    Bar,
                    SingleSort,
                    Pagination
                ],
                selectRowTriggerOnCell: true,
                paginationInitialPageSize: GRID_PAGE_SIZE,
                barTop: [
                    [
                        {content: tabConfig.queryFormContent}
                    ],
                    [
                        gridTopBar
                    ]
                ]
                ,
                barBottom: [
                    [
                        {pluginClass: Summary, showRange:true, style: 'width:300px'},
                        {pluginClass: LinkPager, style: 'text-align: center;'},
                        {pluginClass: GotoPageButton, style: 'text-align: center;width:300px'}
                    ]
                ]
            });

            grid.placeAt(dojo.byId(tabConfig.gridRenderId));
            grid.startup();
            adminHideGridColumn(true, tabConfig.gridRenderId, GRID_PRIMARY_KEY); // 默认隐藏id
        });
}

// 创建dialog复选Grid
function createMultiSelectGrid(tabConfig) {
    require([
            "dojo/store/JsonRest",
            'dijit/Toolbar',
            'dijit/form/Button',
            "gridx/Grid",
            "gridx/core/model/cache/Async",
            "gridx/modules/ColumnResizer",
            "gridx/modules/Filter",
            "gridx/modules/Pagination",
            "gridx/modules/pagination/PaginationBar",
            "gridx/modules/SingleSort",
            'gridx/support/LinkPager',
            'gridx/support/Summary',
            'gridx/support/GotoPageButton',
            "gridx/modules/Bar",
            "gridx/modules/extendedSelect/Row",
            "gridx/modules/RowHeader",
            "gridx/modules/IndirectSelect"
        ],
        function(
            Store,
            Toolbar,
            Button,
            Grid,
            cache,
            ColumnResizer,
            Filter,
            Pagination,
            PaginationBar,
            SingleSort,
            LinkPager,
            Summary,
            GotoPageButton,
            Bar,
            SelectRow,
            RowHeader,
            IndirectSelect
        ) {
            var listUrl = tabConfig.listUrl;

            var store = new Store({
                target: RootDomainUrl + listUrl,
                headers: {"SIZEPERPAGE": GRID_PAGE_SIZE}
            });

            // 构建操作工具栏
            var gridTopBar = new Toolbar({});
            gridTopBar.addChild(new Button({
                label: '重置',
                iconClass:"dijitCommonIcon dijitIconClear",
                onClick: function(){
                    dijit.byId(tabConfig.queryFormId).reset();
                }
            }));

            gridTopBar.addChild(new Button({
                label: '查询',
                iconClass:"dijitCommonIcon dijitIconSearch",
                onClick: function(){
                    grid.filter.refresh();
                }
            }));

            // 构建grid
            var grid = new Grid({
                id : tabConfig.gridRenderId,
                store:  store,
                cacheClass: cache,
                filterServerMode: true,
                filterSetupFilterQuery: function(){
                    return dealParams(dijit.byId(tabConfig.queryFormId).gatherFormValues());
                },
                structure: tabConfig.columnModel,
                modules: [
                    RowHeader,
                    IndirectSelect,
                    SelectRow,
                    ColumnResizer,
                    Filter,
                    Bar,
                    SingleSort,
                    Pagination,
                    "gridx/modules/extendedSelect/Row"
                ],
                paginationInitialPageSize: GRID_PAGE_SIZE,
                barTop: [
                    [
                        {content: tabConfig.queryFormContent}
                    ],
                    [
                        gridTopBar
                    ]
                ]
                ,
                barBottom: [
                    [
                        {pluginClass: Summary, showRange:true, style: 'width:300px'},
                        {pluginClass: LinkPager, style: 'text-align: center;'},
                        {pluginClass: GotoPageButton, style: 'text-align: center;width:300px'}
                    ]
                ]
            });

            grid.placeAt(dojo.byId(tabConfig.gridRenderId));
            grid.startup();
        }
    );
}