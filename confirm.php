<?php
    $email = $_GET['email'];
    $token = $_GET['token'];
    $username = $_GET['username'];
    require_once ("config/setup.php");
    require_once("config/database.php");
    $sql = $conn->prepare("SELECT * FROM `users` WHERE `email` = '$email' AND `token` = '$token' limit 1");
    $sql->execute();
    $row = $sql->fetch();
    $sql = $conn->prepare("UPDATE users SET account = ?  WHERE `email` = '$email' AND token = '$token'");
    $sql->execute([1]); 
    $sql = $conn->prepare("UPDATE users SET token = ?  WHERE `email` = '$email' AND  token = '$token'");
    $sql->execute([""]);
    $conn = NULL;
    header('Location: login.php');
    exit();     
?>
