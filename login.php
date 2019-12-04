<?php
    $mg = "";
    session_start();
    if(!$_SESSION['login'])
    {
        if (isset($_POST['logedin']))
        {
            require_once ("setup.php");
            require_once("config.php"); 
            $login = $_POST['login'];
            $password = $_POST['password'];
            if($password == NULL || $login == NULL)
            {
                $mg = "fill in all the boxes";
            }
            else
            {
                $sql = $conn->prepare("SELECT * FROM users WHERE `user_name`= '$login' OR `email` = '$login' LIMIT 1");
                $sql->execute();
                $row = $sql->fetch();
                if (empty($row) == true)
                {
                    $mg = "account does not exist";
                }
                else
                {
                    if ($row['password'] == md5($password))
                    {
                        if($row['account'] == 1)
                        {
                            $_SESSION['login'] = $row;
                            header('Location: logedin.php');
                            exit();
                        }
                        else
                        {
                            $mg = "Account is not activated please check your mail box";
                        }
                    }
                    else
                    {
                        $mg = "Your inputs are incorrect";
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
    <div class = "navbar">
            <a href="index.php">Go To Welcome</a>
            <a href="registration.php">Register Account</a>
            <a href="forgotpassword.php">Forgot Password</a>
    </div>      
    <h1 align = center>
            CAMAGRU
    </h1>
    <div class = "main">
        
            <form action="login.php" method ="post" class ="login">
            <h2>LOGIN FORM</h2>
                 <div class="imagecontainer">
                 <img src="image.png" alt = "limg" class ="loginimage">
                 </div>   
                 <h2> 
                    <?php 
                        if($mg != "")
                     echo $mg . "<br>";
                     ?>
                </h2>
                 <div class = "container">
                       <label for="login">User Name or Email:</label> <br> <input type="text" name = "login"/><br><br>
                       <label for="password">Password:</label> <br> <input type="password" name = "password"/><br><br> 
                        <input type="submit" name = "logedin" value = "login"/>
                 </div>
            </form>
      </div>      
    </body>
</html>
