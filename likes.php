<?php
session_start();
require_once ("config/setup.php");
require_once("config/database.php");
$imageid = $_POST['value'];
$username = $_SESSION['login']['user_name'];
try{
        $sql = $conn->prepare("SELECT * FROM likes WHERE `user_name`= ? AND `imageid` = ?");
        $sql->execute([$username, $imageid]);
        $likes = $sql->fetchall();
    if(empty($likes))
    {
        $sql = $conn->prepare("INSERT INTO likes ( `user_name`, `imageid`) VALUES (?,?)");
        $sql->execute([$username,$imageid]);
    }
    else{
         //
        }
    }
catch(PDOException $e)
{
    echo "<br> failer ==" . $e->getMessage();
}
header('location: gallary');
?>