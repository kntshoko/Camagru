<?php
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
        $email = $_POST['email']; 
        if ($email == null )
        {
            $mg = "check your inputs";
        }
        else
        {
            $sql = $conn->prepare("SELECT id FROM users WHERE `email` = '$email' LIMIT 1");
            $sql->execute();
            $row = $sql->fetch();
            if (empty($row) != true)
            {
                $token = substr(str_shuffle($firstname.$lastname."123456789".
                "MNBVCXZASDFGHJKL"),0,10);
                $sql = $conn->prepare("INSERT INTO users (`token`) 
                VALUES (?)"); 
                $sql->execute([$token]);
                $to = $email;
                $subject = "CAMAGRU Password recreation";
                $message = "click on the link below<br><a href ='http://localhost:8081/untitled%20folder/sa4/confirmpassword.php?email=$email&token=$token'>confrm account</a>";
                $headers = 'From: nonreply'."\r\n";
                $headers .= "MIME-Version: 1.0"."\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
                mail($to,$subject,$message,$headers);
                $mg ="mail sent check your mailbox";
               
            }
            else
            {
                $mg = "check your inputs";
            }
        }   
        $conn = NULL;
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
    <script src="camagru.js"></script>
    </head>
    <body>
        <div class = "navbar">
            <a href="login.php">Go To Login</a>
        </div>      
    <h1 align = center>
            CAMAGRU
    </h1>
    <div class = "main">
        
            <form action="forgotpassword.php" method ="post">
            <h2>FORGOT PASSWORD FORM</h2>
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
                    <label for="email">Email  </label>  
                    <br>
                    <input type="text" name = "email" />
                    <br><br>
                    <input type="submit" name = "submit" value = "register"/>
                    <br><br>
                </div>
            </form>
      </div>      
    </body>
</html>