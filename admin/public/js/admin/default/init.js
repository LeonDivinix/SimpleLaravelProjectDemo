/**
 * Created by leon on 2016/10/31.
 * 初始化首页
 */
// 全局dojo对象
var dojoDom;
var domStyle;
var domConstruct;
var request;
var parser;
var dojoJson;

// 全局变量
var RootDomainUrl = "/";
var singleRefreshTab = ""; // 正在增删改数据对应的tab的id
var singleRefreshGrid = ""; // 正在增删改数据对应的Grid的id
var progressDialog; // 进度对话框
var dojoToaster; // 提示条

// 前缀
var TAB_Grid_PREFIX = "AdminGridTab_"; // grid的tab页前缀
var TAB_EDIT_PREFIX = "AdminTabEdit_"; // 编辑tab页前缀
var GRID_PREFIX = "AdminGrid_"; // grid前缀
var GRID_LOCK_INPUT_PREFIX = "admin_grid_lock_index_"; // grid锁定列索引前缀
var GRID_LOCK_CHECKBOX_PREFIX = "admin_grid_lock_check_box_"; // grid锁定列索引前缀
var GRID_HIDE_COLUMN_FORM_PREFIX = "admin_grid_hide_column_form_"; // grid锁定列索引前缀

// 常量
var GRID_PAGE_SIZE = 20;
var GRID_PRIMARY_KEY = "id";
var GRID_OPERATE_COLUMN_ID = "operateColumn"; // grid操作列id

// 页面元素id
var INDEX_TAB_CONTAINER_ID = "admin_index_tab_container"; // 主页面Tab容器id
var INDEX_MENU_CONTAINER_ID = "admin_index_menu_container"; // 主页面菜单容器id
var PROGRESS_DIALOG_DIV_ID = "admin_standby"; // 进度对话框层id
var TOASTER_DIV_ID = "admin_toaster"; // 提示条层id
var ADMIN_PAGE_CONTAINER_ID = "admin_index_border_container";

var Toast = {
    show: function(message, type) {
        dojoToaster.setContent(message, type);
        dojoToaster.show();
    },
    message: function(message) {
        this.show(message, "message");
    },
    error: function(message) {
        this.show(message, "error");
    }
};

require([
    "dijit/Dialog",
    "dijit/layout/BorderContainer",
    "dijit/layout/TabContainer",
    "dojox/form/Manager",
    "dijit/form/TextBox",
    "dijit/form/Select",
    "dijit/form/ValidationTextBox",
    "dijit/form/NumberTextBox",
    "dijit/form/CheckBox",
    "dijit/form/Textarea",
    "dojox/layout/TableContainer",
    "dijit/Fieldset",
    "dijit/form/NumberSpinner"
]);

require(
    [
        "dojox/layout/ContentPane",
        "dijit/Menu",
        "dijit/MenuItem",
        "dijit/layout/AccordionContainer",
        "dojo/request",
        "dojo/dom",
        "dojo/dom-style",
        "dojo/dom-construct",
        "dojo/parser",
        "dijit/Dialog",
        "dojo/json",
        "dojox/widget/Standby",
        "dojox/widget/Toaster",
        "dojo/domReady!"
    ],
    function(
        ContentPane,
        Menu,
        MenuItem,
        AccordionContainer,
        dojoRequest,
        dDom,
        dojoDomStyle,
        dojoDomConstruct,
        dojoParser,
        Dialog,
        json,
        Standby,
        Toaster
    )
    {
        domStyle = dojoDomStyle;
        domConstruct = dojoDomConstruct;
        dojoDom = dDom;
        request = dojoRequest;
        parser = dojoParser;
        dojoJson = json;

        // 进度对话框
        progressDialog = new Standby({target: ADMIN_PAGE_CONTAINER_ID}, PROGRESS_DIALOG_DIV_ID);
        dojoToaster = new Toaster({positionDirection: "tc-down"}, "TOASTER_DIV_ID");
        var getClickFunc = function(menu) {
            return function() {
                var tabContainer = dijit.byId(INDEX_TAB_CONTAINER_ID);
                var tabId = buildGridTabId(menu.menu_id);
                if (undefined == dijit.byId(tabId)) {
                    tabContainer.addChild(new ContentPane({
                        id: tabId,
                        closable: true,
                        title: menu.menu_title,
                        href: RootDomainUrl + menu.url + "?menuId=" + menu.menu_id
                    }));
                }
                tabContainer.selectChild(tabId);
            }
        };

        // 菜单布局
        var menuContainer = new AccordionContainer(
            {minSize:20, region:'leading', splitter:true, style:"font-weight: bold"},
            INDEX_MENU_CONTAINER_ID
        );

        dojoRequest(
            RootDomainUrl + "Menu/own",
            {
                handleAs: "json",
                async: true,
                preventCache: false
            }
        ).then(function(json) {
            if (0 === json.flag) {
                var len = json.result.length;
                var i = 0;
                var tmpPid = -1;
                var tmpPtitle = "";
                var menu = new Menu({style: 'width:100%; border:0'});
                var endAdd = false;
                for (; i < len; ++i) {
                    var menuInfo = json.result[i];
                    if (tmpPid < 0) {
                        menu.addChild(new MenuItem({
                            style: "font-weight: normal", // 正常字体
                            label: menuInfo["menu_title"],
                            // 不要在循环中创建函数
                            onClick: getClickFunc(menuInfo)
                        }));
                        tmpPid = menuInfo["menu_p_id"];
                        tmpPtitle = menuInfo["menu_p_title"];
                        endAdd = true;
                    }
                    else {
                        if (menuInfo["menu_p_id"] != tmpPid) {
                            menuContainer.addChild(new ContentPane({
                                title: tmpPtitle,
                                style:'margin:0;padding:0', // 铺满整屏
                                content: menu
                            }));
                            menu = new Menu({style: 'width:100%; border:0'}); // 铺满整屏
                        }
                        menu.addChild(new MenuItem({
                            style: "font-weight: normal", // 正常字体
                            label: menuInfo["menu_title"],
                            onClick: getClickFunc(menuInfo)
                        }));
                        tmpPid = menuInfo["menu_p_id"];
                        tmpPtitle = menuInfo["menu_p_title"];
                        endAdd = true;
                    }
                }
                if (endAdd) {
                    menuContainer.addChild(new ContentPane({
                        title: tmpPtitle,
                        style: 'margin:0;padding:0', // 铺满整屏
                        content: menu
                    }));
                }
            }
            else if (900 < json.flag) {
                location.href = json.message;
            }
            else {
                alert(json.message);
            }
        });
        menuContainer.startup();

        // 全局热键
        document.onkeydown = function(e){
            var ev = document.all ? window.event : e;
            if(ev.keyCode == 27) {
                progressDialog.hide();
            }
            else if (ev.keyCode == 13) {
                var container = dijit.byId(INDEX_TAB_CONTAINER_ID);
                if (undefined != container) {
                    var id = container.selectedChildWidget.id;
                    if (id.indexOf(TAB_Grid_PREFIX) === 0) {
                        var grid = dijit.byId(GRID_PREFIX + id.substr(TAB_Grid_PREFIX.length));
                        if (undefined != grid) {
                            grid.filter.refresh();
                        }
                    }
                }
            }
        }
    }
);

function buildGridTabId(id) {
    return TAB_Grid_PREFIX + id;
}

function buildEditTabId() {
    return TAB_EDIT_PREFIX + "kg@kdfoie123";
}

function buildGridId(id) {
    return GRID_PREFIX + id;
}

function buildGridLockInputId(id) {
    return GRID_LOCK_INPUT_PREFIX + id;
}

function buildGridLockCheckboxId(id) {
    return GRID_LOCK_CHECKBOX_PREFIX + id;
}

function buildGridHideColumnFormId(id) {
    return GRID_HIDE_COLUMN_FORM_PREFIX + id;
}
