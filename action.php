<?php
session_start();
require_once "config.php";
$pdo=new PDO(DBCONNSTRING,DBUSER,DBPASS);
if(isset($_POST['delete'])){
    //检查用户权限
    $stm = $pdo->prepare('SELECT UID,PATH FROM travelimage WHERE ImageID=?');
    $stm->execute(array($_POST['delete']));
    $origin = $stm->fetch();
    if ((int)$_SESSION['UID'] != $origin['UID']) {
        http_response_code(403);
        die();
    }
    //删除原文件
    $filname = $origin['PATH'];
    $status = unlink('img/travel-images/normal/medium/' . $filname);
    $sql = "DELETE FROM travelimage WHERE ImageID=?";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(1,$_POST['delete']);
    if(!$stm->execute()){
        http_response_code(500);
        die();
    }

}
http_response_code(200);
