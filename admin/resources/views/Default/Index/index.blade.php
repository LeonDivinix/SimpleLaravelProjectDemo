<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>后台管理</title>
    <link rel="stylesheet" href="/js/dojo/dijit/themes/claro/claro.css">
    <link rel="stylesheet" href="/js/dojo/gridx/resources/claro/Gridx.css">
    <link rel="stylesheet" href="/js/dojo/cbtree/themes/claro/claro.css">
    <link rel="stylesheet" href="/js/dojo/dojox/widget/Toaster/Toaster.css">
    <link rel="stylesheet" href="/css/admin/default/page.css?v=0.001">
    <link rel="stylesheet" href="/css/admin/default/dojo.css?v=0.001">
    <link rel="stylesheet" href="/css/admin/default/gridx.css?v=0.001">
    <script>
        var dojoConfig = {
            parseOnLoad: true,
            async: true,
            has: {
                "dojo-debug-messages": true
            }
        };
    </script>
    <script src="/js/dojo/dojo/dojo.js"></script>
    <script src="/js/admin/default/init.js"></script>
    <script src="/js/admin/default/tool.js"></script>
    <script src="/js/admin/default/gridx.js"></script>
</head>

<body class="claro">
<div id="admin_standby"></div>
<div id="admin_toaster"></div>
<div data-dojo-type="" data-dojo-props="positionDirection:'tc-down'" id="ttht_toaster"></div>
<div data-dojo-type="dijit/layout/BorderContainer" data-dojo-props="gutters:true, liveSplitters:false" id="admin_index_border_container">
    <div data-dojo-type="dijit/layout/ContentPane" data-dojo-props="region:'top', splitter:false, style: 'top:0;height:60px;margin:0;padding:0'">
        <div class="admin_index_style_header">
            <h1>管理后台</h1>
            <h2><?php echo $operator["realName"]; ?></h2>
            <button class="admin_index_style_header-user" onclick="toSingleEditPanel('/User/toEditSelf', '修改个人信息', '')"></button>
            <a href="/Logout" target="_self"><button class="admin_index_style_header-close" ></button></a>
        </div>
    </div>
    <div id="admin_index_menu_container" style="width: 200px"></div> <!-- menu -->
    <div data-dojo-type="dijit/layout/TabContainer" id="admin_index_tab_container" data-dojo-props="region:'center', tabStrip:true">
        <div data-dojo-type="dijit/layout/ContentPane" data-dojo-props="selected: 'true'" title="首页" ></div>
    </div><!-- end TabContainer -->
    <div data-dojo-type="dijit/layout/ContentPane" data-dojo-props="region:'bottom',  splitter:false,  style: 'height:30px;margin:0;padding:0'">
        <table border="0" width="100%" >
            <tr>
                <td width="100%" align="center">Copyright © 2015</td>
            </tr>
        </table>
    </div>
</div><!-- end BorderContainer -->
<script language="javascript" type="text/javascript" src="/js/datepicker/WdatePicker.js"></script>

</body>
</html>