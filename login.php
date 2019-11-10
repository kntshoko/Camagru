<?php
    $mg = "";
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
                $sql = $conn->prepare("SELECT id FROM users WHERE `user_name`= '$login' OR `email` = '$login' AND `password` = ?  LIMIT 1");
                $sql->execute(md5($password));
                $row = $sql->fetch();
                if (empty($row) == true)
                {
                    $mg = "Email/username/password incorrect ";
                }
                else
                {
                    header('logedin.php');
                    exit();
                }
            }
        }
    }
?>

<html>
    <head>
        <style>
            body{
                text-align : center;
                font-family : Arial, Helvetica, sans-serif;
                background-color: rgb(250,200,150) ;
            }
            form{
                border : 3px solid #f1f1f1;
                background-color: white;
            }
            input[type=text], input[type=password]{
                width : 60%;
                padding : 12px 20px;
                margin : 8px 0;
                display : inline-block;
                border : 1px solid #ccc;
                box-sizing : border-box;
            }
            input[type=submit]{
                width : 30%;
                padding : 10px 18px;
                margin : 8px 0;
                display : inline-block;
                border : 1px solid #ccc;
                box-sizing : border-box;
                background-color : #847ef7;
            }
            .imgcon{
                text-align :center;
                margin : 24px 0 12px 0;
            }
            img.limg{
                width : 40%;
                border : 1px solid #f1f1f1;
                border-radius : 50%;
            }
            .container{
                padding : 16px;
            }
            .cl{
            position :absolute;
            left : 30%;
            height : 60%;
            width : 40%;
        }
        </style>
    </head>
    <body>
    <h1 align = center>
            CAMAGRU
    </h1>
    <div class = "cl">

            <h2>
                LOGIN FORM
            </h2>
            <form action="login.php" method ="post">
                 <div class="imgcon">
                 <img src="image.png" alt = "limg" class ="limg">
                 </div>   
                 <?php 
                    if($mg != "")
                    echo $mg . "<br>";
                ?>
                 <div class = "con">
                        User Name or Email:<br> <input type="text" name = "login"/><br><br>
                        Password:<br> <input type="password" name = "password"/><br><br> 
                        <input type="submit" name = "logedin" value = "login"/>
                 </div>
                 <div class = "con">
                   <a href="registration.php">Register Account</a>
                   <a href="registration.php">Forgot Password</a>
                 </div>
            </form>
      </div>      
    </body>
</html>
