<?php
session_start();
require_once "config.php";
$pdo=new PDO(DBCONNSTRING,DBUSER,DBPASS);
if(isset($_POST['geo'])) {
    $content=$_POST["Content"]==""?"all":$_POST["Content"];
    $cityCode=$_POST["CityCode"]==""?"all":$_POST["CityCode"];
    $country=$_POST["Country"]==""?"all":$_POST["Country"];
    if($content!="all" && $cityCode!="all") {
        $sql = "SELECT * FROM travelimage WHERE Content=? AND CityCode=?";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(1,$content);
        $stm->bindParam(2,$cityCode,PDO::PARAM_INT);
    }
    else if($content!="all" && $country!="all") {
        $sql = "SELECT * FROM travelimage WHERE Content=? AND CountryCodeISO=?";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(1,$content);
        $stm->bindParam(2,$country);
    }
    else if($cityCode!="all") {
        $sql = "SELECT * FROM travelimage WHERE CityCode=?";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(1,$cityCode,PDO::PARAM_INT);
    }
    else if($country!="all") {
        $sql = "SELECT * FROM travelimage WHERE CountryCodeISO=?";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(1,$country);
    }
    else if($content!="all") {
        $sql = "SELECT * FROM travelimage WHERE Content=?";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(1,$content);
    }
    else{
        $sql = "SELECT * FROM travelimage";
        $stm = $pdo->prepare($sql);
    }
    $stm->execute();
}
else if(isset($_POST['kword'])&&isset($_POST['type'])){
    if($_POST['type']=='1') {
        $sql = "SELECT * FROM travelimage WHERE Title LIKE ? ORDER BY ImageID";
        $stm = $pdo->prepare($sql);
        $like = "%" . $_POST['kword'] . "%";
        $stm->execute(array("%$_POST[kword]%"));
    }
    elseif ($_POST['type']=='2'){
        $sql = "SELECT * FROM travelimage WHERE Description LIKE ? ORDER BY ImageID";
        $stm = $pdo->prepare($sql);
        $like = "%" . $_POST['kword'] . "%";
        $stm->execute(array("%$_POST[kword]%"));
    }
    else die();
}
else if(isset($_POST['ISO'])){
    $sql="SELECT * FROM travelimage WHERE CountryCodeISO=?";
    $stm=$pdo->prepare($sql);
    $stm->execute(array($_POST['ISO']));
}
else if(isset($_POST["CityCode"])){
    $sql="SELECT * FROM travelimage WHERE CityCode=?";
    $stm=$pdo->prepare($sql);
    $stm->execute(array($_POST["CityCode"]));
}
else if(isset($_POST["Content"])){
    $sql="SELECT * FROM travelimage WHERE Content=?";
    $stm=$pdo->prepare($sql);
    $stm->execute(array($_POST["Content"]));
}
else if(isset($_POST['UID'])){
    $sql="SELECT * FROM travelimage WHERE UID=?";
    $stm=$pdo->prepare($sql);
    $stm->execute(array($_SESSION["UID"]));
}
else {
    $sql="SELECT * FROM travelimage";
    $stm=$pdo->prepare($sql);
    $stm->execute();
}
$result=$stm->fetchAll(PDO::FETCH_ASSOC);
$num=count($result);
$page=isset($_POST['page'])?(int)$_POST['page']:1;
$pageSum=$num%12===0?(intdiv($num,12)):(intdiv($num,12)+1);
if($page<1)$page=1;
if($page>$pageSum)$page=$pageSum;
$result=array_slice($result,($page-1)*12,12);
$resp['page']=$page;
$resp['pageSum']=$pageSum;
$resp['result']=$result;
echo json_encode($resp);
