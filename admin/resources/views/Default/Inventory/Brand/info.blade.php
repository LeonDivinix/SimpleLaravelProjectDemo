<table class="grid_info_table">
    <tr>
        <td >id：</td>
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
        <td >图片：</td>
        <td>
            <span><?php echo $obj["image"]; ?></span>
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
</table>
