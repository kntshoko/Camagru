<?php

require_once ("setup.php");
require_once("config.php"); 

$sql = $conn->prepare("SELECT * FROM likes WHERE `user_name`= ? AND `imageid` = ?");
    $sql->execute([ username, imageid]);
    $likes = $sql->fetchall();
if(!empty($likes))
{
    //
}
else{
    $sql = $conn->prepare("INSERT INTO likes ( `user_name`, `imageid`) VALUES (?,?)");
    $sql->execute([ username, imageid]);
}
?>