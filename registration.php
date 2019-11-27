<?php
    $mg = "";
   
    if (isset($_POST['submit']))
    {
        require_once ("setup.php");
        require_once("config.php");
   
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $conpasword = $_POST['conpassword']; 
                
        if ($email == null || $username == null || $conpasword != $password)
        {
            $mg = "check your inputs";

        }
        else
        {
           
                $sql = $conn->prepare("SELECT id FROM users WHERE `user_name`= '$username' OR `email` = '$email' LIMIT 1");
                $sql->execute();
                $row = $sql->fetch();
                 
                if (empty($row) == true)
                {
                   // var_dump($row);


                    $token = substr(str_shuffle("123456789".
                    "MNBVCXZASDFGHJKL"),0,10);
                         $sql = $conn->prepare("INSERT INTO users (`user_name`,`email`,`password`,`token`,`account`,`notification`) 
                    VALUES (?,?,?,?,?,?)"); 
                    
                    $sql->execute([$username,$email,md5($password),$token,0,1]);
                    $to = $email;
                    $subject = "CAMAGRU email comfermation";
                    $message = "click on the link below<br><a href ='http://localhost:8080/sa4/confirm.php?email=$email&username=$username&token=$token'>confrm account</a>";
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
        <div class = "cll">
            <a href="index.php">Go To Welcome</a>
        </div>      
    <h1 align = center>
            CAMAGRU
    </h1>
    <div class = "cl">
        
            <form action="registration.php" method ="post">
            <h2>REGISTRATION FORM</h2>
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







