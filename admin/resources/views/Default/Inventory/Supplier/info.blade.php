<table class="grid_info_table">
    <tr>
        <td style="width: 80px">id：</td>
        <td>
            <span><?php echo $obj["id"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >编号：</td>
        <td>
            <span><?php echo $obj["code"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >名称：</td>
        <td>
            <span><?php echo $obj["name"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >简称：</td>
        <td>
            <span><?php echo $obj["short_name"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >类型：</td>
        <td>
            <span>
                <?php
                $result = "";
                switch($obj["type"]) {
                    case '0':
                        $result = '个人';
                        break;
                    case '1':
                        $result = '公司';
                        break;
                }
                echo $result . "(" . $obj["type"] . ")";
                ?>
            </span>
        </td>
    </tr>
    <tr>
        <td >状态：</td>
        <td>
            <span>
                <?php
                $result = "";
                switch($obj["status"]) {
                    case '0':
                        $result = '关闭';
                        break;
                    case '1':
                        $result = '开启';
                        break;
                }
                echo $result . "(" . $obj["status"] . ")";
                ?>
            </span>
        </td>
    </tr>
    <tr>
        <td >图片：</td>
        <td>
            <span><?php echo $obj["image"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >联系人：</td>
        <td>
            <span><?php echo $obj["linkman"]; ?></span>
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
        <td >微信：</td>
        <td>
            <span><?php echo $obj["wechat"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >支付宝：</td>
        <td>
            <span><?php echo $obj["alipay"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >账户：</td>
        <td>
            <span><?php echo $obj["account"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >开户行：</td>
        <td>
            <span><?php echo $obj["bank"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >地址：</td>
        <td>
            <span><?php echo $obj["address"]; ?></span>
        </td>
    </tr>
</table>
