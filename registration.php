<?php
    $mg = "";
   
    if (isset($_POST['submit']))
    {
        require_once ("config/setup.php");
        require_once("config/database.php");
   
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $conpasword = $_POST['conpassword']; 
                
        if ($email == null || $username == null || $conpasword != $password)
        {
            $mg = "check your inputs";

        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $mg = "Invalid email format";
        }
        else if (ctype_upper($password))
        {
            $mg = "Your password must consists of at least one upper-case letter";
        }
        else
        {
           
                $sql = $conn->prepare("SELECT id FROM users WHERE `user_name`= '$username' OR `email` = '$email' LIMIT 1");
                $sql->execute();
                $row = $sql->fetch();
                 
                if (empty($row) == true)
                {
                    $token = substr(str_shuffle("123456789".
                    "MNBVCXZASDFGHJKL"),0,10);
                         $sql = $conn->prepare("INSERT INTO users (`user_name`,`email`,`password`,`token`,`account`,`notification`) 
                    VALUES (?,?,?,?,?,?)"); 
                    $sql->execute([$username,$email,md5($password),$token,0,1]);
                    $to = $email;
                    $subject = "CAMAGRU email comfermation";
                    $message = "click on the link below<br><a href ='http://localhost:8080/Camagru/confirm.php?email=$email&username=$username&token=$token'>confrm account</a>";
                    $headers = 'From: nonreply'."\r\n";
                    $headers .= "MIME-Version: 1.0"."\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
                    mail($to,$subject,$message,$headers);
                    $mg ="mail sent check your mailbox";
  
                }
                else
                {
                    $mg = "user account already exists";
                }
            }   
        $conn = NULL;
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
        </div>      
    <h1>
            CAMAGRU
    </h1>
    <div class = "main">
        
            <form action="registration.php" method ="post" class = "registration">
            <h2>REGISTRATION FORM</h2>
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
                    <label for="username">User Name : </label>   
                    <br>
                    <input type="text" name = "username" />
                    <br><br>
                    <label for="email">Email Address:  </label>  
                    <br>
                    <input type="text" name = "email" />
                    <br><br>
                    <label for="password"> Password : </label> 
                    <br>
                    <input type="password" name = "password" />
                    <br><br>
                    <label for="conpassword">confirm Password :  </label>   
                    <br>
                    <input type="password" name = "conpassword" />
                    <br><br>
                    <br>
                    <input type="submit" name = "submit" value = "register"/>
                    <br><br>
                </div>
            </form>
      </div>      
    </body>
</html>







