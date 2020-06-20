<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="front-src/css/detail.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/theme.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/reset.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/nav.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/footer.css" type="text/css" rel="stylesheet">
    <script src="front-src/js/jquery-3.5.1.min.js"></script>
    <title>花咲く旅路-详情页</title>
</head>
<body>
<nav id="nav-box">
    <ul>
        <li><a href="index.php"><img src="img/home.png" alt="home">首页</a></li>
        <li><a href="browse.php"><img src="img/browse.png" alt="browse">浏览页</a></li>
        <li><a href="search.php"><img src="img/search.png" alt="search">搜索页</a></li>
        <?php
        require_once "nav.php";
        if(isset($_SESSION['UID']))
            echo echo_already_login();
        else
            echo echo_not_login();
        ?>
    </ul>
</nav>
<section class="detail">
    <?php
        require_once "config.php";
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $sql = "SELECT * from travelimage where ImageID=?";
        $stm1=$pdo->prepare($sql);
        $stm1->bindParam(1,$_GET['imageid']);
        $stm1->execute();
        $image=$stm1->fetch();
        if(!$image){
            $i=1;
            $stm1->bindParam(1,$i);
            $stm1->execute();
            $image=$stm1->fetch();
        }

        $uid=$image['UID'];
        $sql = "SELECT * from traveluser where UID=$uid";
        $stm2=$pdo->prepare($sql);
        $stm2->execute();
        $user=$stm2->fetch();
        ?>
    <div class="author">
        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
             width="50" height="50"
             viewBox="0 0 172 172"
             style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M86,6.90688c-43.65602,0 -79.12,35.46398 -79.12,79.12c0,41.63931 32.27171,75.80172 73.1336,78.87141c0.08056,0.00655 0.16115,0.01386 0.24187,0.02015c1.9,0.13691 3.80998,0.22844 5.74453,0.22844c1.93455,0 3.84453,-0.09153 5.74453,-0.22844c0.08072,-0.0063 0.16131,-0.01361 0.24187,-0.02015c40.86189,-3.06969 73.1336,-37.2321 73.1336,-78.87141c0,-43.65602 -35.46398,-79.12 -79.12,-79.12zM86,13.78688c39.93779,0 72.24,32.3022 72.24,72.24c0,19.71706 -7.89544,37.55193 -20.6736,50.57875c-5.46671,-3.98083 -12.22246,-6.35558 -18.275,-8.47906c-7.16896,-2.5112 -13.95113,-4.89168 -15.82937,-9.03c-0.29584,-3.53288 -0.2694,-6.29176 -0.24188,-9.46l0.00672,-1.34375c3.05472,-2.9068 6.89623,-9.04167 8.21031,-14.70735c2.2704,-1.21088 5.04643,-4.11354 5.87891,-11.06578c0.41624,-3.45032 -0.56572,-6.12245 -1.94172,-7.91469c1.8576,-6.3812 5.55361,-22.53555 -0.92047,-32.96219c-2.73824,-4.40664 -6.87027,-7.18686 -12.30203,-8.28422c-3.05128,-3.77712 -8.80925,-5.83859 -16.50797,-5.83859c-11.69944,0.21672 -20.27622,3.80018 -25.4775,10.64922c-6.13352,8.084 -7.29248,20.29804 -3.45344,36.32156c-1.42072,1.79224 -2.44546,4.50307 -2.02234,8.02219c0.83592,6.95224 3.60179,9.8549 5.87219,11.06578c1.31408,5.67256 5.15215,11.80726 8.21031,14.71406l0.00672,1.31015c0.02752,3.182 0.05396,5.94696 -0.24188,9.4936c-1.88512,4.14864 -8.69992,6.55503 -15.90328,9.09719c-6.0162,2.12442 -12.73196,4.50283 -18.18765,8.43203c-12.78804,-13.02829 -20.68703,-30.87322 -20.68703,-50.59891c0,-39.93779 32.30221,-72.24 72.24,-72.24z"></path></g></g></svg>
        <p><?php echo $user['UserName'];?></p>
    </div>
    <section class="content">

        <div class="title">
            <p><?php echo $image['Title']?></p>
            <div id="fav-btn">
            <?php
            if(isset($_SESSION['UID'])) {
                $sql="SELECT * from travelimagefavor where ImageID=? AND UID=?";
                $stm3 = $pdo->prepare($sql);
                $stm3->execute(array((int)$_GET['imageid'],(int)$_SESSION['UID']));
                if ($fav = $stm3->fetch())
                    echo '<button class="fav" onclick="unfav()">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            width="50" height="50"
                            viewBox="0 0 172 172"
                            style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#f1c40f"><path d="M35.088,167.184c-0.688,0 -1.376,-0.344 -2.064,-0.688c-1.032,-0.688 -1.72,-2.408 -1.376,-3.784l15.136,-56.416l-45.408,-36.808c-1.376,-0.688 -1.72,-2.408 -1.376,-3.784c0.344,-1.376 1.72,-2.408 3.096,-2.408l58.48,-3.096l20.984,-54.696c0.688,-1.032 2.064,-2.064 3.44,-2.064c1.376,0 2.752,1.032 3.096,2.064l20.984,54.696l58.48,3.096c1.376,0 2.752,1.032 3.096,2.408c0.344,1.376 0,2.752 -1.032,3.784l-45.408,36.808l15.136,56.416c0.344,1.376 0,2.752 -1.376,3.784c-1.032,0.688 -2.752,1.032 -3.784,0l-49.192,-31.648l-49.192,31.648c-0.688,0.688 -1.032,0.688 -1.72,0.688z"></path></g></g></svg>
                            </button>';
                else
                    echo '<button class="fav" onclick="addfav()">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         width="50" height="50"
                         viewBox="0 0 172 172"
                         style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#001935"><path d="M86,3.44c-1.41918,0.00123 -2.69197,0.87377 -3.20485,2.19703l-21.21109,54.68391l-58.31875,2.97641c-1.42104,0.07193 -2.65119,1.01123 -3.09488,2.36314c-0.44369,1.35192 -0.00937,2.83748 1.09269,3.73748l45.41203,37.12781l-14.91562,56.33672c-0.36448,1.37274 0.15208,2.82834 1.30034,3.66425c1.14826,0.83591 2.69217,0.88027 3.88654,0.11168l49.0536,-31.48406l49.0536,31.48406c1.19437,0.76859 2.73828,0.72423 3.88654,-0.11168c1.14826,-0.83591 1.66481,-2.29152 1.30034,-3.66425l-14.91562,-56.33672l45.41203,-37.12781c1.10206,-0.9 1.53638,-2.38556 1.09269,-3.73748c-0.44369,-1.35192 -1.67383,-2.29121 -3.09488,-2.36314l-58.31875,-2.97641l-21.21109,-54.68391c-0.51288,-1.32326 -1.78567,-2.1958 -3.20485,-2.19703zM86,16.38703l18.80578,48.49594c0.49155,1.26528 1.68113,2.12325 3.03687,2.19031l51.6336,2.64047l-40.21844,32.88828c-1.04357,0.85326 -1.49268,2.23736 -1.14891,3.54078l13.21578,49.92703l-43.46359,-27.90297c-1.13361,-0.72914 -2.58858,-0.72914 -3.72219,0l-43.46359,27.90297l13.21578,-49.92703c0.34378,-1.30342 -0.10534,-2.68753 -1.14891,-3.54078l-40.21844,-32.88828l51.6336,-2.64047c1.35575,-0.06706 2.54532,-0.92503 3.03687,-2.19031z"></path></g></g></svg>
                         </button>';
            }
            ?>
            </div>
        </div>
        <img src="img/travel-images/normal/medium/<?php echo $image['PATH']?>" alt="picture">

        <section class="text">
            <div class="intro">
                <?php echo $image['Description']?>
            </div>
            <div class="info">
                <div class="topic"><?php echo $image['Content']?></div>
                <div class="city"><?php
                    if($result=$pdo->query('SELECT AsciiName FROM geocities WHERE GeoNameID='.$image["CityCode"]))
                        echo $result->fetch()[0];
                    ?></div>
                <div class="country"><?php
                    if($result=$pdo->query('SELECT CountryName FROM geocountries WHERE ISO="'.$image["CountryCodeISO"].'"'))
                        echo $result->fetch()[0];
                    ?></div>
            </div>
        </section>
    </section>
    <br class="clear">
</section>

<footer>
    <pre>

        Copyright © 2020 -- Charon
        Tel/Wechat:18717918671
        QQ:838800433
        Email:lemon.yang.y@gmail.com
    </pre>
</footer>

<script>
    function addfav() {
        $.ajax({
            url:"fav.php",
            type:"POST",
            contentType:"application/x-www-form-urlencoded",
            data:"code=1&ImageID="+<?=$_GET['imageid']?>,
            success:function (result) {
                document.getElementById('fav-btn').innerHTML=
                    '<button class="fav" onclick="unfav()">\n                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"\n                            width="50" height="50"\n                            viewBox="0 0 172 172"\n                            style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#f1c40f"><path d="M35.088,167.184c-0.688,0 -1.376,-0.344 -2.064,-0.688c-1.032,-0.688 -1.72,-2.408 -1.376,-3.784l15.136,-56.416l-45.408,-36.808c-1.376,-0.688 -1.72,-2.408 -1.376,-3.784c0.344,-1.376 1.72,-2.408 3.096,-2.408l58.48,-3.096l20.984,-54.696c0.688,-1.032 2.064,-2.064 3.44,-2.064c1.376,0 2.752,1.032 3.096,2.064l20.984,54.696l58.48,3.096c1.376,0 2.752,1.032 3.096,2.408c0.344,1.376 0,2.752 -1.032,3.784l-45.408,36.808l15.136,56.416c0.344,1.376 0,2.752 -1.376,3.784c-1.032,0.688 -2.752,1.032 -3.784,0l-49.192,-31.648l-49.192,31.648c-0.688,0.688 -1.032,0.688 -1.72,0.688z"></path></g></g></svg>\n                            </button>';
            }
        });
    }
    function unfav() {
        $.ajax({
            url:"fav.php",
            type:"POST",
            contentType:"application/x-www-form-urlencoded",
            data:"code=2&ImageID="+<?=$_GET['imageid']?>,
            success:function (result) {
                document.getElementById('fav-btn').innerHTML=
                    '<button class="fav" onclick="addfav()">\n                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"\n                         width="50" height="50"\n                         viewBox="0 0 172 172"\n                         style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#001935"><path d="M86,3.44c-1.41918,0.00123 -2.69197,0.87377 -3.20485,2.19703l-21.21109,54.68391l-58.31875,2.97641c-1.42104,0.07193 -2.65119,1.01123 -3.09488,2.36314c-0.44369,1.35192 -0.00937,2.83748 1.09269,3.73748l45.41203,37.12781l-14.91562,56.33672c-0.36448,1.37274 0.15208,2.82834 1.30034,3.66425c1.14826,0.83591 2.69217,0.88027 3.88654,0.11168l49.0536,-31.48406l49.0536,31.48406c1.19437,0.76859 2.73828,0.72423 3.88654,-0.11168c1.14826,-0.83591 1.66481,-2.29152 1.30034,-3.66425l-14.91562,-56.33672l45.41203,-37.12781c1.10206,-0.9 1.53638,-2.38556 1.09269,-3.73748c-0.44369,-1.35192 -1.67383,-2.29121 -3.09488,-2.36314l-58.31875,-2.97641l-21.21109,-54.68391c-0.51288,-1.32326 -1.78567,-2.1958 -3.20485,-2.19703zM86,16.38703l18.80578,48.49594c0.49155,1.26528 1.68113,2.12325 3.03687,2.19031l51.6336,2.64047l-40.21844,32.88828c-1.04357,0.85326 -1.49268,2.23736 -1.14891,3.54078l13.21578,49.92703l-43.46359,-27.90297c-1.13361,-0.72914 -2.58858,-0.72914 -3.72219,0l-43.46359,27.90297l13.21578,-49.92703c0.34378,-1.30342 -0.10534,-2.68753 -1.14891,-3.54078l-40.21844,-32.88828l51.6336,-2.64047c1.35575,-0.06706 2.54532,-0.92503 3.03687,-2.19031z"></path></g></g></svg>\n                         </button>';
            }
        });
    }
</script>
</body>
</html>
