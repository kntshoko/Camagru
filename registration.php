<?php
    $mg = "";
    if (isset($_POST['submit']))
    {
        require_once("config.php"); 
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $conpasword = $_POST['conpassword']; 
        if ($firstname == null || $lastname == null || $email == null || $username == null || $conpasword != $password)
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
                    $token = substr(str_shuffle($firstname.$lastname."123456789".
                    "MNBVCXZASDFGHJKL"),0,10);
                    $sql = $conn->prepare("INSERT INTO users (`firstname`,`lastname`,`user_name`,`email`,`password`,`token`) 
                    VALUES (?,?,?,?,?,?)"); 
                    $sql->execute([$firstname,$lastname,$username,$email,md5($password),$token]);
                    $to = $email;
                    $subject = "CAMAGRU email comfermation";
                    $message = "click on the link below<br><a href ='http://localhost:8081/untitled%20folder/sa4/confirm.php?email=$email&username=$username&token=$token'>confrm account</a>";
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



<html>
    <head>
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
                  <label for="firstrname">First Name :</label>   <br>
                    <input type="text" name = "firstname" />
                    <br><br>
                    <label for="firstrname">Last Name : </label>     
                    <br>
                    <input type="text" name = "lastname" />
                    <br><br>
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







