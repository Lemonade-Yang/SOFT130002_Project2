<?php
session_start();
require_once "config.php";
if(!isset($_SESSION['UID'])) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/login.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="front-src/css/reset.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/theme.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/nav.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/footer.css" type="text/css" rel="stylesheet">
    <link href="front-src/css/myphoto.css" type="text/css" rel="stylesheet">
    <script src="front-src/js/jquery-3.5.1.min.js"></script>
    <title>花咲く旅路-我的收藏</title>
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
<div class="container">
    <section class="pics">
        <div id="picture-container">
        </div>
        <footer>
    </footer>
    </section>
</div>
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
    function search(data,page=1) {
        $.ajax({
            url: "fav.php",
            type: "GET",
            contentType: "application/x-www-form-urlencoded",
            data: "page=" + page,
            success: function (result) {
                console.log(result);
                if (parseInt(jQuery.parseJSON(result)['pageSum']) === 0) {
                    $('#picture-container').html("还没有收藏，快去看看吧: )");
                    $('#picture-container').css("color", "white");
                    $('.pics footer').html("");
                } else {
                    output('search(\'' + data + '\'', result);
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
                '                    <div class="pic-img">\n' +
                '                        <img class="hot-pic" src="img/travel-images/normal/medium/'+result[index]['PATH']+'" alt="img1">\n' +
                '                    </div>\n' +
                '                    <div class="pic-text">\n' +
                '                        <div class="pic-title">'+result[index]['Title']+'</div>\n' +
                '                        <div class="pic-intro">'+result[index]['Description']+'</div>\n' +
                '                    </div>\n' +
                '                </a>\n' +
                '                <div class="action">\n' +
                '                    <button class="unlike" value="unlike" onclick="unfav('+result[index]['ImageID']+')">取消收藏</button>\n' +
                '                </div>\n' +
                '            </article>';
        }
        $('#picture-container').html(holder);
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
        $('.pics footer').html(btn);
    }
    function unfav(id) {
        $.ajax({
            url:"fav.php",
            type:"POST",
            contentType:"application/x-www-form-urlencoded",
            data:"code=2&ImageID="+id,
            success:function (result) {
                search();
            }
        });
    }
</script>
</body>
</html>
