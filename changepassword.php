
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
            $sql = $conn->prepare("SELECT id FROM users WHERE `password`= ? LIMIT 1");
            $sql->execute(md5($_POST['currentpassword']));
            $row = $sql->fetch();
            if (empty($row) != true)
            {
                if ( $_POST['conpassword'] == null || $_POST['newpassword'] == null)
                {
                    $mg = "check your input";
                }
                else
                {
                    if ($_POST['conpassword'] == $_POST['newpassword'])
                    {
                        $email = $_SESSION['email'];
                        $password = $_SESSION['password'];
                        $sql = $conn->prepare("UPDATE users SET `password` = ?  WHERE `password` = '$password' AND `email` = '$email'");
                        $sql->execute([md5($_GET['conpassword'])]); 
                        $sql = $conn->prepare("UPDATE users SET token = ?  WHERE `email` = '$email'");
                        $sql->execute([""]); 
                        $_SESSION['password'] = md5($_GET['conpassword']);
                        header('Location: logedin.php');
                        exit();
                    }
                    else
                    {
                        $mg = "Passsword do not match";
                    }
                } 
                $conn = NULL;
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
        <div class = "navbar">
            <a href="logedin.php">Go To Home</a>
            <a href="gallary.php">GALLARY</a>
        <div class="dropdown">
            <button class="setbtn">SETTINGS</button>
            <div class="dropcontainer">
                <a href="changepassword.php">change password</a>
                <a href="preferences.php">preferences</a>
                <a href="deleteaccount.php">Delete account</a>
            </div>
        </div> 
        <a href="logout.php">LOGOUT</a>
        </div>      
    <h1 align = center>
            CAMAGRU
    </h1>
    <div class = "main">
        
            <form action="changepassword.php" method ="post">
            <h2>CHANGE PASSWORD FORM</h2>
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
                    <label for="password">Current Password:  </label>  
                    <br>
                    <input type="password" name = "currentpassword" />
                    <br><br>
                    <label for="newpassword"> New Password : </label> 
                    <br>
                    <input type="password" name = "newpassword" />
                    <br><br>
                    <label for="conpassword">Confirm New Password :  </label>   
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