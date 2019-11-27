
<?php
    $mg = "";
    session_start();
    if(!$_SESSION['login'])
    {
        header('Location: index.php');
        exit();
    }
    else
    {
        if (isset($_POST['submit']))
        {
            require_once("config.php"); 
            if($_POST['email'] != null)
            {
                $sql = $conn->prepare("SELECT id FROM users WHERE  `email` = ? LIMIT 1");
                $sql->execute($_POST['email']);
                $row = $sql->fetch();
                if (empty($row) == true)
                {
                    $sql = $conn->prepare("UPDATE users SET `email` = ?  WHERE `email` = ?");
                    $sql->execute([$_POST['email'],$_POST['email']]); 
                }
                else
                {
                    $mg = "email already exists";
                }
            }
            if($_POST['username'] != null)
            {
                $sql = $conn->prepare("SELECT id FROM users WHERE  `user_name` = ? LIMIT 1");
                $sql->execute($_POST['username']);
                $row = $sql->fetch();
                if (empty($row) == true)
                {
                    $sql = $conn->prepare("UPDATE users SET `user_name` = ?  WHERE `user_name` = ?");
                    $sql->execute([$_POST['username'],$_POST['username']]); 
                }
                else
                {
                    $mg = "username already exists";
                }
            }
            $conn = null;
            
            $mg = "yo";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
        <style>
            body{
                font-family: Arial, Helvetica, sans-serif;
            }
            form{
                background-color: #333;
                text-align : center;
            }
            .cll {
            overflow: hidden;
            background-color: #333;
            }
            .cll a:hover{
            background-color: red;
            }
            .cll a {
            float: left;
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            }
            .cl label  
            {
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
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
                color: white;
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
        h2{
            color: white; 
            font-family: inherit;
        }
        </style>
    </head>
    <body>
        <div class = "cll">
            <a href="logedin.php">Go To Home</a>
        </div>      
    <h1 align = center>
            CAMAGRU
    </h1>
    <div class = "cl">
        
            <form action="preferences.php" method ="post">
            <h2>PERFERENCES FORM</h2>
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
                    <label for="email">change email  </label>  
                    <br>
                    <input type="text" name = "email" />
                    <br><br>
                    <label for="username"> change username </label> 
                    <br>
                    <input type="text" name = "username" />
                    <br><br>
                    <label for="likes">like notification  </label>   
                    <br>
                    <br><br>
                    <label for="comments">comment notification  </label>   
                    <br>
                    <br>
                    <label for="username"> Password </label> 
                    <br>
                    <input type="text" name = "username" />
                    <br><br>
                    <input type="submit" name = "submit" value = "register"/>
                    <br><br>
                </div>
            </form>
      </div>      
    </body>
</html>