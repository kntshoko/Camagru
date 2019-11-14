<?php
    session_start();
    if(!$_SESSION['login'])
    {
        header('Location: index.php');
        exit();
    }
    else
    {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    }
?>