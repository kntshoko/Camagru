<?php
    $mg = "";
    session_start();
    if(!$_SESSION['login'])
    {
        if (isset($_POST['logedin']))
        {
            require_once("config.php");
            $login = $_POST['login'];
            $password = $_POST['password'];
            if($password == NULL || $login == NULL)
            {
                $mg = "fill in all the boxes";
            }
            else
            {
                $sql = $conn->prepare("SELECT id FROM users WHERE `user_name`= '$login' OR `email` = '$login' LIMIT 1");
                $sql->execute();
                $row = $sql->fetch();
                if (empty($row) == true)
                {
                    $mg = "account does not exist";
                }
                else
                {
                    $sql = $conn->prepare("SELECT id FROM users WHERE `user_name`= '$login' AND `password` = ? LIMIT 1");/* OR `email` = '$login' AND `password` = ?  */
                    $password = md5($password);
                    $sql->execute([$password]);
                    $row = $sql->fetch();
                    if (empty($row) == true)
                    {
                        $sql = $conn->prepare("SELECT id FROM users WHERE `email` = '$login' AND `password` = ?  LIMIT 1");/* OR  */
                        $password = md5($password);
                        $sql->execute([$password]);
                        $row = $sql->fetch();
                        if (empty($row) == true)
                        {
                            $mg = "check inputs";
                        }
                        else
                        {
                            $sql = $conn->prepare("SELECT id FROM users WHERE `user_name` = '$login' AND `account` = ? LIMIT 1");
                            $sql->execute(1);
                            $row = $sql->fetch();
                            if (empty($row) == true)
                            {
                                $sql = $conn->prepare("SELECT id FROM users WHERE `email` = '$login' AND `account` = ? LIMIT 1");
                                $sql->execute(1);
                                $row = $sql->fetch();
                                if (empty($row) == true)
                                {
                                    $mg = "account not activeted please check your email";
                                }
                                else
                                {
                                    session_start();
                                    $_SESSION['login'] = $_POST['login'];
                                    $_SESSION['password'] = md5($_POST['password']);
                                    header('Location: logedin.php');
                                    exit();
                                }
                            }
                            else
                            {
                                session_start();
                                $_SESSION['login'] = $_POST['login'];
                                $_SESSION['password'] = md5($_POST['password']);
                                header('Location: logedin.php');
                                exit();
                            }
                        }
                    }
                    else
                    {

                        $sql = $conn->prepare("SELECT id FROM users WHERE `user_name` = '$login' AND `account` = 1 LIMIT 1");
                        $sql->execute();
                        $row = $sql->fetch();
                        if (empty($row) == true)
                        {
                            $sql = $conn->prepare("SELECT id FROM users WHERE `email` = '$login' AND `account` = ? LIMIT 1");
                            $sql->execute(1);
                            $row = $sql->fetch();
                            if (empty($row) == true)
                            {
                                $mg = "account not activeted please check your email";
                            }
                            else
                            {
                                session_start();
                                $_SESSION['login'] = $_POST['login'];
                                $_SESSION['password'] = md5($_POST['password']);
                                header('Location: logedin.php');
                                exit();
                            }
                        }
                        else
                        {
                            session_start();
                            $_SESSION['login'] = $_POST['login'];
                            $_SESSION['password'] = md5($_POST['password']);
                            header('Location: logedin.php');
                            exit();
                        }
                    }
                }
            }
        }
    }
    else
    {
        header('Location: logedin.php');
        exit();
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class = "cl">
            <a href="index.php">Go To Welcome</a>
            <a href="registration.php">Register Account</a>
            <a href="forgotpassword.php">Forgot Password</a>
    </div>      
    <h1 align = center>
            CAMAGRU
    </h1>
    <div class = "main">
        
            <form action="login.php" method ="post">
            <h2>LOGIN FORM</h2>
                 <div class="imgcon">
                 <img src="image.png" alt = "limg" class ="limg">
                 </div>   
                 <h2> 
                    <?php 
                        if($mg != "")
                     echo $mg . "<br>";
                     ?>
                </h2>
                 <div class = "con">
                       <label for="login">User Name or Email:</label> <br> <input type="text" name = "login"/><br><br>
                       <label for="password">Password:</label> <br> <input type="password" name = "password"/><br><br> 
                        <input type="submit" name = "logedin" value = "login"/>
                 </div>
            </form>
      </div>      
    </body>
</html>
