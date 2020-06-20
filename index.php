<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <link href="front-src/css/reset.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/theme.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/nav.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/footer.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/index.css" type="text/css" rel="stylesheet">
    <
    <title>花咲く旅路-首页</title>
</head>
<body>

<nav id="nav-box">
    <ul>
        <li><a href="index.php" style="color: #f35200"><img src="img/home.png" alt="home">首页</a></li>
        <li><a href="browse.php"><img src="img/browse.png" alt="browse">浏览页</a></li>
        <li><a href="search.php"><img src="img/search.png" alt="search">搜索页</a></li>
        <?php
            session_start();
            require_once "nav.php";
            if(isset($_SESSION['UID']))
                echo echo_already_login();
            else
                echo echo_not_login();
        ?>
    </ul>
</nav>
<section>
    <div class="big-pic"><img src="img/bg-cut.jpg" alt="bg"></div>
    <div class="title-area">
        <div class="title">花咲く旅路</div>
        <div class="intro">——记录旅途美好</div>
    </div>
    <section class="hot-pics">
        <div id="pics">
        <?php
            require_once "config.php";
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $sql = "SELECT * from travelimage where ImageID in (SELECT ImageID FROM(SELECT ImageID,count(distinct UID)as sum FROM travelimagefavor group by ImageID 
                UNION 
                SELECT ImageID,0 FROM travelimage WHERE ImageID not in (SELECT ImageID FROM travelimagefavor)
                order by sum desc limit 0,6)a)";
        $stm=$pdo->prepare($sql);
        if($stm->execute()) {
            while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                echo
                    '<article>
                <header class="pic-title">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                    width="50" height="50"
                    viewBox="0 0 172 172"
                    style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#f35200"><path d="M86,114.853l-30.99583,18.71217l8.22733,-35.26l-27.39817,-23.736l36.04117,-3.06017l14.1255,-33.33217l14.1255,33.33217l36.04117,3.06017l-27.39817,23.736l8.22733,35.26z" opacity="0.3"></path><path d="M165.21317,64.51433l-56.9535,-4.83033l-22.25967,-52.51733l-22.25967,52.51733l-56.9535,4.83033l43.25083,37.46733l-12.99317,55.685l48.9555,-29.54817l48.9555,29.54817l-12.99317,-55.685zM86,111.37717l-27.27633,16.46183l7.23833,-31.03167l-24.10867,-20.88367l31.7125,-2.6875l12.43417,-29.34033l12.43417,29.34033l31.7125,2.6875l-24.10867,20.89083l7.23833,31.03167z"></path></g></g></svg>
                <p>' . $row['Title'] . '</p>
                </header>
//                <a href="detail.php?imageid='.$row['ImageID'].'">
                    <img class="hot-pic" src="img/travel-images/normal/medium/' . $row['PATH'] . '" alt="img1">
                    <div class="pic-intro">
                        <p>' . $row['Description'] . '</p>
                        </div>
                </a>
            </article>';
            }
        }
        ?>
        </div>
        <div class="float">
            <button id="float1" class="float1" onclick="f1()">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                        width="24" height="24"
                                        viewBox="0 0 172 172"
                                        style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#001935"><path d="M86,23.94954c-1.83377,0 -3.66597,0.71252 -5.06706,2.11361l-40.53646,40.53646c-2.80217,2.795 -2.80217,7.33195 0,10.13411l0.61588,0.61589c2.795,2.80217 7.33195,2.80217 10.13412,0l27.68685,-27.68685v93.67057c0,3.956 3.21067,7.16667 7.16667,7.16667c3.956,0 7.16667,-3.21067 7.16667,-7.16667v-93.67057l27.68685,27.68685c2.795,2.80217 7.33195,2.80217 10.13412,0l0.61588,-0.61589c2.80217,-2.795 2.80217,-7.33195 0,-10.13411l-40.53646,-40.53646c-1.3975,-1.40108 -3.23328,-2.11361 -5.06706,-2.11361z"></path></g></g>
                </svg>
            </button>
            <button id="float2" class="float2" onclick=f2()>
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                        width="32" height="32"
                                        viewBox="0 0 172 172"
                                        style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#001935"><path d="M86,21.5c-27.48389,0 -50.43261,16.98584 -59.79687,40.98438l9.91016,4.03125c7.83154,-20.07227 26.83301,-34.26562 49.88672,-34.26562c17.42676,0 32.96387,8.54541 42.66406,21.5h-21.16406v10.75h37.625v-37.625h-10.75v16.62891c-11.77881,-13.50049 -29.18457,-22.00391 -48.375,-22.00391zM135.88672,105.48438c-7.83154,20.07227 -26.83301,34.26563 -49.88672,34.26563c-17.61572,0 -33.08984,-8.67139 -42.83203,-21.5h21.33203v-10.75h-37.625v37.625h10.75v-16.62891c11.75781,13.33252 28.9956,22.00391 48.375,22.00391c27.48389,0 50.43262,-16.98584 59.79688,-40.98437z"></path></g></g>
                </svg>
            </button>
        </div>
        <script>
            function f1(){
                document.body.scrollTop = document.documentElement.scrollTop = 0;
            }
            function f2() {
                let request =new XMLHttpRequest();
                request.open("POST", "refresh_hot_pics.php", true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(null);
                request.onreadystatechange = function() {
                    console.log(request.responseText);
                    if (request.readyState === 4)
                        document.getElementById('pics').innerHTML = request.responseText;
                }
            }
        </script>
    </section>
</section>
<footer>
    <pre>

        Copyright © 2020 -- Charon
        Tel/Wechat:18717918671
        QQ:838800433
        Email:lemon.yang.y@gmail.com
    </pre>
</footer>
</body>
</html>
