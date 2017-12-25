<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <script src="/js/jquery/jquery-1.7.2.js"></script>
</head>
    <style type="text/css">
        .login-error{width: 402px;height: 20px;color: #ff0000; margin-top: 10px;}
        *{padding: 0;margin: 0;}
        img{vertical-align: top;}
        .main{width: 460px;margin: 0 auto;padding-top: 200px;}
        .login-logo{width: 112px;height: 48px;margin: 0 auto;}
        .login-box{width: 400px;height: 250px;background: #eeeeee; margin-top: 45px; padding: 20px 30px 40px;}
        .login-box h1{color: #666666;font: 14px/18px arial,sans-serif; margin-top: 15px;}
        .login-box p{width: 398px;height: 38px;border: 1px solid #cccccc; margin-top: 10px;}
        .login-box p input{width: 378px;height: 38px;border: none; padding: 0 10px; color: #bbbbbb;
            font: 14px arial,sans-serif;}
        .login-box button{width: 400px;height: 40px;background: #3ab7f8;border: none; color: #fff; font-size: 16px;
            margin-top: 30px;}
    </style>
    <script>
        $(function(){
            document.onkeydown = function(e){
                var ev = document.all ? window.event : e;
                if(ev.keyCode==13) {
                    if ('' != $("#login_index_userName").val() && '' != $("#login_index_pwd").val()) {
                        login();
                    }
                }
            }
        });

        function login() {
            $.ajax({
                type: "POST",
                url: "/Login/validation",
                data: {userName: $("#login_index_userName").val(), pwd: $("#login_index_pwd").val(), _token: $("#login_index_token").val()},
                dataType: "json",
                success: function(json) {
                    if (json.flag == 0) {
                        location.href = json.message;
                    }
                    else {
                        $(".login-error").html(json.message);
                    }
                }
            });
        }

    </script>


<body>


    <div class="main">
<!--        <div class="login-logo"><img src="/tlStatic/images/logo.png" />-->
<!--        </div>-->
        <div class="login-box">
            <h1>用户名</h1>
            <p><input type="text" id="login_index_userName" name="userName" placeholder="输入用户名"></p>
            <h1>密码</h1>
            <p><input type="password" id="login_index_pwd" name="pwd" placeholder="输入密码"></p>
            <input type="hidden" name="_token" id="login_index_token" value="<?php echo csrf_token(); ?>"/>
            <button onclick="login()">登录</button>
            <div class="login-error"></div>

        </div>
    </div>

</body>
</html>