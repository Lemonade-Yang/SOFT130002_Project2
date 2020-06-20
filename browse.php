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
    <link href="front-src/css/browse.css" type="text/css" rel="stylesheet">
    <script src="front-src/js/jquery-3.5.1.min.js"></script>
    <script src="front-src/js/jquery.cookie.js"></script>
    <link rel="stylesheet" href="front-src/css/selectpage.css" type="text/css">
    <script type="text/javascript" src="front-src/js/selectpage.js"></script>
    <title>花咲く旅路-浏览页</title>
</head>
<body>
<nav id="nav-box">
    <ul>
        <li><a href="index.php"><img src="img/home.png" alt="home">首页</a></li>
        <li><a href="browse.php" style="color: #f35200"><img src="img/browse.png" alt="browse">浏览页</a></li>
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
<section id="body-container">
    <section class="left">
        <div class="search">
            <form id="kword-form" method="post" name="kword-form" onsubmit="return false"  >
                <label >
                    <input id="kword" type="text" onfocus="placeholder=''" name="kword" placeholder="输入图片名">
                </label>
                <label>
                    <button onclick="search($('#kword-form').serialize()+'type=1',1)" >
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             width="24" height="24"
                             viewBox="0 0 172 172"
                             style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M35.83333,21.5c-7.91917,0 -14.33333,6.41417 -14.33333,14.33333v100.33333c0,7.91917 6.41417,14.33333 14.33333,14.33333h100.33333c7.91917,0 14.33333,-6.41417 14.33333,-14.33333v-100.33333c0,-7.91917 -6.41417,-14.33333 -14.33333,-14.33333zM35.83333,35.83333h100.33333v100.33333h-100.33333zM82.41667,50.16667c-17.80917,0 -32.25,14.44083 -32.25,32.25c0,17.80917 14.44083,32.25 32.25,32.25c6.30667,0 12.13832,-1.87924 17.10482,-5.01107l17.24479,17.24479l10.13411,-10.13411l-17.24479,-17.24479c3.13183,-4.9665 5.01107,-10.79815 5.01107,-17.10482c0,-17.80917 -14.44083,-32.25 -32.25,-32.25zM82.41667,64.5c9.89717,0 17.91667,8.0195 17.91667,17.91667c0,9.89717 -8.0195,17.91667 -17.91667,17.91667c-9.89717,0 -17.91667,-8.0195 -17.91667,-17.91667c0,-9.89717 8.0195,-17.91667 17.91667,-17.91667z"></path></g></g></svg>
                    </button>
                </label>
            </form>
        </div>
        <div class="country">
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     width="50" height="50"
                     viewBox="0 0 172 172"
                     style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M86,3.44c-17.79767,0 -32.49717,13.61452 -34.23203,30.96c-3.59602,-0.01682 -6.49596,-0.26095 -9.41969,1.34375c-1.50915,0.8283 -2.7813,2.33885 -3.41313,4.00438c-0.63183,1.66552 -0.81297,3.44834 -0.81297,5.54969c0.00091,0.53688 0.12746,1.0661 0.36953,1.54531c1.63267,3.24446 2.21431,6.52313 2.0761,8.52609c-0.05604,0.81231 -0.22268,1.17451 -0.32922,1.41765c-4.39523,-1.41348 -8.92045,-1.05221 -12.43641,0.18141c-2.03657,0.71457 -3.75353,1.58483 -5.11969,2.62703c-0.68308,0.5211 -1.29513,1.04352 -1.86109,1.97531c-0.28298,0.4659 -0.58096,1.06893 -0.65172,1.935c-0.01304,0.15938 0.1427,0.33657 0.15453,0.51062c-0.02422,0.05975 -0.00281,0.00963 -0.07391,0.14781c-0.2844,0.5531 -0.90379,1.54847 -1.70656,2.72109c-1.60554,2.34525 -3.95527,5.48007 -6.29547,8.68063c-2.3402,3.20055 -4.67138,6.45652 -6.35594,9.29875c-0.84228,1.42112 -1.52719,2.71376 -1.98875,4.0514c-0.46156,1.33765 -1.15105,3.15188 0.43672,5.25406c0.36767,0.48971 0.85938,0.87242 1.42437,1.1086c6.60508,2.73322 10.0606,5.63667 11.99969,8.34469c1.93909,2.70801 2.51909,5.3652 2.80172,8.29094c0.28263,2.92573 0.0878,6.03434 1.09516,9.32563c0.98214,3.20889 3.73325,6.29314 8.05578,7.73328c0.50055,0.21135 1.03867,0.76139 1.53859,2.12312c0.49992,1.36174 0.79908,3.32628 0.88687,5.28094c0.17558,3.90932 -0.40312,7.6325 -0.40312,7.6325c-0.16582,1.04827 0.16146,2.11439 0.88687,2.88906c0,0 3.22451,3.44232 6.74562,6.7389c1.76056,1.64829 3.57726,3.26088 5.2675,4.48141c0.84513,0.61027 1.62976,1.13218 2.59344,1.53859c0.48184,0.2032 1.01504,0.3913 1.77375,0.45016c0.75871,0.05886 1.90982,-0.07988 2.87562,-0.83985c-1.05751,0.83161 -0.8586,0.35603 -0.15453,0.38297c0.70626,0.02718 1.86618,0.17386 3.225,0.43c2.71765,0.51229 6.28156,1.42025 9.82281,2.34485c3.54126,0.9246 7.05569,1.8638 9.90344,2.45906c1.42387,0.29763 2.65746,0.52223 3.82969,0.59125c0.58611,0.0345 1.15182,0.04791 1.88797,-0.09406c0.73615,-0.14197 2.01283,-0.46098 2.86219,-1.9686c0,-0.00224 0,-0.00448 0,-0.00672c0.79133,-1.41084 2.03619,-4.0966 3.82969,-7.00765c1.67412,-2.7173 3.79828,-5.09366 5.18688,-6.02672c0.12903,0.02993 0.15286,0.0203 0.31578,0.06719c0.95904,0.27517 2.42588,0.83548 4.13203,1.5789c3.41229,1.48685 7.84273,3.71337 12.28187,6.03344c4.43915,2.32007 8.89942,4.73398 12.49687,6.63141c1.79873,0.94871 3.37711,1.76409 4.66281,2.39187c1.2857,0.62778 1.94689,1.04635 3.29219,1.35047c2.86002,0.64634 4.73577,-0.52024 6.71875,-1.6461c1.98298,-1.12586 3.97883,-2.60721 5.87219,-4.12531c1.89336,-1.5181 3.66357,-3.07207 5.04578,-4.31344c1.38221,-1.24137 2.65999,-2.37922 2.51281,-2.26422c0.85579,-0.66849 1.30622,-1.75253 1.3975,-2.4725c0.09126,-0.71997 -0.00825,-1.18846 -0.10078,-1.56547c-0.18511,-0.75403 -0.42477,-1.2068 -0.6786,-1.69313c-0.50764,-0.97266 -1.13454,-1.9391 -1.78719,-2.96297c-1.18221,-1.85464 -2.26941,-3.93039 -2.53297,-4.56875v-0.00672c0.03578,-0.25138 0.10005,-0.77622 0.31578,-1.34375c0.43351,-1.14043 1.17332,-2.73609 2.10297,-4.55531c1.8593,-3.63844 4.47843,-8.21426 7.08828,-12.72531c2.60985,-4.51105 5.20792,-8.95457 7.095,-12.49015c0.94354,-1.76779 1.70989,-3.28691 2.24406,-4.60906c0.26708,-0.66108 0.48119,-1.2538 0.62485,-1.98203c0.14365,-0.72823 0.6504,-1.90059 -0.79953,-3.61469c-0.3258,-0.38346 -0.73174,-0.69079 -1.18922,-0.90031c-4.84288,-2.2283 -7.76686,-8.10313 -9.25172,-14.04219c-0.74243,-2.96952 -1.12438,-5.8607 -1.30344,-8.04906c-0.07578,-0.92609 -0.10253,-1.63505 -0.12094,-2.2575c0.07141,-0.03636 0.07744,-0.04292 0.15453,-0.08062c1.05623,-0.51657 2.62774,-1.17229 4.2261,-1.8275c1.59835,-0.65521 3.22589,-1.30936 4.56875,-1.91485c0.67143,-0.30275 1.26261,-0.58704 1.83422,-0.92047c0.2858,-0.1667 0.56734,-0.33819 0.91375,-0.62485c0.34559,-0.28597 0.91372,-0.57163 1.31015,-1.92828v-0.00672c2.00066,-6.85688 3.11248,-11.91676 2.795,-16.24594c-0.30592,-4.1718 -2.80212,-7.71613 -6.39625,-9.39953c-2.06086,-1.46696 -4.39091,-1.77744 -6.68515,-1.71328c-2.492,0.06969 -5.1128,0.54166 -7.73328,1.12203c-4.49635,0.99582 -8.48244,2.06008 -11.15313,2.53297l-6.24172,-9.30547c-0.63824,-0.95242 -1.70898,-1.52432 -2.85547,-1.52515h-7.22265c-1.7347,-17.34499 -16.42488,-30.96 -34.22531,-30.96zM86,10.32c15.24438,0 27.52,12.28568 27.52,27.52c0,8.84412 -7.31355,23.4787 -14.92906,35.27344c-6.28332,9.73147 -10.5625,14.84719 -12.57078,17.3411c-1.99982,-2.52409 -6.30642,-7.76062 -12.60437,-17.58297c-7.62125,-11.88619 -14.93578,-26.57831 -14.93578,-35.03156c0,-15.23386 12.27943,-27.52 27.52,-27.52zM86,24.08c-7.55869,0 -13.76,6.20131 -13.76,13.76c0,7.55869 6.20131,13.76 13.76,13.76c7.55869,0 13.76,-6.20131 13.76,-13.76c0,-7.55869 -6.20131,-13.76 -13.76,-13.76zM86,30.96c3.84046,0 6.88,3.03954 6.88,6.88c0,3.84046 -3.03954,6.88 -6.88,6.88c-3.84046,0 -6.88,-3.03954 -6.88,-6.88c0,-3.84046 3.03954,-6.88 6.88,-6.88zM120.17828,41.28h5.43547l6.51047,9.7086c0.69593,1.03741 1.89953,1.61606 3.14438,1.51172c4.00593,-0.33182 9.07785,-2.01122 13.92125,-3.08391c2.4217,-0.53634 4.72681,-0.91297 6.43656,-0.96078c1.70975,-0.04782 2.61363,0.36078 2.60016,0.34937c0.27203,0.22945 0.57801,0.41531 0.90703,0.55094c1.99129,0.82833 2.32887,1.23658 2.51953,3.83641c0.17537,2.39135 -0.73283,6.9403 -2.33813,12.71187c-0.1805,0.08775 -0.25662,0.13275 -0.48375,0.23515c-1.12427,0.50693 -2.72969,1.15504 -4.35375,1.82078c-1.62406,0.66575 -3.26288,1.3441 -4.63594,2.01563c-0.68653,0.33578 -1.29477,0.65529 -1.90813,1.075c-0.30668,0.20987 -0.62098,0.43907 -0.98765,0.8264c-0.36668,0.38734 -0.93094,0.96247 -1.08844,2.24406c-0.10392,0.82717 -0.056,1.04503 -0.04031,1.84094c0.01582,0.80462 0.05977,1.85689 0.16125,3.09735c0.20299,2.4809 0.62338,5.71201 1.48485,9.15765c1.51466,6.05827 4.58294,12.88866 10.58203,16.94469c-0.38486,0.87152 -0.86526,1.90478 -1.60578,3.29219c-1.77748,3.33023 -4.3614,7.76105 -6.98078,12.28859c-2.61938,4.52755 -5.27797,9.14997 -7.26297,13.03438c-0.99251,1.9422 -1.81595,3.69017 -2.40531,5.24062c-0.58937,1.55046 -1.25932,2.60775 -0.77938,4.87781c0,0.00224 0,0.00448 0,0.00672c0.62662,2.95228 2.31402,5.13132 3.62141,7.18235c0.35025,0.54947 0.53018,0.8689 0.79953,1.31015c-0.32604,0.30086 -0.50136,0.43793 -0.9339,0.82641c-1.33539,1.19931 -3.01603,2.67442 -4.75015,4.06484c-1.73412,1.39042 -3.54066,2.6946 -4.97188,3.50719c-1.05759,0.60045 -1.95101,0.72036 -2.03578,0.81297c0.07445,-0.00946 -0.55043,-0.21986 -1.55875,-0.71219c-1.16045,-0.56662 -2.70275,-1.36323 -4.47469,-2.29781c-3.54387,-1.86916 -8.01949,-4.29426 -12.51703,-6.64485c-4.49754,-2.35059 -9.00245,-4.62247 -12.71859,-6.24172c-1.85807,-0.80962 -3.50789,-1.45736 -4.98531,-1.88125c-0.73871,-0.21194 -1.42617,-0.37332 -2.19031,-0.44344c-0.76415,-0.07011 -1.65895,-0.16825 -2.91594,0.51062c-3.70217,1.99967 -6.11204,5.58802 -8.14985,8.89563c-1.59746,2.59287 -2.44994,4.38683 -3.11078,5.68406c-0.56765,-0.07227 -1.12237,-0.13296 -2.02906,-0.3225c-2.528,-0.52843 -6.01231,-1.44845 -9.57422,-2.37844c-3.56192,-0.92999 -7.20261,-1.87103 -10.28641,-2.45235c-1.5419,-0.29065 -2.93845,-0.50114 -4.23953,-0.55094c-0.62955,-0.02408 -1.43299,0.44438 -2.10969,0.53078c-0.11524,-0.05132 -0.60605,-0.32357 -1.20937,-0.75922c-1.23193,-0.88958 -2.94414,-2.37757 -4.59563,-3.92375c-2.7951,-2.61686 -4.68245,-4.64084 -5.43547,-5.43547c0.17379,-1.2842 0.54512,-3.35529 0.37625,-7.11515c-0.10698,-2.38232 -0.41693,-4.92886 -1.30344,-7.3436c-0.88651,-2.41474 -2.51424,-4.90191 -5.32125,-6.08719c-0.10761,-0.04588 -0.21749,-0.08625 -0.32922,-0.12094c-2.95133,-0.90758 -3.31952,-1.64729 -3.82297,-3.29219c-0.50345,-1.6449 -0.49069,-4.49319 -0.82641,-7.96844c-0.33571,-3.47525 -1.19965,-7.66102 -4.05141,-11.6436c-2.47062,-3.45031 -6.69198,-6.56315 -12.50359,-9.3525c0.25765,-0.56132 0.46889,-1.06938 0.95406,-1.88797c1.43208,-2.41624 3.6876,-5.59468 5.99312,-8.74781c2.30552,-3.15313 4.66107,-6.28453 6.41641,-8.84859c0.87767,-1.28203 1.60276,-2.40258 2.15,-3.46688c0.27362,-0.53215 0.51158,-1.03245 0.69203,-1.74015c0.02817,-0.11053 -0.13862,-0.41878 -0.1075,-0.55765c0.5647,-0.41537 1.71655,-1.05813 3.12422,-1.55203c2.90748,-1.02015 6.65171,-1.3289 9.17781,-0.07391c0.47628,0.23539 1.00061,0.35727 1.53188,0.3561c2.0868,0 4.08735,-1.29448 5.10625,-2.83531c1.0189,-1.54083 1.41335,-3.25092 1.53859,-5.06594c0.21834,-3.16391 -0.84485,-6.8575 -2.43219,-10.54172c0,-1.6431 0.19808,-2.66979 0.36281,-3.10406c0.16474,-0.43427 0.11485,-0.31734 0.29563,-0.41656c0.35124,-0.1928 2.59133,-0.4743 6.17453,-0.49047c1.32649,11.21689 8.67136,24.19273 15.78906,35.2936c7.85875,12.25659 15.70844,21.90984 15.70844,21.90984c0.65048,0.79718 1.62362,1.26138 2.6525,1.26528c1.02889,0.0039 2.00552,-0.4529 2.66203,-1.24512c0,0 7.85739,-9.48763 15.72188,-21.66797c7.13983,-11.05814 14.5082,-24.10948 15.80922,-35.56235zM40.78953,56.86078l0.63828,0.15453c-0.23624,-0.0234 -0.46998,-0.04297 -0.70547,-0.12766c0.02718,-0.00688 0.04558,-0.02687 0.06719,-0.02687zM26.9825,63.6736c0.01021,0.12864 0.05619,0.27758 0.04703,0.38969c-0.02312,0.28297 -0.095,0.3344 -0.15453,0.5039c0.04253,-0.28746 0.08954,-0.58561 0.1075,-0.89359zM60.2,92.88c-4.74965,0 -8.6,3.85035 -8.6,8.6c0,4.74965 3.85035,8.6 8.6,8.6c4.74965,0 8.6,-3.85035 8.6,-8.6c0,-4.74965 -3.85035,-8.6 -8.6,-8.6zM49.53735,153.24797c0.31466,0.02442 0.33939,0.06295 0.3225,0.06047c-0.45334,0.05995 -0.86141,-0.00041 -1.33031,0.11422c0.41689,-0.13218 0.79644,-0.19109 1.00781,-0.17469zM47.68969,153.8325c-0.02107,0.01583 -0.03904,0.0167 -0.06047,0.0336v-0.00672c0.01976,-0.01555 0.04057,-0.01206 0.06047,-0.02687z"></path></g></g></svg>
                热门国家快速浏览:</p>
            <button class="class-btn country-btn" onclick="search('ISO=DE')">德国</button>
            <button class="class-btn country-btn" onclick="search('ISO=US')">美国</button>
            <button class="class-btn country-btn" onclick="search('ISO=CA')">加拿大</button>
            <button class="class-btn country-btn" onclick="search('ISO=IT')">意大利</button>
            <button class="class-btn country-btn" onclick="search('ISO=GR')">希腊</button>
            <button class="class-btn country-btn" onclick="search('ISO=GB')">英国</button>
        </div>
        <div class="city">
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     width="50" height="50"
                     viewBox="0 0 172 172"
                     style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M51.6,17.2c-1.89978,0.00019 -3.43981,1.54022 -3.44,3.44v65.36h-24.08c-1.89978,0.00019 -3.43981,1.54022 -3.44,3.44v12.78578l-20.47203,47.77703c-0.45596,1.0624 -0.34782,2.28278 0.28784,3.24845c0.63567,0.96567 1.71386,1.5475 2.86997,1.54873h165.71797c1.17657,0.00041 2.27176,-0.60048 2.90353,-1.59305c0.63176,-0.99257 0.71247,-2.23917 0.21397,-3.30492l-20.80125,-44.56547v-29.65656c-0.00019,-1.89978 -1.54022,-3.43981 -3.44,-3.44h-20.64v-24.08c-0.00019,-1.89978 -1.54022,-3.43981 -3.44,-3.44h-24.08v-24.08c-0.00019,-1.89978 -1.54022,-3.43981 -3.44,-3.44zM55.04,24.08h37.84v20.64h-13.76c-1.89978,0.00019 -3.43981,1.54022 -3.44,3.44v37.84h-20.64zM61.92,30.96v6.88h6.88v-6.88zM79.12,30.96v6.88h6.88v-6.88zM61.92,44.72v6.88h6.88v-6.88zM82.56,51.6h37.84v20.64h-13.76c-1.89978,0.00019 -3.43981,1.54022 -3.44,3.44v58.48h-20.64v-44.72zM61.92,58.48v6.88h6.88v-6.88zM89.44,58.48v6.88h6.88v-6.88zM106.64,58.48v6.88h6.88v-6.88zM61.92,72.24v6.88h6.88v-6.88zM89.44,72.24v6.88h6.88v-6.88zM110.08,79.12h34.4v55.04h-27.52h-6.88zM89.44,86v6.88h6.88v-6.88zM116.96,86v6.88h6.88v-6.88zM130.72,86v6.88h6.88v-6.88zM27.52,92.88h48.16v41.28h-48.16zM34.4,99.76v6.88h6.88v-6.88zM48.16,99.76v6.88h6.88v-6.88zM61.92,99.76v6.88h6.88v-6.88zM89.44,99.76v6.88h6.88v-6.88zM116.96,99.76v6.88h6.88v-6.88zM130.72,99.76v6.88h6.88v-6.88zM34.4,113.52v6.88h6.88v-6.88zM48.16,113.52v6.88h6.88v-6.88zM61.92,113.52v6.88h6.88v-6.88zM89.44,113.52v6.88h6.88v-6.88zM116.96,113.52v6.88h6.88v-6.88zM130.72,113.52v6.88h6.88v-6.88zM20.64,119.70125v17.89875c0.00019,1.89978 1.54022,3.43981 3.44,3.44h55.04h37.84h30.96c1.89978,-0.00019 3.43981,-1.54022 3.44,-3.44v-15.99735l12.28187,26.31735h-155.09562z"></path></g></g></svg>
                热门城市快速浏览:</p>
            <button class="class-btn city-btn" onclick="search('CityCode=5913490')">卡尔加里</button>
            <button class="class-btn city-btn" onclick="search('CityCode=2643743')">伦敦</button>
            <button class="class-btn city-btn" onclick="search('CityCode=2950159')">柏林</button>
            <button class="class-btn city-btn" onclick="search('CityCode=3164603')">威尼斯</button>
            <button class="class-btn city-btn" onclick="search('CityCode=3169070')">罗马</button>
            <button class="class-btn city-btn" onclick="search('CityCode=3176959')">佛罗伦萨</button>
        </div>
        <div class="content">
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     width="50" height="50"
                     viewBox="0 0 172 172"
                     style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M86,6.88c-16.68937,0 -31.13469,9.9975 -37.625,24.295c-2.20375,-0.215 -4.42094,-0.28219 -6.665,-0.1075c-3.18469,0.25531 -6.30219,0.92719 -9.46,2.0425c-19.71281,6.94719 -30.16719,28.66219 -23.22,48.375c3.46688,9.84969 11.44875,20.27719 21.07,27.735c8.57313,6.65156 18.73188,11.12625 28.38,9.3525l0.5375,5.2675l4.6225,-2.15c0.43,0.76594 0.79281,1.35719 1.29,2.2575c2.09625,3.81625 4.75688,8.69406 7.4175,13.76c2.66063,5.06594 5.28094,10.30656 7.2025,14.7275c1.92156,4.42094 3.01,8.39844 3.01,9.245c-0.02687,1.06156 0.44344,2.06938 1.26313,2.74125c0.80625,0.67188 1.89469,0.92719 2.92937,0.69875c0.34938,-0.09406 0.67188,-0.24187 0.9675,-0.43c0.06719,-0.02687 0.14781,-0.06719 0.215,-0.1075c0.20156,-0.16125 0.37625,-0.33594 0.5375,-0.5375c0.25531,-0.215 0.47031,-0.47031 0.645,-0.7525c0.16125,-0.33594 0.26875,-0.69875 0.3225,-1.075c0.01344,-0.17469 0.01344,-0.36281 0,-0.5375v-1.29c0.01344,-0.17469 0.01344,-0.36281 0,-0.5375c0,-0.04031 0.26875,-1.47812 0.86,-3.3325c0.59125,-1.85437 1.41094,-4.21937 2.4725,-6.88c2.13656,-5.33469 5.03906,-11.87875 7.955,-18.275c2.91594,-6.39625 5.87219,-12.67156 8.17,-17.5225c0.69875,-1.47812 1.15563,-2.56656 1.72,-3.7625l4.4075,2.0425l0.645,-6.1275c9.20469,0.7525 18.69156,-3.73562 26.7675,-10.105c9.74219,-7.69969 17.72406,-18.30187 21.1775,-28.38c6.90688,-20.15625 -3.81625,-42.22062 -23.9725,-49.1275c-4.6225,-1.58562 -9.36594,-2.21719 -13.975,-2.0425c-3.84312,0.14781 -7.60562,0.91375 -11.18,2.15c-7.4175,-7.13531 -17.415,-11.61 -28.4875,-11.61zM86,13.76c9.95719,0 18.87969,4.23281 25.155,10.965c0.13438,0.16125 0.26875,0.29563 0.43,0.43c5.46906,6.08719 8.815,14.14969 8.815,23.005c0,9.51375 -4.04469,22.38688 -10.535,32.465c-2.84875,4.42094 -6.06031,8.2775 -9.5675,11.18c-0.02687,0.01344 -0.08062,-0.01344 -0.1075,0c-0.36281,0.18813 -0.69875,0.44344 -0.9675,0.7525c-0.12094,0.09406 -0.22844,0.20156 -0.3225,0.3225c-0.04031,0.02688 -0.06719,0.08063 -0.1075,0.1075c-4.07156,3.01 -8.45219,4.73 -12.7925,4.73c-2.99656,0 -6.02,-0.86 -8.9225,-2.365c-5.52281,-2.86219 -10.68281,-8.11625 -14.9425,-14.7275c-6.49031,-10.07812 -10.535,-22.95125 -10.535,-32.465c0,-3.88344 0.645,-7.59219 1.8275,-11.0725c0.04031,-0.1075 0.08063,-0.215 0.1075,-0.3225c0.34938,-0.47031 0.57781,-1.03469 0.645,-1.6125c0,-0.1075 0,-0.215 0,-0.3225c5.18688,-12.41625 17.49563,-21.07 31.82,-21.07zM125.8825,23.22c3.77594,-0.13437 7.69969,0.41656 11.5025,1.72c16.63563,5.6975 25.4775,23.67688 19.78,40.3125c-2.84875,8.31781 -10.30656,18.36906 -19.0275,25.2625c-8.72094,6.89344 -18.3825,10.4275 -25.9075,7.8475c-1.96187,-0.67187 -3.72219,-1.77375 -5.375,-3.225c3.27875,-3.1175 6.24844,-6.7725 8.815,-10.75c7.2025,-11.18 11.61,-24.84594 11.61,-36.2275c0,-8.97625 -2.95625,-17.29406 -7.8475,-24.08c2.12313,-0.52406 4.23281,-0.77937 6.45,-0.86zM46.1175,37.84c-0.86,3.31906 -1.3975,6.74563 -1.3975,10.32c0,11.38156 4.4075,25.0475 11.61,36.2275c4.01781,6.235 9.00313,11.77125 14.7275,15.48c-2.84875,5.59 -6.67844,9.62125 -11.395,11.2875c-7.32344,2.58 -16.78344,-0.7525 -25.37,-7.4175c-8.58656,-6.665 -15.96375,-16.40719 -18.8125,-24.51c-5.71094,-16.20562 2.82188,-33.95656 19.0275,-39.6675c3.88344,-1.37062 7.75344,-1.90812 11.61,-1.72zM101.3725,99.545c0.84656,0.79281 1.74688,1.47813 2.6875,2.15l-3.5475,3.7625l3.87,1.8275c-0.55094,1.14219 -1.04812,2.10969 -1.72,3.5475c-2.29781,4.85094 -5.22719,11.18 -8.17,17.63c-1.77375,3.88344 -3.45344,7.76688 -5.0525,11.5025v-29.885h5.16l-2.15,-6.3425c3.15781,-0.84656 6.11406,-2.31125 8.9225,-4.1925zM77.185,102.985c0.76594,0.28219 1.58563,0.5375 2.365,0.7525l-2.15,6.3425h5.16v32.465c-1.29,-2.66062 -2.70094,-5.41531 -4.085,-8.0625c-2.70094,-5.14656 -5.42875,-10.05125 -7.525,-13.8675c-0.40312,-0.72562 -0.61812,-1.1825 -0.9675,-1.8275l3.5475,-1.6125l-3.87,-4.1925c3.06375,-2.71437 5.56313,-6.11406 7.525,-9.9975z"></path></g></g></svg>
                热门内容快速浏览:</p>
            <button class="class-btn content-btn" onclick="search('Content=scenery')">多彩风景</button>
            <button class="class-btn content-btn" onclick="search('Content=building')">建筑</button>
            <button class="class-btn content-btn" onclick="search('Content=city')">城市风光</button>

        </div>
    </section>
    <section class="right">
        <div class="right-up">
            <div class='selector'>
                <form id="filter-form">
                    <label>
                        主题:
                        <input type="text" name="Content" id="select-content">
                    </label>
                    <label>国家:
                        <input type="text" name="Country" id="select-country" onchange="getcity()">
                    </label>
                    <label id="city-holder">城市:
                        <input type="text" name="CityCode" id="select-city">
                    </label>

                    <button type="button" onclick="search($('#filter-form').serialize()+'&geo=1')">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             width="50" height="50"
                             viewBox="0 0 172 172"
                             style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#001935"><path d="M72.24,13.76c-32.25687,0 -58.48,26.22313 -58.48,58.48c0,32.25687 26.22313,58.48 58.48,58.48c12.77059,0 24.55868,-4.15869 34.185,-11.12625l45.23063,45.23062l9.72875,-9.72875l-44.81406,-44.81406c8.79545,-10.23604 14.14969,-23.51227 14.14969,-38.04156c0,-32.25687 -26.22313,-58.48 -58.48,-58.48zM72.24,20.64c28.53864,0 51.6,23.06136 51.6,51.6c0,28.53864 -23.06136,51.6 -51.6,51.6c-28.53864,0 -51.6,-23.06136 -51.6,-51.6c0,-28.53864 23.06136,-51.6 51.6,-51.6zM44.72,65.36c-3.79972,0 -6.88,3.08028 -6.88,6.88c0,3.79972 3.08028,6.88 6.88,6.88c3.79972,0 6.88,-3.08028 6.88,-6.88c0,-3.79972 -3.08028,-6.88 -6.88,-6.88zM72.24,65.36c-3.79972,0 -6.88,3.08028 -6.88,6.88c0,3.79972 3.08028,6.88 6.88,6.88c3.79972,0 6.88,-3.08028 6.88,-6.88c0,-3.79972 -3.08028,-6.88 -6.88,-6.88zM99.76,65.36c-3.79972,0 -6.88,3.08028 -6.88,6.88c0,3.79972 3.08028,6.88 6.88,6.88c3.79972,0 6.88,-3.08028 6.88,-6.88c0,-3.79972 -3.08028,-6.88 -6.88,-6.88z"></path></g></g></svg>
                        搜索
                    </button>
                </form>
            </div>
        </div>
        <div class="right-down">
            <div class="picture-container">
            </div>
            <footer>
            </footer>
        </div>
    </section>
    <div class="clear"></div>
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
    search();
    function search(data,page=1){
        $.ajax({
            url: "filter.php",
            type: "POST",
            contentType: "application/x-www-form-urlencoded",
            data: data+"&page="+page,
            success: function (result) {
                if(data && data.indexOf('kword')===-1){
                    $('#kword').val("");
                }
                if(parseInt(jQuery.parseJSON(result)['pageSum'])===0){
                    $('.picture-container').html("暂时没有数据~先去看看别的吧: )");
                    $('.picture-container').css("display","block");
                    $('.right-down footer').html("");
                }
                else {
                    $('.picture-container').css("display","grid");
                    output(data , result);
                }
            },
        });
    }
    function output(data,result){
        let pageSum=jQuery.parseJSON(result)['pageSum'];
        let page=jQuery.parseJSON(result)['page'];
        result=jQuery.parseJSON(result)['result'];
        let num=result.length;
        let holder='';
        let btn='';
        for(let index=0;index<num;index++){
            holder=holder+'<article>\n' +
                '                <a href="detail.php?imageid='+result[index]['ImageID']+'">\n' +
                '                    <img class="hot-pic" src="img/travel-images/normal/medium/'+result[index]['PATH']+'" alt="img">\n' +
                '                    <div class="pic-intro">\n' +
                '                        <p>'+result[index]['Description']+'</p>\n' +
                '                    </div>\n' +
                '                </a>\n' +
                '            </article>';
        }
        $('.picture-container').html(holder);
        btn='<span>\n' +
            '                    <button class="page-btn" onclick="search(\''+data+'\','+(page-1)+')">\n' +
            '                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"\n' +
            '                         viewBox="0 0 172 172"\n' +
            '                         style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none"  font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#001935"><path d="M30.96,13.76c-9.45834,0 -17.2,7.74166 -17.2,17.2v110.08c0,9.45834 7.74166,17.2 17.2,17.2h110.08c9.45834,0 17.2,-7.74166 17.2,-17.2v-110.08c0,-9.45834 -7.74166,-17.2 -17.2,-17.2zM30.96,20.64h110.08c5.73958,0 10.32,4.58042 10.32,10.32v110.08c0,5.73958 -4.58042,10.32 -10.32,10.32h-110.08c-5.73958,0 -10.32,-4.58042 -10.32,-10.32v-110.08c0,-5.73958 4.58042,-10.32 10.32,-10.32zM120.4,48.73781l-48.16,30.96v-28.09781h-20.64v68.8h20.64v-3.44v-24.65781l48.16,30.96zM58.48,58.48h6.88v21.21781v12.60437v21.21781h-6.88zM113.52,61.34219v49.31563l-38.35735,-24.65781z"></path></g></g></svg>\n' +
            '                    </button>\n' +
            '                </span>';
        for(let index=0;index<pageSum;index++){
            if(index+1!=page)
            btn=btn+'<span>\n' +
                '                    <button class="page-btn" onclick="search(\''+data+'\','+(index+1)+')">\n' +
                '                    <img src="https://img.icons8.com/color/48/000000/'+(index+1)+'.png"/>' +
                '                    </button>\n' +
                '                </span>';
            else
                btn=btn+'<span>\n' +
                    '                    <button class="page-btn" onclick="search(\''+data+'\','+(index+1)+')">\n' +
                    '                    <img class="active" src="https://img.icons8.com/color/48/000000/'+(index+1)+'.png"/>' +
                    '                    </button>\n' +
                    '                </span>';
        }
        btn=btn+'<span>\n' +
            '                    <button class="page-btn" onclick="search(\''+data+'\','+(parseInt(page)+1)+')">\n' +
            '                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"\n' +
            '                         viewBox="0 0 172 172"\n' +
            '                         style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#001935"><path d="M30.96,13.76c-9.45834,0 -17.2,7.74166 -17.2,17.2v110.08c0,9.45834 7.74166,17.2 17.2,17.2h110.08c9.45834,0 17.2,-7.74166 17.2,-17.2v-110.08c0,-9.45834 -7.74166,-17.2 -17.2,-17.2zM30.96,20.64h110.08c5.73958,0 10.32,4.58042 10.32,10.32v110.08c0,5.73958 -4.58042,10.32 -10.32,10.32h-110.08c-5.73958,0 -10.32,-4.58042 -10.32,-10.32v-110.08c0,-5.73958 4.58042,-10.32 10.32,-10.32zM51.6,48.73781v74.52437l48.16,-30.96v28.09781h20.64v-68.8h-20.64v3.44v24.65781zM106.64,58.48h6.88v55.04h-6.88v-21.21781v-12.60437zM58.48,61.34219l38.35735,24.65781l-38.35735,24.65781z"></path></g></g></svg>\n' +
            '                    </button>\n' +
            '                </span>';
        $('.right-down footer').html(btn);
    }

    $('#select-country').selectPage({
        showField : 'CountryName',
        keyField : 'ISO',
        orderBy : ['ISO'],
    });
    $('#select-city').selectPage({
        showField : 'AsciiName',
        keyField : 'GeoNameID',
        orderBy : ['GeoNameID desc']
    });
    $('#select-content').selectPage({
        showField : 'Content',
        keyField : 'Content'
    });
    $.ajax({
        url: "query.php?query=country",
        type: "GET",
        dataType: "text",
        success:function (data) {
            let init=[{}];
            init[0]["CountryName"]="all";
            init[0]["ISO"]="all";
            data=init.concat(jQuery.parseJSON(data));
            $('#select-country').selectPageData(data);
            $('#select-country').val('all');
            $('#select-country').selectPageRefresh();
            getcity();
        }
    });
    $.ajax({
        url: "query.php?query=content",
        type: "GET",
        dataType: "text",
        success:function (data) {
            console.log(data);
            let init=[{}];
            init[0]["Content"]="all";
            data=init.concat(jQuery.parseJSON(data));
            $('#select-content').selectPageData(data);
            $('#select-content').val('all');
            $("#select-content").selectPageRefresh();
            getcity();
        }
    });
    function getcity(){
        $('#select-city').selectPageClear();
        $.ajax({
            url: "query.php?query=city&ISO="+$('#select-country').val(),
            type: "GET",
            dataType: "text",
            success:function (data) {
                let init=[{}];
                init[0]["AsciiName"]="all";
                init[0]["GeoNameID"]="all";
                data=init.concat(jQuery.parseJSON(data));
                $('#select-city').selectPageData(data);
                $('#select-city').val('all');
                $('#select-city').selectPageRefresh();
            }
        });
    }
</script>
</body>
</html>