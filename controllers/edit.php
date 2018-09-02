<?php
require_once '../admin.published.php';
require_once 'db_connector.php';
if(isset($_POST['edit'])){
    try{
    $update = $pdo->prepare("UPDATE `post` SET `published` = (:published) WHERE `id` = (:id)");
    $update->execute(['published'=>$_POST['published_select'], 'id'=>$_POST['id']]);

    }catch (PDOException $e){
        echo "Error".$e;
    }
    header("Location: ../admin.php");
}
if(isset($_POST['delete'])){
    try{
        $destroy = $pdo->prepare("DELETE FROM `post` WHERE `id` = (:id)");
        $destroy->execute(['id'=>$_POST['id']]);
    }catch(PDOException $e){
        echo "Error".$e;
    }
    header("Location: index.php");
}