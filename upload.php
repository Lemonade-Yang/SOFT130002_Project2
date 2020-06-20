<?php
session_start();
require_once "config.php";
if(!isset($_SESSION['UID'])) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/login.php");
    die();
}
if(isset($_GET['imageid'])){
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $stm=$pdo->prepare("SELECT * FROM travelimage WHERE ImageID=?");
    $stm->execute(array($_GET['imageid']));
    $result=$stm->fetch();
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
    <link href="front-src/css/upload.css" type="text/css" rel="stylesheet">
    <script src="front-src/js/jquery-3.5.1.min.js"></script>
    <script src="front-src/js/jquery.cookie.js"></script>
    <link rel="stylesheet" href="front-src/css/selectpage.css" type="text/css">
    <script type="text/javascript" src="front-src/js/selectpage.js"></script>
    <title>花咲く旅路-图片上传</title>
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
<section>
    <div id="upload">
        <form name="form" id="form" method="post" action="upload.php" enctype="multipart/form-data">
            <label id="line1">
                <input id="title" type="text" name="title" placeholder="Title">
                <input type="file" name="file" id="file"/>
                <?php if(isset($_GET['imageid']))
                    echo '<input type="text" name="ImageID" class="hide" value="'.(int)$_GET['imageid'].'"/>'
                ?>
                <label for="file" id="select-button">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         width="50" height="50"
                         viewBox="0 0 172 172"
                         style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none"style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#f35200"><path d="M30.96,13.76c-9.44436,0 -17.2,7.75564 -17.2,17.2v110.08c0,9.44437 7.75564,17.2 17.2,17.2h110.08c9.44437,0 17.2,-7.75563 17.2,-17.2v-110.08c0,-9.44436 -7.75563,-17.2 -17.2,-17.2zM30.96,20.64h110.08c5.69163,0 10.32,4.62836 10.32,10.32v110.08c0,5.69163 -4.62837,10.32 -10.32,10.32h-110.08c-5.69164,0 -10.32,-4.62837 -10.32,-10.32v-110.08c0,-5.69164 4.62836,-10.32 10.32,-10.32zM82.56,44.72v37.84h-37.84v6.88h37.84v37.84h6.88v-37.84h37.84v-6.88h-37.84v-37.84z"></path></g></g></svg>
                </label>
            </label>
            <br>
            <div id="line2">

                <img src="" class="hide" id="hide" width="120" alt="show">
                <div id="info"><p>[ 暂无图片 ]</p></div>
                <br>
                <label>
                    <textarea id="description" name="description" placeholder="Your text here" wrap="soft" rows="4"></textarea>
                </label>
            </div>
            <br>

            <div id="line3">
                <label class="tag">
                    #主题：
                    <input id="select-content" type="text" name="content">
                </label>
                <br>
                <label class="tag">
                    #拍摄国家：
                    <input id="select-country" type="text" name="country" onchange="getcity()">
                </label>
                <br>
                <label class="tag">
                    #拍摄城市：
                    <input id="select-city" type="text" name="city">
                </label>
            </div>
            <div id="line4">
                <?php
                if(isset($_GET['imageid']))
                    echo '<button id="submit" name="submit" value="1">保存</button>';
                else echo
                    '<button id="submit" name="submit" value="2">发布</button>';
                ?>
            </div>
        </form>
        <script>
            <?php
                if(isset($result)){
                    echo '$("#description").val("'.$result['Description'].'");       
                            $("#hide").attr("src", "'."http://".$_SERVER['HTTP_HOST'].'/img/travel-images/normal/medium/'.$result['PATH'].'");
                            $("#hide").removeClass("hide");
                            $("#info").addClass("hide");';
                }
            ?>
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
                url: "query.php?query=content",
                type: "GET",
                dataType: "text",
                success:function (data) {
                    data=jQuery.parseJSON(data);
                    $('#select-content').selectPageData(data);
                    <?php if(isset($result)) {
                    echo '$("#select-content").val("' . $result['Content'] . '");
                                $("#select-content").selectPageRefresh();';
                    }
                    ?>
                }
            });
            function getcity(){
                $('#select-city').selectPageClear();
                $.ajax({
                    url: "query.php?all=true&&query=city&ISO="+$('#select-country').val(),
                    type: "GET",
                    dataType: "text",
                    success:function (data) {
                        data=jQuery.parseJSON(data);
                        $('#select-city').selectPageData(data);
                        <?php if(isset($result)){
                        echo '  $("#title").val("'.$result['Title'].'");
                                $("#select-city").val("'.$result['CityCode'].'");
                                $("#select-city").selectPageRefresh();
                                ';
                    }?>
                    }
                });
            }
            $.ajax({
                url: "query.php?all=true&query=country",
                type: "GET",
                dataType: "text",
                success:function (data) {
                    data=jQuery.parseJSON(data);
                    $('#select-country').selectPageData(data);
                    <?php
                    if(isset($result)){
                        echo '$("#select-country").val("'.$result['CountryCodeISO'].'");
                            $("#select-country").selectPageRefresh();';
                    }
                    ?>
                    getcity();
                }
            });
        </script>
        <div id="alert">
            <?php
            if($_SERVER['REQUEST_METHOD']=='POST') {
                $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
                $allowedExts = array("gif", "jpeg", "jpg", "png");
                $temp = explode(".", $_FILES["file"]["name"]);
                $extension = end($temp);
                //检查信息是否完整
                if ($_POST['title'] == '' || $_POST['description'] == '' || $_POST['country'] == '' || $_POST['city'] == '' || $_POST['content'] == '') {
                    echo "标题、描述、图片、主题、国家、城市必须完整";
                    die();
                }
                //上传操作，必须有图片文件存在
                if ($_POST['submit'] === '2') {
                    //检查图片是否存在
                    if (!isset($_FILES['file']) || $_FILES['file']['name'] === '') {
                        echo "请上传图片。";
                        die();
                    }
                    //检查后缀名是否合法
                    if (!in_array($extension, $allowedExts)) {
                        echo "仅支持jpg,jpeg,gif,png格式。";
                        die();
                    }
                    //上传图片
                    $name = md5(uniqid(microtime(true))) . '.' . $extension;
                    if (!move_uploaded_file($_FILES["file"]["tmp_name"], "img/travel-images/normal/medium/" . $name)) {
                        echo "服务器错误。";
                        die();
                    }
                    //向数据库添加记录
                    $stm = $pdo->prepare('INSERT INTO travelimage(Title,Description,CityCode,CountryCodeISO,Content,UID,PATH) VALUES(?,?,?,?,?,?,?)');
                    if (!$stm->execute(array($_POST['title'], $_POST['description'], (int)$_POST['city'], $_POST['country'], $_POST['content'], (int)$_SESSION['UID'], $name))) {
                        echo "服务器错误。";
                        die();
                    }
                    echo "上传成功！";
                    echo '<script>window.location.href="myphoto.php"</script>';
                } //修改操作，可以不修改文件
                else if ($_POST['submit'] === '1') {

                    //检查用户权限
                    $stm = $pdo->prepare('SELECT UID,PATH FROM travelimage WHERE ImageID=?');
                    $stm->execute(array($_POST['ImageID']));
                    $origin = $stm->fetch();
                    if ((int)$_SESSION['UID'] != $origin['UID']) {
                        echo "您没有权限。";
                        die();
                    }

                    //有修改文件
                    if ($_FILES["file"]["name"] !== "") {
                        //检查后缀名是否合法
                        if (!in_array($extension, $allowedExts)) {
                            echo "仅支持jpg,jpeg,gif,png格式。";
                            die();
                        }
                        //上传图片
                        $name = md5(uniqid(microtime(true))) . '.' . $extension;
                        if (!move_uploaded_file($_FILES["file"]["tmp_name"], "img/travel-images/normal/medium/" . $name)) {
                            echo "服务器错误。";
                            die();
                        }
                        //删除原文件
                        $filname = $origin['PATH'];
                        $status = unlink('img/travel-images/normal/medium/' . $filname);
                        //更新图片文件
                        $stm = $pdo->prepare('UPDATE travelimage
                        SET PATH=?
                        WHERE ImageID=?');
                        if (!$stm->execute(array($name, $_POST['ImageID']))) {
                            echo "服务器错误。";
                            die();
                        }
                    }

                    //更新数据库信息
                    $stm = $pdo->prepare('UPDATE travelimage
                SET Title=?,Description=?,CityCode=?,CountryCodeISO=?,Content=?
                WHERE ImageID=?');
                    if (!$stm->execute(array($_POST['title'], $_POST['description'], (int)$_POST['city'], $_POST['country'], $_POST['content'], (int)$_POST['ImageID']))) {
                        echo "服务器错误。";
                        die();
                    }
                    echo "保存成功！";
                    echo '<script>window.location.href="myphoto.php"</script>';
                }
            }
            ?>
        </div>
    </div>
</section>
<footer class="footer">
    <pre>
        Copyright © 2020 -- Charon
        Tel/Wechat:18717918671
        QQ:838800433
        Email:lemon.yang.y@gmail.com
    </pre>
</footer>
<script>
    $("#file").change(function(){
        var objUrl = getObjectURL(this.files[0]) ;
        console.log("objUrl = "+objUrl) ;
        if (objUrl)
        {
            $("#hide").attr("src", objUrl);
            $("#hide").removeClass("hide");
            $("#info").addClass("hide");
        }
    }) ;
    function getObjectURL(file)
    {
        var url = null ;
        if (window.createObjectURL!=undefined)
        { // basic
            url = window.createObjectURL(file) ;
        }
        else if (window.URL!=undefined)
        {
            // mozilla(firefox)
            url = window.URL.createObjectURL(file) ;
        }
        else if (window.webkitURL!=undefined) {
            // webkit or chrome
            url = window.webkitURL.createObjectURL(file) ;
        }
        return url ;
    }
</script>
</body>
</html>
