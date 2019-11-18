<?php

$servername = "localhost";
$username = "root";
$password = "123456";
$dbName = "camagru";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS $dbName";
    echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
  
    try{
        $conn = new PDO("mysql:host=$servername", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $sql = "CREATE DATABASE camagru";
       //$conn->exec($sql);
       echo "coooonn1";
        $sql = $conn->prepare(
            "CREATE TABLE IF NOT EXISTS `camagru`.`users` (
            `id` INT(6) UNSIGNED NOT NULL AUTO_INCREMENT ,
            `user_name` VARCHAR(20) NOT NULL , 
            `email` VARCHAR(100) NOT NULL ,
            `password` VARCHAR(100) NOT NULL ,
            `token` VARCHAR(10) NOT NULL ,
            `account` INT(1) UNSIGNED NOT NULL ,
            PRIMARY KEY (`id`))");
        $sql->execute(); 
        
        echo "<br>t1";
      
    }
    catch(PDOExceptipn $e){
        echo $sql ."<br>". $e->getmessage();
    }

    try{
        $sql = $conn->prepare("CREATE TABLE IF NOT EXISTS  comments(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(100) NOT NULL,
        `comment` VARCHAR(200) NOT NULL),
        imageid int(6) UNSIGNED "); 
   $sql->execute(); 
   echo "<br>t2";
    }catch(PDOExceptipn $e){
        echo $e->getMessage();

    }

    try{
        $sql = $conn->prepare("CREATE TABLE IF NOT EXISTS likes(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        imageid VARCHAR(100) NOT NULL,
        `usename` VARCHAR(200) NOT NULL)") ;
    $sql->execute(); 
    echo "<br>t3";
    }catch(PDOExceptipn $e){
        echo $e->getMessage();

    }

    try{
        $sql = $conn->prepare("CREATE TABLE `camagru`.`gallery` ( `imageid` INT(11) NOT NULL AUTO_INCREMENT ,
         `user_name` INT NOT NULL ,
          `imagename` INT NOT NULL ,
           PRIMARY KEY (`imageid`))") ;
    $sql->execute(); 
    echo "<br>t4";
    }catch(PDOExceptipn $e){
        echo $e->getMessage();

    }
    $conn = null;
?>