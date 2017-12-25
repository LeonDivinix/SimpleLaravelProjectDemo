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
        <td >条码：</td>
        <td>
            <span><?php echo $obj["commodity_codes"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >名称：</td>
        <td>
            <span><?php echo $obj["name"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >外文名：</td>
        <td>
            <span><?php echo $obj["e_name"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >品牌id：</td>
        <td>
            <span><?php echo $obj["brand_id"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >分类id：</td>
        <td>
            <span><?php echo $obj["category_id"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >计量单位：</td>
        <td>
            <span>
                <?php
                echo \Library\Constant\BusinessConstant::$PRODUCT_UNIT[$obj["unit"]] . "(" . $obj["unit"] . ")";
                ?>
            </span>
        </td>
    </tr>
    <tr>
        <td >规格描述：</td>
        <td>
            <span><?php echo $obj["pack"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >货币单位：</td>
        <td>
            <span>
                <?php
                echo \Library\Constant\BusinessConstant::$CURRENCY[$obj["currency_unit"]] . "(" . $obj["currency_unit"] . ")";
                ?>
            </span>
        </td>
    </tr>
    <tr>
        <td >购买价：</td>
        <td>
            <span><?php echo $obj["buy_price"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >消费税率%：</td>
        <td>
            <span><?php echo $obj["buy_tax_rate"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >消费税：</td>
        <td>
            <span><?php echo $obj["buy_tax"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >毛利率%：</td>
        <td>
            <span><?php echo $obj["sold_rate"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >重量单位：</td>
        <td>
            <span>
                <?php
                echo \Library\Constant\BusinessConstant::$WEIGHT[$obj["weight_unit"]] . "(" . $obj["weight_unit"] . ")";
                ?>
            </span>
        </td>
    </tr>
    <tr>
        <td >重量：</td>
        <td>
            <span><?php echo $obj["weight"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >说明：</td>
        <td>
            <span><?php echo $obj["description"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >保质期：</td>
        <td>
            <span><?php echo $obj["life"]; ?></span>
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
        <td >排序：</td>
        <td>
            <span><?php echo $obj["sort"]; ?></span>
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
