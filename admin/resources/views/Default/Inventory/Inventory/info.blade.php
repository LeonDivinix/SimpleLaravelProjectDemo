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
        <td >商品编号：</td>
        <td>
            <span><?php echo $obj["product_code"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >条码：</td>
        <td>
            <span><?php echo $obj["product_commodity_codes"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >商品名称：</td>
        <td>
            <span><?php echo $obj["product_name"] . "{$obj["product_id"]}"; ?></span>
        </td>
    </tr>
    <tr>
        <td >分类：</td>
        <td>
            <span><?php echo $obj["product_category_name"] . "({$obj["product_category_id"]})"; ?></span>
        </td>
    </tr>
    <tr>
        <td >品牌：</td>
        <td>
            <span><?php echo $obj["product_brand_name"] . "({$obj["product_brand_id"]})"; ?></span>
        </td>
    </tr>
    <tr>
        <td >商品数量：</td>
        <td>
            <span><?php echo $obj["num"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >重量单位：</td>
        <td>
            <span>
                <?php
                    echo \Library\Constant\BusinessConstant::$WEIGHT[$obj["product_weight_unit"]] . "(" . $obj["product_weight_unit"] . ")";
                ?>
            </span>
        </td>
    </tr>
    <tr>
        <td >重量：</td>
        <td>
            <span><?php echo $obj["product_weight"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >合计总重量：</td>
        <td>
            <span><?php echo $obj["total_weight"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >货币单位：</td>
        <td>
            <span>
                <?php
                    echo \Library\Constant\BusinessConstant::$CURRENCY[$obj["product_currency_unit"]] . "(" . $obj["product_currency_unit"] . ")";
                ?>
            </span>
        </td>
    </tr>
    <tr>
        <td >商品购买价：</td>
        <td>
            <span><?php echo $obj["product_buy_price"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >消费税率：</td>
        <td>
            <span><?php echo $obj["product_buy_tax_rate"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >消费税：</td>
        <td>
            <span><?php echo $obj["product_buy_tax"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >折算快递费：</td>
        <td>
            <span><?php echo $obj["express_price"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >成本价：</td>
        <td>
            <span><?php echo $obj["cost"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >成本总金额：</td>
        <td>
            <span><?php echo $obj["total_amount"]; ?></span>
        </td>
    </tr>
    <tr>
        <td ><span style="font-weight: bold;color: blue">汇率</span>：</td>
        <td>
            <span style="font-weight: bold;color: blue"><?php echo $obj["exchange_rate"]; ?></span>
        </td>
    </tr>
    <tr>
        <td ><span style="font-weight: bold;color: blue">成本价¥</span>：</td>
        <td>
            <span style="font-weight: bold;color: blue"><?php echo $obj["cost_local"]; ?></span>
        </td>
    </tr>
    <tr>
        <td ><span style="font-weight: bold;color: blue">成本总金额¥</span>：</td>
        <td>
            <span style="font-weight: bold;color: blue"><?php echo $obj["total_amount_local"]; ?></span>
        </td>
    </tr>
    <tr>
        <td ><span style="font-weight: bold;color: blue">毛利率%</span>：</td>
        <td>
            <span style="font-weight: bold;color: blue"><?php echo $obj["sold_rate"]; ?></span>
        </td>
    </tr>
    <tr>
        <td ><span style="font-weight: bold;color: blue">销售价</span>：</td>
        <td>
            <span style="font-weight: bold;color: blue"><?php echo $obj["sold_price"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >属性：</td>
        <td>
            <span><?php echo $obj["product_attribute"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >计量单位：</td>
        <td>
            <span>
                <?php
                    echo $obj["product_unit"], ": ";
                    $result = "";
                    switch($obj["product_unit"]) {
                        case '\Library\Constant\BusinessConstant':
                            $result = '';
                            break;
                    }
                    echo $result;
                ?>
            </span>
        </td>
    </tr>
    <tr>
        <td >规格：</td>
        <td>
            <span><?php echo $obj["product_pack"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >图片：</td>
        <td>
            <span><?php echo $obj["product_image_id"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >保质期：</td>
        <td>
            <span><?php echo $obj["product_life"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >生产日期：</td>
        <td>
            <span><?php echo $obj["product_date"]; ?></span>
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
                            $result = '初始';
                            break;
                        case '99':
                            $result = '已标价';
                            break;
                    }
                    echo $result . "(" . $obj["status"] . ")";
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
        <td >到货id：</td>
        <td>
            <span><?php echo $obj["receive_id"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >到货编号：</td>
        <td>
            <span><?php echo $obj["receive_code"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >到货明细id：</td>
        <td>
            <span><?php echo $obj["receive_detail_id"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >采购id：</td>
        <td>
            <span><?php echo $obj["purchase_id"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >采购编号：</td>
        <td>
            <span><?php echo $obj["purchase_code"]; ?></span>
        </td>
    </tr>
    <tr>
        <td >采购明细id：</td>
        <td>
            <span><?php echo $obj["purchase_detail_id"]; ?></span>
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
