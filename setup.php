<?php

$servername = "localhost";
$username = "root";
$password = "123456";
$dbName = "camagru";

    try {
        $conn = new PDO("mysql:host=$servername", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $conn->prepare("CREATE DATABASE IF NOT EXISTS $dbName");
        $sql->execute();
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
 
    try{
        $conn = new PDO("mysql:host=$servername", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $conn->prepare(
            "CREATE TABLE IF NOT EXISTS `camagru`.`users` (
            `id` INT(6) UNSIGNED NOT NULL AUTO_INCREMENT ,
            `user_name` VARCHAR(20) NOT NULL , 
            `email` VARCHAR(100) NOT NULL ,
            `password` VARCHAR(100) NOT NULL ,
            `token` VARCHAR(10) DEFAULT NULL ,
            `account` INT(1) UNSIGNED NOT NULL ,
            `notification` INT(1) UNSIGNED NOT NULL ,
            PRIMARY KEY (`id`))");
            
        $sql->execute(); 
  
    }
    catch(PDOExceptipn $e){
        echo $sql ."<br>". $e->getmessage();
    }

    try{
        $sql = $conn->prepare("CREATE TABLE IF NOT EXISTS `camagru`.`comments` 
            ( `commentid` INT(11) NOT NULL AUTO_INCREMENT ,
            `user_name` VARCHAR(20) NOT NULL ,
            `imageid` INT(11) NOT NULL ,
            comment VARCHAR(200) NOT NULL,
            PRIMARY KEY (`commentid`))") ;
    $sql->execute(); 
    
    }catch(PDOExceptipn $e){
        echo $e->getMessage();
    }

    try{
        $sql = $conn->prepare("CREATE TABLE IF NOT EXISTS `camagru`.`likes` 
            ( `likeid` INT(11) NOT NULL AUTO_INCREMENT ,
            `user_name` VARCHAR(20) NOT NULL ,
            `imageid` INT(11) NOT NULL ,
            PRIMARY KEY (`likeid`))") ;
    $sql->execute(); 
    }catch(PDOExceptipn $e){
        echo $e->getMessage();

    }

    try{
        $sql = $conn->prepare("CREATE TABLE IF NOT EXISTS `camagru`.`gallery` 
            ( `imageid` INT(11) NOT NULL AUTO_INCREMENT ,
            `user_name` VARCHAR(20) NOT NULL ,
            `imagename` VARCHAR(100) NOT NULL ,
            PRIMARY KEY (`imageid`))") ;
    $sql->execute(); 
    }catch(PDOExceptipn $e){
        echo $e->getMessage();

    }
    $conn = null;

?>