<?php
    $mg = "";
    if (isset($_POST['submit']))
    {
        if ( $_POST['conpassword'] == null || $_POST['newpassword'] == null)
        {
            $mg = "check your input";
        }
        else
        {
            if ( $_POST['conpassword'] == $_POST['newpassword'] )
            {
                $email = $_GET['email'];
            $token = $_GET['token'];
            require_once("config.php");
            $sql = $conn->prepare("UPDATE users SET `password` = ?  WHERE `email` = '$email'  AND token = '$token'");
            $sql->execute([md5($_POST['conpassword'])]); 
            $sql = $conn->prepare("UPDATE users SET token = ?  WHERE `email` = '$email'  AND token = '$token'");
            $sql->execute([""]); 
            $conn = NULL;
            header('Location: login.php');
            exit();
            }
            else
            {
                $mg = "Passsword do not match";
            }
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
    <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class = "cll">
            <a href="login.php">Go To Home</a>
        </div>      
    <h1 align = center>
            CAMAGRU
    </h1>
    <div class = "cl">
        
            <form action="confirmpassword.php" method ="post">
            <h2>CONFIRM PASSWORD FORM</h2>
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
                    <label for="npassword"> New Password : </label> 
                    <br>
                    <input type="password" name = "npassword" />
                    <br><br>
                    <label for="cpassword">Confirm New Password :  </label>   
                    <br>
                    <input type="password" name = "cpassword" />
                    <br><br>
                    <br>
                    <input type="submit" name = "submit" value = "register"/>
                    <br><br>
                </div>
            </form>
      </div>      
    </body>
</html>