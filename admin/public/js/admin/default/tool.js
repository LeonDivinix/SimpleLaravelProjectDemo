/**
 * Created by leon on 2016/10/31.
 * 所有工具类
 */
// 工具方法
Date.prototype.Format = function (fmt) { //author: meizz
    var o = {
        "m+": this.getMonth() + 1, //月份
        "d+": this.getDate(), //日
        "H+": this.getHours(), //小时
        "i+": this.getMinutes(), //分
        "s+": this.getSeconds(), //秒
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度
        "S": this.getMilliseconds() //毫秒
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o) {
        if (o.hasOwnProperty(k) && new RegExp("(" + k + ")").test(fmt)) {
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        }
    }
    return fmt;
};

function formatDate(format, millionTime) {
    var myDate = new Date();
    if (millionTime > 0) {
        myDate.setTime(millionTime)
    }
    return myDate.Format(format);
}

function showElement(id) {
    domStyle.set(id, "display", "");
}

function hideElement(id) {
    domStyle.set(id, "display", "none");
}

function dijitShowWidget(id) {
    var obj = dijit.byId(id);
    if (undefined != obj) {
        obj.set("style", "display: inline");
    }
}

function dijitHideWidget(id) {
    var obj = dijit.byId(id);
    if (undefined != obj) {
        obj.set("style", "display: none");
    }
}

function dijitDisabledWidget(id, flag) {
    var obj = dijit.byId(id);
    if (undefined != obj) {
        obj.set("disabled", flag)
    }
}

function appendElement(node, dest) {
    return domConstruct.place(node, dest, "last");
}

function unshiftElement(node, dest) {
    return domConstruct.place(node, dest, "first");
}

function removeElement(obj) {
    domConstruct.destroy(obj);
}

function implode(obj, needle) {
    var result = "";
    for (var n in obj) {
        if (obj.hasOwnProperty(n)) {
            result += obj[n] + needle;
        }
    }
    return result.substr(0, result.length - needle.length);
}

// 关闭单例编辑tab
function closeSingleEditTab() {
    var tab = dijit.byId(buildEditTabId());
    if (tab != undefined) {
        dijit.byId(INDEX_TAB_CONTAINER_ID).removeChild(tab);
        tab.destroyRecursive();
    }

    if (singleRefreshTab != undefined && singleRefreshTab != '' && undefined != dijit.byId(singleRefreshTab)) {
        var tabContainer = dijit.byId(INDEX_TAB_CONTAINER_ID);
        tabContainer.selectChild(singleRefreshTab);
    }
}

// 更新正在编辑数据面板的grid数据
function refreshTabGridData() {
    if (singleRefreshTab != undefined && singleRefreshTab != '' && undefined != dijit.byId(singleRefreshTab)) {
        var tabContainer = dijit.byId(INDEX_TAB_CONTAINER_ID);
        var grid = dijit.byId(singleRefreshGrid);
        tabContainer.selectChild(singleRefreshTab);
        singleRefreshTab = "";
        singleRefreshGrid = "";
        if (grid != undefined) {
            grid.filter.refresh();
        }
    }
}

// 单例打开编辑tab
function toSingleEditTab(url, title, menuId) {
    var tabContainer = dijit.byId(INDEX_TAB_CONTAINER_ID);
    if (menuId != undefined && menuId != '') {
        singleRefreshTab = buildGridTabId(menuId) ;
        singleRefreshGrid = buildGridId(menuId);
    }
    if (url.indexOf("?") > 0) {
        url  += "&menuId=" + menuId;
    }
    else {
        url  += "?menuId=" + menuId;
    }
    var editTabId = buildEditTabId();
    var tab = dijit.byId(editTabId);
    if (tab != undefined) {
        tabContainer.removeChild(tab);
        tab.destroyRecursive();
    }
    require([
            "dojox/layout/ContentPane"
        ],
        function(
            ContentPane
        ) {
            tabContainer.addChild(new ContentPane({
                id: editTabId,
                menuId: menuId,
                closable: true,
                title: title,
                onClose: function() {
                    if (singleRefreshTab != undefined && singleRefreshTab != ''
                        && undefined != dijit.byId(singleRefreshTab)) {
                        var tabContainer = dijit.byId(INDEX_TAB_CONTAINER_ID);
                        tabContainer.selectChild(singleRefreshTab);
                    }
                    return true;
                },
                href: RootDomainUrl + url
            }));
            tabContainer.selectChild(editTabId);
        });
}



// 提交form表单
function submitFormData(formId) {
    if (confirm("您确定保存吗？")) {
        var form = dijit.byId(formId);
        if (undefined != form && form.validate()) {
            progressDialog.show();
            request(
                RootDomainUrl + form.action,
                {
                    handleAs: "json",
                    method: form.method,
                    timeout: arguments.length > 1 ? arguments[1] : 300000,
                    data: form.gatherFormValues()
                }
            ).then(
                function(json) {
                    progressDialog.hide();
                    if (0 === json.flag) {
                        closeSingleEditTab();
                        refreshTabGridData();
                    }
                    else if (999 == json.flag) {
                        location.href = json.message;
                    }
                    else {
                        Toast.error(json.message);
                    }
                },
                function(err){
                    //
                }
            );
        }
    }
    return false;
}

function closeDialog(id) {
    var myDialog = dijit.byId(id);
    myDialog.hide();
}

function getCBTreeCheckedIds(cbTreeId) {
    var result = [];
    var tree = dijit.byId(cbTreeId);
    if (undefined != tree) {
        var data = tree.model.store.data;
        var len = data.length;

        var level = -1;
        if (undefined != arguments[1]) {
            level = arguments[1];
        }
        for (var i = 0; i < len; ++i) {
            if (true == data[i].checked) {
                if (level < 0 || data[i].level == level) {
                    result.push(data[i].id)
                }
            }
        }
    }
    return result;
}

function getCBTreeCheckedMap(cbTreeId) {
    var result = {};
    var tree = dijit.byId(cbTreeId);
    if (undefined != tree) {
        var data = tree.model.store.data;
        var len = data.length;

        var level = -1;
        if (undefined != arguments[1]) {
            level = arguments[1];
        }
        for (var i = 0; i < len; ++i) {
            if (true == data[i].checked) {
                if (level < 0 || data[i].level == level) {
                    result[data[i].id] = data[i].name;
                }
            }
        }
    }
    return result;
}

function jsonToStr(json) {
    return dojoJson.stringify(json);
}

function strToJson(str) {
    return dojoJson.parse(str);
}

//todo
function viewMessage(messageId) {
    require([
            "dojo/request",
            "dojox/layout/ContentPane"
        ],
        function(
            request,
            ContentPane
        ) {
            request(
                RootDomainUrl + "Adminmessagedialog/getMessage?id=" + messageId,
                {
                    handleAs: "json",
                    method: "get",
                    timeout: 300000 // 5分钟过期
                }
            ).then(
                function (json) {
                    if (0 === json.flag) {
                        var menuId = json.result.menu_id;
                        var param = json.result.param;
                        var tabContainer = dijit.byId(INDEX_TAB_CONTAINER_ID);
                        var tab = dijit.byId(menuId);
                        if (tab != undefined) {
                            tabContainer.removeChild(tab);
                            tab.destroyRecursive();
                        }
                        tabContainer.addChild(new ContentPane({
                            id: menuId,
                            closable: true,
                            title: json.result.menu_title,
                            href: json.result.url + "?menuId=" + menuId + "&from=message"
                        }));
                        tabContainer.selectChild(menuId);
                        if ("" != param) {
                            var ary = param.split("=");
                            setTimeout(function(){dijit.byId(ary[0]).set("value", ary[1]); dijit.byId(menuId + "_grid").filter.refresh();}, 500);
                        }
                        ttht_index_message(true); // 更新页面展示
                    }
                    else if (900 < json.flag) {
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