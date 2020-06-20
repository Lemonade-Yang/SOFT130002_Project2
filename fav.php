<?php
session_start();
require_once "config.php";
if(isset($_SESSION['UID'])){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $sql="SELECT * FROM travelimage WHERE ImageID IN (SELECT ImageID FROM travelimagefavor WHERE UID=?)";
        $stm=$pdo->prepare($sql);
        if(!$stm->execute(array((int)$_SESSION['UID']))){
            http_response_code(500);
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

    }
    elseif($_POST['code'] == '2'){
        $sql = "DELETE FROM travelimagefavor WHERE UID=? AND ImageID=?";
        $stm=$pdo->prepare($sql);
        if(!$stm->execute(array((int)$_SESSION['UID'],(int)$_POST['ImageID']))){
            http_response_code(500);
        }
    }
    elseif($_POST['code'] == '1'){
        $sql = "INSERT INTO travelimagefavor(UID,ImageID) VALUES(?,?)";
        $stm=$pdo->prepare($sql);
        if(!$stm->execute(array((int)$_SESSION['UID'],(int)$_POST['ImageID']))){
            http_response_code(500);
        }
    }
    exit();
}