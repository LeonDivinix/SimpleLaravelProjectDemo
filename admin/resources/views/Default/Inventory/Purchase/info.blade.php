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
        <td >标题说明：</td>
        <td>
            <span><?php echo $obj["title"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >供应商：</td>
        <td>
            <span><?php echo $obj["supplier"], "({$obj["supplier_id"]})"; ?></span>
        </td>
    </tr>
    <tr>
        <td >联系人：</td>
        <td>
            <span><?php echo $obj["supplier_linkman"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >手机：</td>
        <td>
            <span><?php echo $obj["supplier_mobile"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >电话：</td>
        <td>
            <span><?php echo $obj["supplier_phone"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >货币单位：</td>
        <td>
            <span><?php echo \Library\Constant\BusinessConstant::$CURRENCY[$obj["currency_unit"]], "({$obj["currency_unit"]})"; ?></span>
        </td>
    </tr>
    <tr>
        <td >商品金额：</td>
        <td>
            <span><?php echo $obj["buy_amount"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >消费税：</td>
        <td>
            <span><?php echo $obj["buy_tax_amount"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >总金额：</td>
        <td>
            <span><?php echo $obj["buy_amount"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >商品重量：</td>
        <td>
            <span><?php echo $obj["product_weight"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >支付状态：</td>
        <td>
            <span>
                <?php
                    $result = "";
                    switch($obj["pay_status"]) {
                        case '0':
                            $result = '初始';
                            break;
                        case '5':
                            $result = '部分支付';
                            break;
                        case '6':
                            $result = '已支付';
                            break;
                    }
                    echo $result . "({$obj["pay_status"]})";
                ?>
            </span>
        </td>
    </tr>
    <tr>
        <td >到货状态：</td>
        <td>
            <span>
                <?php
                $result = "";
                switch($obj["receive_status"]) {
                    case '0':
                        $result = '初始';
                        break;
                    case '5':
                        $result = '部分到货';
                        break;
                    case '6':
                        $result = '已支付';
                        break;
                }
                echo $result . "({$obj["receive_status"]})";
                ?>
            </span>
        </td>
    </tr>

    <tr>
        <td >备注：</td>
        <td>
            <span><?php echo $obj["remark"]; ?></span>
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
<table class="grid_info_table">
    <thead>
    <tr>
        <th width="80">序号</th>
        <th width="80">商品编号</th>
        <th width="80">条码</th>
        <th width="60">分类</th>
        <th width="90">品牌</th>

        <th width="100">商品名称</th>
        <th>属性</th>
        <th width="70">货币类型</th>
        <th width="60">数量</th>
        <th width="70">购买价</th>
        <th width="60">消税%</th>
        <th width="80">商品金额</th>
        <th width="80">消费税金额</th>
        <th width="80">总金额</th>

        <th width="70">重量类型</th>
        <th width="80">总重量</th>

        <th width="70">到货状态</th>
        <th width="70">到货数量</th>
        <th width="70">剩余数量</th>
        <th width="100">规格</th>
        <th width="60">计量</th>
        <th width="50">图片</th>
    </tr>
    </thead>
    <?php foreach ($obj["detail_list"] as $v) { ?>
    <tr>
        <td><?php echo $v["sequence"]; ?></td>
        <td><?php echo $v["product_code"]; ?></td>
        <td><?php echo $v["product_commodity_codes"]; ?></td>
        <td><?php echo $v["product_category_name"]; ?></td>
        <td><?php echo $v["product_brand_name"]; ?></td>

        <td><?php echo $v["product_name"]; ?></td>
        <td>
            <?php
                $aJson = json_decode($v["product_attribute"], true);
                echo implode(" ", $aJson);
            ?>
        </td>
        <td><?php echo \Library\Constant\BusinessConstant::$CURRENCY[$v["product_currency_unit"]]; ?></td>
        <td><?php echo $v["purchase_number"]; ?></td>
        <td><?php echo $v["product_buy_price"]; ?></td>
        <td><?php echo $v["product_buy_tax_rate"]; ?></td>
        <td><?php echo $v["product_buy_amount"]; ?></td>
        <td><?php echo $v["product_buy_tax_amount"]; ?></td>
        <td><?php echo $v["purchase_amount"]; ?></td>

        <td><?php echo \Library\Constant\BusinessConstant::$WEIGHT[$v["product_weight_unit"]]; ?></td>
        <td><?php echo $v["purchase_weight"]; ?></td>

        <td>
            <?php
                if (5 == $v["receive_status"]) {
                    echo "部分到货";
                }
                else if (6 == $v["receive_status"]) {
                    echo "到货完毕";
                }
                else {
                    echo "未到货";
                };
            ?>
        </td>
        <td><?php echo $v["receive_number"]; ?></td>
        <td><?php echo $v["remain_number"]; ?></td>
        <td><?php echo $v["product_pack"]; ?></td>
        <td><?php echo \Library\Constant\BusinessConstant::$PRODUCT_UNIT[$v["product_unit"]]; ?></td>
        <td><?php
                if (!empty($v["product_image"])) {
                    $img = \Library\Helper\ImageHelper::getProductImageUrl() . $v["product_image"];
                    echo "<a href='{$img}' target='_blank'><img src='{$img}' height='24' /></a>";
                }
            ?>
        </td>
    </tr>
    <?php } ?>
</table>
<br/>