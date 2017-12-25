<table border="0">
    <tr>
        <td valign="top">
            <table class="grid_info_table">

                <tr>
                    <td >编号：</td>
                    <td>
                        <span><?php echo $obj["code"]; ?></span>
                    </td>
                </tr>
                <tr>
                    <td >采购单编号：</td>
                    <td>
                        <span><?php echo $obj["purchase_code"]; ?></span>
                    </td>
                </tr>
                <tr>
                    <td >标题说明：</td>
                    <td>
                        <span><?php echo $obj["title"]; ?></span>
                    </td>
                </tr>
                <tr>
                    <td >货币单位：</td>
                    <td>
                    <span>
                    <?php
                        echo \Library\Constant\BusinessConstant::$CURRENCY[$obj["currency_unit"]] . "({$obj["currency_unit"]})";
                        ?>
                    </span>
                    </td>
                </tr>
                <tr>
                    <td >商品金额：</td>
                    <td>
                        <span><?php echo $obj["buy_amount"]; ?></span>
                    </td>
                </tr>
                <tr>
                    <td >快递费用：</td>
                    <td>
                        <span><?php echo $obj["express_amount"]; ?></span>
                    </td>
                </tr>
                <tr>
                    <td >消费税金额：</td>
                    <td>
                        <span><?php echo $obj["buy_tax_amount"]; ?></span>
                    </td>
                </tr>
                <tr>
                    <td >总金额：</td>
                    <td>
                        <span><?php echo $obj["total_amount"]; ?></span>
                    </td>
                </tr>
                <tr>
                    <td >重量单位：</td>
                    <td>
                        <span>
                        <?php
                            echo \Library\Constant\BusinessConstant::$WEIGHT[$obj["weight_unit"]] . "({$obj["weight_unit"]})";
                            ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td >商品重量：</td>
                    <td>
                        <span><?php echo $obj["product_weight"]; ?></span>
                    </td>
                </tr>
                <tr>
                    <td >快递包装重量：</td>
                    <td>
                        <span><?php echo $obj["express_weight"]; ?></span>
                    </td>
                </tr>
                <tr>
                    <td >总重量：</td>
                    <td>
                        <span><?php echo $obj["total_weight"]; ?></span>
                    </td>
                </tr>
            </table>
        </td>
        <td style="width: 70px">
        </td>
        <td valign="top">
            <table class="grid_info_table">
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
                                    $result = '已入库';
                                    break;
                            }
                            echo $result . "({$obj["status"]})";
                        ?>
                    </span>
                    </td>
                </tr>
                <tr>
                    <td >快递公司：</td>
                    <td>
                    <span>
                    <?php
                        echo \Library\Constant\BusinessConstant::$EXPRESS_COMPANY[$obj["express_company"]] . "({$obj["express_company"]})";
                        ?>
                    </span>
                    </td>
                </tr>
                <tr>
                    <td >快递单号：</td>
                    <td>
                        <span><?php echo $obj["express_code"]; ?></span>
                    </td>
                </tr>
                <tr>
                    <td >供应商：</td>
                    <td>
                        <span><?php echo $obj["supplier"]; ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px">id：</td>
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
                    <td >采购单id：</td>
                    <td>
                        <span><?php echo $obj["purchase_id"]; ?></span>
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
        </td>
        <td valign="top">
            <?php $receiveExpressImageUrl = \Library\Helper\ImageHelper::getReceiveImageUrl() . $obj["image"] ?>
            <a href="<?php echo $receiveExpressImageUrl ?>" target="_blank"><img src="<?php echo $receiveExpressImageUrl ?>" width="100"></a>
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
        <th width="60">数量</th>
        <th width="70">货币类型</th>
        <th width="70">单价</th>
        <th width="60">消税%</th>
        <th width="70">商品金额</th>
        <th width="60">消税</th>
        <th width="60">快递费</th>
        <th width="80">总金额</th>

        <th width="70">重量类型</th>
        <th width="70">商品重量</th>
        <th width="80">总重量</th>

        <th width="100">规格</th>
        <th width="60">计量</th>
        <th width="50">图片</th>
    <th width="100">保质期</th>
    <th width="100">生产日期</th>
        <th width="100">商品属性</th>
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
        <td><?php echo $v["num"]; ?></td>
        <td><?php echo \Library\Constant\BusinessConstant::$CURRENCY[$v["product_currency_unit"]]; ?></td>
        <td><?php echo $v["product_buy_price"]; ?></td>
        <td><?php echo $v["product_buy_tax_rate"]; ?></td>
        <td><?php echo $v["product_buy_amount"]; ?></td>
        <td><?php echo $v["product_buy_tax_amount"]; ?></td>
        <td><?php echo $v["express_amount"]; ?></td>
        <td><?php echo $v["total_amount"]; ?></td>

        <td><?php echo \Library\Constant\BusinessConstant::$WEIGHT[$v["product_weight_unit"]]; ?></td>
        <td><?php echo $v["product_weight"]; ?></td>
        <td><?php echo $v["total_weight"]; ?></td>

        <td><?php echo $v["product_pack"]; ?></td>
        <td><?php echo \Library\Constant\BusinessConstant::$PRODUCT_UNIT[$v["product_unit"]]; ?></td>
        <td><?php
            if (!empty($v["product_image"])) {
                $img = \Library\Helper\ImageHelper::getProductImageUrl() . $v["product_image"];
                echo "<a href='{$img}' target='_blank'><img src='{$img}' height='24' /></a>";
            }
            ?>
        </td>
        <td><?php echo $v["product_life"]; ?>天</td>
        <td><?php echo $v["product_date"]; ?></td>
        <td>
            <?php
            $aJson = json_decode($v["product_attribute"], true);
            echo implode(" ", $aJson);
            ?>
        </td>
    </tr>
    <?php } ?>
</table>
<br />

