<?php

$servername = "localhost";
$username = "root";
$password = "123456";

    try{
        $conn = new PDO("mysql:host=$servername", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE camagru";
        $conn->exec($sql);

        $sql = "CREATE TABLE users(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(30) NOT NULL'
            lastname VARCHAR(30) NOT NULL'
            email VARCHAR(100) NOT NULL,
            `password` VARCHAR(200) NOT NULL)";
        $conn->exec($sql);

        
    }
    catch( PDOExceptipn $e){
        echo $sql ."<br>". $e->getmessage();
    }
    $conn = null;
?>