<?php
/**
 * Created by leon
 * Date: 2016-11-20 11:40
 */

Route::get('Menu/own', 'RBAC\MenuController@ownAction')->middleware("log"); // 我的菜单

Route::group(['middleware' => ['authCheck', 'log']], function () {
    // 操作员
    Route::get('User/list', 'RBAC\UserController@listAction');
    Route::get('User/info', 'RBAC\UserController@infoAction');
    Route::post('User/save', 'RBAC\UserController@saveAction');
    Route::post('User/import', 'RBAC\UserController@importAction');
    // 菜单
    Route::get('Menu/tree', 'RBAC\MenuController@treeAction');
    Route::post('Menu/save', 'RBAC\MenuController@saveAction');
    // 角色
    Route::get('Role/list', 'RBAC\RoleController@listAction');
    Route::get('Role/info', 'RBAC\RoleController@infoAction');
    Route::post('Role/save', 'RBAC\RoleController@saveAction');
    Route::post('Role/import', 'RBAC\RoleController@importAction');
    // 后台工具
    Route::get('Tool/emptyFieldCache', 'System\ToolController@emptyFieldCacheAction');
});

Route::group(['middleware' => ['authRedirect', 'log']], function () {
    // 操作员
    Route::get('User', 'RBAC\UserController@indexAction');
    Route::get('User/copy', 'RBAC\UserController@copyAction');
    Route::get('User/add', 'RBAC\UserController@addAction');
    Route::get('User/update', 'RBAC\UserController@updateAction');
    Route::get('User/export', 'RBAC\UserController@exportAction');
    // 菜单
    Route::get('Menu', 'RBAC\MenuController@indexAction');
    // 角色
    Route::get('Role', 'RBAC\RoleController@indexAction');
    Route::get('Role/copy', 'RBAC\RoleController@copyAction');
    Route::get('Role/add', 'RBAC\RoleController@addAction');
    Route::get('Role/update', 'RBAC\RoleController@updateAction');
    Route::get('Role/export', 'RBAC\RoleController@exportAction');
    // 后台工具
    Route::get('Tool', 'System\ToolController@indexAction');
});

Route::get('Logout', function () {})->middleware(["logout", "log"]);
Route::post('Login/validation', function () {})->middleware(["login", "log"]);

Route::group(['middleware' => ['authRedirect', 'log']], function () {
    Route::get('Login', function () {
        return view(config("view.theme") . ".Login.index");
    });
    Route::get('/', function (\Illuminate\Http\Request $request) {
        $info["operator"] = \Library\Helper\OperatorSessionHelper::getSession($request);
        return view(config("view.theme") . ".Index.index", $info);
    });
});

