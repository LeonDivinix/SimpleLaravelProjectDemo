<fieldset style="width: 400px;" data-dojo-type="dijit/Fieldset">
    <legend>清空Static库字段缓存</legend>
    <button data-dojo-type="dijit/form/Button" style="padding-left: 50px" onclick="ttht_tool_fiield_mcache()" type="button">清空</button>
</fieldset>
<div>&nbsp;</div>
<script>
    function ttht_tool_fiield_mcache() {
        progressDialog.show();
        request(
            "/Tool/emptyFieldCache",
            {
                handleAs: "json",
                method: "get",
                timeout: 300000 // 5分钟过期
            }
        ).then(
            function (json) {
                progressDialog.hide();
                if (0 === json.flag) {
                    Toast.message("操作完成");
                }
                else if (999 == json.flag) {
                    location.href = json.message;
                }
                else {
                    Toast.error(json.message);
                }
            },
            function (err) {
                //
            }
        );
    }
</script>