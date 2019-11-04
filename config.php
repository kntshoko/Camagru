<?php
   $servername = "localhost";
   $username = "root";
   $password = "123456";
   try{
       $conn = New PDO("mysql:host=$servername;dbname=camagru",$username,$password);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
   catch(PDOException $e)
   {
       echo "connection failed: " . $e->getMessage();
   }
?>