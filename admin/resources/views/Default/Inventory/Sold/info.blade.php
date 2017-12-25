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
        <td >成本金额：</td>
        <td>
            <span><?php echo $obj["cost"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >商品金额：</td>
        <td>
            <span><?php echo $obj["amount"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >快递金额：</td>
        <td>
            <span><?php echo $obj["express_amount"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >税金额：</td>
        <td>
            <span><?php echo $obj["tax_amount"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >总金额：</td>
        <td>
            <span><?php echo $obj["total_amount"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >是否包邮：</td>
        <td>
            <span><?php echo $obj["express_flag"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >毛利：</td>
        <td>
            <span><?php echo $obj["profit"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >总重量：</td>
        <td>
            <span><?php echo $obj["total_weight"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >客户id：</td>
        <td>
            <span><?php echo $obj["consumer_id"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >快递图片留存：</td>
        <td>
            <span><?php echo $obj["express_pic"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >客户地址：</td>
        <td>
            <span><?php echo $obj["address"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >客户联系方式：</td>
        <td>
            <span><?php echo $obj["contact"]; ?></span>
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
                            $result = '初始';
                            break;
                    }
                    echo $result;
                ?>
            </span>
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
