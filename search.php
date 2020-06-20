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
    <link href="front-src/css/search.css" type="text/css" rel="stylesheet">
    <script src="front-src/js/jquery-3.5.1.min.js"></script>
    <script src="front-src/js/jquery.cookie.js"></script>
    <title>花咲く旅路-搜索页</title>
</head>
<body>

<nav id="nav-box">
    <ul>
        <li><a href="index.php"><img src="img/home.png" alt="home">首页</a></li>
        <li><a href="browse.php"><img src="img/browse.png" alt="browse">浏览页</a></li>
        <li><a href="search.php" style="color: #f35200"><img src="img/search.png" alt="search">搜索页</a></li>
        <?php
            require_once "nav.php";
            if(isset($_SESSION['UID']))
                echo echo_already_login();
            else
                echo echo_not_login();
        ?>
    </ul>
</nav>
<section class="up">
    <form class="search" action="#" name="search" id="kword-form" onsubmit="return false;">
        <div id="line1">
            <label>
                <input type="text" onfocus="placeholder=''" name="kword" placeholder="输入关键词">
            </label>
            <label>
                <button onclick="search_kword($('#kword-form').serialize(),1)" >
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         width="24" height="24"
                         viewBox="0 0 172 172"
                         style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M35.83333,21.5c-7.91917,0 -14.33333,6.41417 -14.33333,14.33333v100.33333c0,7.91917 6.41417,14.33333 14.33333,14.33333h100.33333c7.91917,0 14.33333,-6.41417 14.33333,-14.33333v-100.33333c0,-7.91917 -6.41417,-14.33333 -14.33333,-14.33333zM35.83333,35.83333h100.33333v100.33333h-100.33333zM82.41667,50.16667c-17.80917,0 -32.25,14.44083 -32.25,32.25c0,17.80917 14.44083,32.25 32.25,32.25c6.30667,0 12.13832,-1.87924 17.10482,-5.01107l17.24479,17.24479l10.13411,-10.13411l-17.24479,-17.24479c3.13183,-4.9665 5.01107,-10.79815 5.01107,-17.10482c0,-17.80917 -14.44083,-32.25 -32.25,-32.25zM82.41667,64.5c9.89717,0 17.91667,8.0195 17.91667,17.91667c0,9.89717 -8.0195,17.91667 -17.91667,17.91667c-9.89717,0 -17.91667,-8.0195 -17.91667,-17.91667c0,-9.89717 8.0195,-17.91667 17.91667,-17.91667z"></path></g></g></svg>
                </button>
            </label>
        </div>
        <div id="line2">
            <label>
                <input type="radio" name="type" value="1" checked >
                按标题搜索
            </label>
            <label>
                <input type="radio" name="type" value="2">
                按简介搜索
            </label>
        </div>
    </form>
</section>
<section class="down">
    <div id="picture-container">
        <div id="holder">
        </div>
        <footer>
        </footer>
    </div>
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
    search_kword();
    function search_kword(data,page=1){
        $.ajax({
            url: "filter.php",
            type: "POST",
            contentType: "application/x-www-form-urlencoded",
            data: data+"&page="+page,
            success: function (result) {
                console.log(result);
                if(parseInt(jQuery.parseJSON(result)['pageSum'])===0){
                    $('#holder').html("暂时没有数据~先去看看别的吧: )");
                }
                else output(data , result);

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
                '            <a href="detail.php?imageid='+result[index]['ImageID']+'">\n' +
                '                <div class="pic-img">\n' +
                '                    <img class="hot-pic" src="img/travel-images/normal/medium/'+result[index]['PATH']+'" alt="img1">\n' +
                '                </div>\n' +
                '                <div class="pic-text">\n' +
                '                    <div class="pic-title">'+result[index]['Title']+'</div>\n' +
                '                    <div class="pic-intro">'+result[index]['Description']+'</div>\n' +
                '                </div>\n' +
                '            </a>\n' +
                '        </article>';
        }
        $('#holder').html(holder);
        btn='<span>\n' +
            '                    <button class="page-btn" onclick="search_kword(\''+data+'\','+(page-1)+')">\n' +
            '                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"\n' +
            '                         viewBox="0 0 172 172"\n' +
            '                         style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none"  font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#001935"><path d="M30.96,13.76c-9.45834,0 -17.2,7.74166 -17.2,17.2v110.08c0,9.45834 7.74166,17.2 17.2,17.2h110.08c9.45834,0 17.2,-7.74166 17.2,-17.2v-110.08c0,-9.45834 -7.74166,-17.2 -17.2,-17.2zM30.96,20.64h110.08c5.73958,0 10.32,4.58042 10.32,10.32v110.08c0,5.73958 -4.58042,10.32 -10.32,10.32h-110.08c-5.73958,0 -10.32,-4.58042 -10.32,-10.32v-110.08c0,-5.73958 4.58042,-10.32 10.32,-10.32zM120.4,48.73781l-48.16,30.96v-28.09781h-20.64v68.8h20.64v-3.44v-24.65781l48.16,30.96zM58.48,58.48h6.88v21.21781v12.60437v21.21781h-6.88zM113.52,61.34219v49.31563l-38.35735,-24.65781z"></path></g></g></svg>\n' +
            '                    </button>\n' +
            '                </span>';
        for(let index=0;index<pageSum;index++){
            if(index+1!=page)
                btn=btn+'<span>\n' +
                    '                    <button class="page-btn" onclick="search_kword(\''+data+'\','+(index+1)+')">\n' +
                    '                    <img src="https://img.icons8.com/color/48/000000/'+(index+1)+'.png"/>' +
                    '                    </button>\n' +
                    '                </span>';
            else
                btn=btn+'<span>\n' +
                    '                    <button class="page-btn" onclick="search_kword(\''+data+'\''+(index+1)+')">\n' +
                    '                    <img class="active" src="https://img.icons8.com/color/48/000000/'+(index+1)+'.png"/>' +
                    '                    </button>\n' +
                    '                </span>';
        }
        btn=btn+'<span>\n' +
            '                    <button class="page-btn" onclick="search_kword(\''+data+'\','+(parseInt(page)+1)+')">\n' +
            '                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"\n' +
            '                         viewBox="0 0 172 172"\n' +
            '                         style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#001935"><path d="M30.96,13.76c-9.45834,0 -17.2,7.74166 -17.2,17.2v110.08c0,9.45834 7.74166,17.2 17.2,17.2h110.08c9.45834,0 17.2,-7.74166 17.2,-17.2v-110.08c0,-9.45834 -7.74166,-17.2 -17.2,-17.2zM30.96,20.64h110.08c5.73958,0 10.32,4.58042 10.32,10.32v110.08c0,5.73958 -4.58042,10.32 -10.32,10.32h-110.08c-5.73958,0 -10.32,-4.58042 -10.32,-10.32v-110.08c0,-5.73958 4.58042,-10.32 10.32,-10.32zM51.6,48.73781v74.52437l48.16,-30.96v28.09781h20.64v-68.8h-20.64v3.44v24.65781zM106.64,58.48h6.88v55.04h-6.88v-21.21781v-12.60437zM58.48,61.34219l38.35735,24.65781l-38.35735,24.65781z"></path></g></g></svg>\n' +
            '                    </button>\n' +
            '                </span>';
        $('#picture-container footer').html(btn);
    }
</script>
</body>
</html>
