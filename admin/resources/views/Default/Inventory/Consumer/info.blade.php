<table class="grid_info_table">
    <tr>
        <td style="width: 80px">id：</td>
        <td>
            <span><?php echo $obj["id"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >序号：</td>
        <td>
            <span><?php echo $obj["sequence"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >编号：</td>
        <td>
            <span><?php echo $obj["code"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >姓名：</td>
        <td>
            <span><?php echo $obj["name"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >手机：</td>
        <td>
            <span><?php echo $obj["mobile"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >电话：</td>
        <td>
            <span><?php echo $obj["phone"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >email：</td>
        <td>
            <span><?php echo $obj["email"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >qq：</td>
        <td>
            <span><?php echo $obj["qq"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >微信：</td>
        <td>
            <span><?php echo $obj["wechat"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >性别：</td>
        <td>
            <span><?php echo $obj["gender"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >生日：</td>
        <td>
            <span><?php echo $obj["birthday"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >省：</td>
        <td>
            <span><?php echo $obj["province"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >市：</td>
        <td>
            <span><?php echo $obj["city"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >地区：</td>
        <td>
            <span><?php echo $obj["area"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >地址：</td>
        <td>
            <span><?php echo $obj["address"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >邮编：</td>
        <td>
            <span><?php echo $obj["post_code"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >状态：</td>
        <td>
            <span><?php echo $obj["status"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >是否删除：</td>
        <td>
            <span>
                <?php
                    echo $obj["is_del"], ": ";
                    $result = "";
                    switch($obj["is_del"]) {
                        case '0':
                            $result = '否';
                            break;
                        case '1':
                            $result = '是';
                            break;
                    }
                    echo $result;
                ?>
            </span>
        </td>
    </tr>
</table>
