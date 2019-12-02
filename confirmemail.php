<?php
    $email = $_GET['email'];
    $token = $_GET['token'];
    $id = $_GET['id'];

    require_once("config.php");
    $sql = $conn->prepare("SELECT * FROM `users` WHERE `id` = '$id' AND `token` = '$token' limit 1");
    $sql->execute();
    $row = $sql->fetch();
    if (empty($row))
    {
        //
    }
    else
    {
        $sql = $conn->prepare("UPDATE users SET `token` = ? WHERE `id` = ?");
            $sql->execute(["",$id]);
        $sql = $conn->prepare("UPDATE users SET `email` = ? WHERE `id` = ?");
            $sql->execute([$email,$id]);
    }
    header('Location: logout.php');
    exit();     
?>
