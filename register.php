<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="front-src/css/reset.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/theme.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/nav.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/footer.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/register.css" type="text/css" rel="stylesheet">
    <title>花咲く旅路-注册页</title>
</head>
<body>
<nav id="nav-box">
    <ul>
    </ul>
</nav>
<div id="body-container">
    <div class="title-area">
        <div class="title">花咲く旅路</div>
        <div class="intro">记录旅途美好</div>
    </div>
    <section>
        <form name="register" method="post" action="register.php" onsubmit="return check();" >
            <label class="required">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     width="24" height="24"
                     viewBox="0 0 172 172"
                     style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g id="original-icon" fill="#000000"><path d="M150.5,21.5h-129v129h129zM86,43c12.18333,0 21.5,9.31667 21.5,21.5c0,12.18333 -9.31667,21.5 -21.5,21.5c-12.18333,0 -21.5,-9.31667 -21.5,-21.5c0,-12.18333 9.31667,-21.5 21.5,-21.5zM129,129h-86c0,0 0,-4.1925 0,-7.16667c0,-11.25883 19.50767,-21.5 43,-21.5c23.49233,0 43,10.24117 43,21.5c0,2.97417 0,7.16667 0,7.16667z"></path></g></g></svg>
                <input id='first-input' type="text" name="username" placeholder="用户名" required pattern="^\w+$" >
            </label>
            <br>
            <label class="required">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     width="24" height="24"
                     viewBox="0 0 172 172"
                     style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#000000"><path d="M50.16667,35.83333c-27.70633,0 -50.16667,22.46033 -50.16667,50.16667c0,27.70633 22.46033,50.16667 50.16667,50.16667c22.72313,0 41.89756,-15.11458 48.06706,-35.83333h30.76628v21.5h28.66667v-21.5h14.33333v-28.66667h-73.76628c-6.1695,-20.71875 -25.34393,-35.83333 -48.06706,-35.83333zM50.16667,64.5c11.87517,0 21.5,9.62483 21.5,21.5c0,11.87517 -9.62483,21.5 -21.5,21.5c-11.87517,0 -21.5,-9.62483 -21.5,-21.5c0,-11.87517 9.62483,-21.5 21.5,-21.5z"></path></g></g></svg>
                <input type="password" id="password" name="password" placeholder="密码" required pattern="^[0-9a-zA-Z]{8,}$">
            </label>
            <br>
            <label class="required">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     width="24" height="24"
                     viewBox="0 0 172 172"
                     style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#333333"><path d="M47.03125,35.93132c-29.40433,1.81452 -51.95665,28.95311 -46.09342,59.88086c3.741,19.74417 19.66533,35.67567 39.41667,39.41667c26.85456,5.09104 50.80642,-11.25416 57.85124,-34.89551h30.79427v7.16667c0,7.91917 6.41417,14.33333 14.33333,14.33333c7.91917,0 14.33333,-6.41417 14.33333,-14.33333v-7.16667c7.91917,0 14.33333,-6.41417 14.33333,-14.33333c0,-7.91917 -6.41417,-14.33333 -14.33333,-14.33333h-59.48893c-5.15853,-17.60669 -19.99301,-31.44722 -38.1989,-34.89551c-4.41735,-0.8376 -8.74697,-1.09906 -12.94759,-0.83984zM50.16667,64.5c11.87517,0 21.5,9.62483 21.5,21.5c0,11.87517 -9.62483,21.5 -21.5,21.5c-11.87517,0 -21.5,-9.62483 -21.5,-21.5c0,-11.87517 9.62483,-21.5 21.5,-21.5z"></path></g></g></svg>
                <input type="password" id="repassword" name="repassword" placeholder="重复密码" required pattern="^[0-9a-zA-Z]{8,}$">
            </label>
            <br>
            <label class="required">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     width="50" height="50"
                     viewBox="0 0 172 172"
                     style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none"  style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#000000"><path d="M0,24.08v123.84h172v-123.84zM158.24,55.98063l-72.24,40.9575l-72.24,-40.9575v-8.11625l72.24,40.9575l72.24,-40.9575z"></path></g></g></svg>
                <input type="email" id="email" name="email" placeholder="邮箱" required>
            </label>
            <br>
            <div>
                <button name="submit"  id="register-btn">注册</button>
            </div>
            <div id="info1" class="info">
                <?php
                require_once("config.php");
                function register(){
                    if(!preg_match("/^\w+$/",$_POST['username'])){
                        echo '非法用户名。';
                        die();
                    }
                    if(!preg_match("/^[0-9a-zA-Z]{8,}$/",$_POST['password'])){
                        echo '弱密码。请使用较为复杂的密码。';
                        die();
                    }
                    if(!preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/",$_POST['email'])){
                        echo '请使用正确的邮箱地址。';
                        die();
                    }
                    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
                    $sql= "SELECT * FROM traveluser WHERE UserName=?";
                    $statement = $pdo->prepare($sql);
                    $statement->execute(array($_POST['username']));
                    if($statement->fetch()){
                        echo "用户名已被占用";
                        die();
                    }
                    $pass=password_hash ( $_POST['password'],PASSWORD_DEFAULT);
                    $sql = "INSERT INTO traveluser(UserName,Pass,Email) VALUES(?,?,?)";
                    $statement = $pdo->prepare($sql);
                    if($statement->execute(array($_POST['username'],$pass,$_POST['email'])))
                        return true;
                    return false;
                }
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $is_reg = register();
                    if ($is_reg) {
                        echo "注册成功";
                        echo '<script>setTimeout(function () {
                            window.location.href="login.php"
                            }, 500);
                        </script>';
                    }
                    else echo '用户名或密码错误,请重试。';
                }
                ?>
            </div>
        </form>
    </section>
    <br class="clear">
</div>
<script>
    function check() {
        if(document.getElementById('password').value!==document.getElementById('repassword').value){
            document.getElementById('info1').innerHTML="重复密码不匹配";
            return false;
        }
        return true;
    }
</script>
<footer>
    <pre>

        Copyright © 2020 -- Charon
    </pre>
</footer>
</body>
</html>
