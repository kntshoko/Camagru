<?php

    session_start();
    require_once ("setup.php");
require_once("config.php"); 


    $img = $_POST['image'];
     $name = $_SESSION['login'];


    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $upload = imagecreatefromstring($data);
    $file = "camagru".uniqid().".png";
    $filedest = "uploads/".$file;
    $success = imagepng($upload, $filedest);

    try
    {
        $sql = $conn->prepare("INSERT INTO `gallery`( `user_name`,`imagename`) VALUES(?,?)"); 
        $sql->execute([$name,$file]);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }
    $conn = NULL;
?>