<?php
        $email = $_GET['email'];
        $token = $_GET['token'];
        $username = $_GET['username'];
        require_once("config.php");
        $sql = $conn->prepare("UPDATE users SET account = ?  WHERE `email` = '$email' AND `user_name` = '$username' AND token = '$token'");
        $sql->execute([1]); 
        $sql = $conn->prepare("UPDATE users SET token = ?  WHERE `email` = '$email' AND `user_name` = '$username' AND token = '$token'");
        $sql->execute([""]); 
        $conn = NULL;
        header('Location: login.php');
        exit();
?>
