<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="front-src/css/reset.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/theme.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/nav.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/footer.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/login.css" type="text/css" rel="stylesheet">
    <title>花咲く旅路-登录</title>
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
        <form id="form" name="login" method="post" action="login.php">
            <label class="required">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     width="24" height="24"
                     viewBox="0 0 172 172"
                     style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g id="original-icon" fill="#000000"><path d="M150.5,21.5h-129v129h129zM86,43c12.18333,0 21.5,9.31667 21.5,21.5c0,12.18333 -9.31667,21.5 -21.5,21.5c-12.18333,0 -21.5,-9.31667 -21.5,-21.5c0,-12.18333 9.31667,-21.5 21.5,-21.5zM129,129h-86c0,0 0,-4.1925 0,-7.16667c0,-11.25883 19.50767,-21.5 43,-21.5c23.49233,0 43,10.24117 43,21.5c0,2.97417 0,7.16667 0,7.16667z"></path></g></g></svg>
                <input id='first-input' type="text" name="username" placeholder="用户名" required >
            </label>
            <br>
            <label class="required">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     width="24" height="24"
                     viewBox="0 0 172 172"
                     style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#000000"><path d="M50.16667,35.83333c-27.70633,0 -50.16667,22.46033 -50.16667,50.16667c0,27.70633 22.46033,50.16667 50.16667,50.16667c22.72313,0 41.89756,-15.11458 48.06706,-35.83333h30.76628v21.5h28.66667v-21.5h14.33333v-28.66667h-73.76628c-6.1695,-20.71875 -25.34393,-35.83333 -48.06706,-35.83333zM50.16667,64.5c11.87517,0 21.5,9.62483 21.5,21.5c0,11.87517 -9.62483,21.5 -21.5,21.5c-11.87517,0 -21.5,-9.62483 -21.5,-21.5c0,-11.87517 9.62483,-21.5 21.5,-21.5z"></path></g></g></svg>
                <input type="password" id="password" name="password" placeholder="密码" required>
            </label>
            <br>
            <div>
                <button name="submit" id="login-btn">登录</button>
            </div>
            <div id="info1" class="info">
            <?php
            require_once("config.php");
            session_start();
            function login(){
                $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
                $sql = "SELECT * FROM traveluser WHERE UserName=:user";

                $statement = $pdo->prepare($sql);
                $statement->bindValue(':user',$_POST['username']);
                $statement->execute();
                if($statement->rowCount()>0){
                    $result=$statement->fetch();
                    if(password_verify($_POST['password'],$result['Pass']))
                        return $result['UID'];
                    return -1;

                }
                return -1;
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $is_login = login();
                if ($is_login > 0) {
                    $_SESSION['UID'] = $is_login;
                    $_SESSION['UserName'] = $_POST['username'];
                    header("Location: http://".$_SERVER['HTTP_HOST']);
                }
                else echo '用户名或密码错误,请重试。';
            }
            ?>
            </div>
            <div id="reg-btn">
                <a href="register.php">没有账号？点击注册</a>
            </div>

        </form>
    </section>
    <br class="clear">
</div>
<footer>
    <pre>
        Copyright © 2020 -- Charon
    </pre>
</footer>
</body>
</html>
