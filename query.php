<?php
session_start();
require_once "config.php";
$pdo=new PDO(DBCONNSTRING,DBUSER,DBPASS);
if(isset($_GET['query'])){
    if($_GET['query']==="country") {
        if(isset($_GET['all'])&&$_GET['all']==='true'){
            $sql = "SELECT ISO,CountryName FROM geocountries";
            $stm = $pdo->prepare($sql);
            $stm->execute();
        }
        else {
            $sql = "SELECT ISO,CountryName FROM geocountries WHERE ISO IN(SELECT CountryCodeISO FROM travelimage)";
            $stm = $pdo->prepare($sql);
            $stm->execute();
        }
    }
    else if($_GET['query']==="city"){
        $ISO=$_GET["ISO"]==""?"all":$_GET["ISO"];
        if(isset($_GET['all'])&&$_GET['all']==='true'&&$ISO=="all"){
            echo "[]";
            die();
        }
        else if(isset($_GET['all'])&&$_GET['all']==='true'&&$ISO!="all"){
            $sql="SELECT GeoNameID,AsciiName FROM geocities where CountryCodeISO=?";
            $stm=$pdo->prepare($sql);
            $stm->execute(array($_GET['ISO']));
        }
        else if($ISO=="all"){
            $sql="SELECT GeoNameID,AsciiName FROM geocities where GeoNameID IN(SELECT CityCode FROM travelimage)";
            $stm=$pdo->prepare($sql);
            $stm->execute();
        }else {
            $sql = "SELECT GeoNameID,AsciiName FROM geocities where CountryCodeISO=? AND GeoNameID IN(SELECT CityCode FROM travelimage)";
            $stm = $pdo->prepare($sql);
            $stm->execute(array($_GET['ISO']));
        }
    }
    else if($_GET['query']==="content"){
        $sql = "SELECT DISTINCT Content FROM travelimage";
        $stm = $pdo->prepare($sql);
        $stm->execute();
    }
    else die();
}
$result=$stm->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);