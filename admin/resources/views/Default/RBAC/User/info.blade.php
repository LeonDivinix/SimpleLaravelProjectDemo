<table class="grid_info_table">
    <tr>
        <td style="width: 130px">id：</td>
        <td >
            <span><?php echo $obj["id"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >登录名：</td>
        <td>
            <span><?php echo $obj["name"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >真实姓名：</td>
        <td>
            <span><?php echo $obj["real_name"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >工号：</td>
        <td>
            <span><?php echo $obj["code"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >角色：</td>
        <td>
            <span><?php echo $obj["role_id"], ": ", $roleName; ?></span>
        </td>
    </tr>
    <tr>
        <td >电话：</td>
        <td>
            <span><?php echo $obj["phone"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >手机：</td>
        <td>
            <span><?php echo $obj["mobile"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >邮箱：</td>
        <td>
            <span><?php echo $obj["email"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >地址：</td>
        <td>
            <span><?php echo $obj["address"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >生日：</td>
        <td>
            <span><?php echo $obj["birth"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >状态：</td>
        <td>
            <span>
                <?php
                    echo $obj["status"], ": ";
                    $result = "";
                    switch($obj["status"]) {
                        case '0':
                            $result = '关闭';
                            break;
                        case '1':
                            $result = '开启';
                            break;
                    }
                    echo $result;
                ?>
            </span>
        </td>
    </tr>
    <tr>
        <td >备注：</td>
        <td>
            <div style="width: 400px;"><?php echo $obj["remark"]; ?></div>
        </td>
    </tr>
    <tr>
        <td >创建时间：</td>
        <td>
            <span><?php echo $obj["create_at"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >创建人：</td>
        <td>
            <span><?php echo $obj["create_by"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >修改时间：</td>
        <td>
            <span><?php echo $obj["update_at"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >修改人：</td>
        <td>
            <span><?php echo $obj["update_by"]; ?></span>
        </td>
    </tr>
</table>