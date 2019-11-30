
<?php
    $mg = "";
    session_start();
    //print($_SESSION['login']['notification']);
    //die();
   
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

            if(($_POST['notification'] == '1'))
            {
                
                try {
                    $sql = $conn->prepare("UPDATE `users` SET `notification`= 1 WHERE `id` = ?");
                    $sql->execute($_SESSION['login']['id']); 
                    $_SESSION['login']['notification'] = 1;
                    $mg = "changed notification";
                } catch (PDOExeption $e) {
                    $mg = $e->getMessage;
                }
            }
            else if(($_POST['notification'] != '1'))
            {
                
                try {
                    $sql = $conn->prepare("UPDATE `users` SET `notification`= 0 WHERE `id` = ?");
                    $sql->execute($_SESSION['login']['id']); 
                    $_SESSION['login']['notification'] = 0;
                    $mg = "changed notification";
                } catch (PDOExeption $e) {
                    $mg = $e->getMessage;
                }
                
            }

            $conn = null;
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
        <div class = "cl">
            <a href="logedin.php">Go To Home</a>
        </div>      
    <h1 align = center>
            CAMAGRU
    </h1>
    <div class = "cl">
        
            <form action="preferences.php" method ="post">
            <h3 style = "color : white">PERFERENCES</h3>
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
                    <label for="notification"> set notification on
                        <input type="checkbox" name="notification" <?php
                            if ($_SESSION['login']['notification'] == 1)
                            {
                                echo "checked";
                            }
                        ?> value = '1'>
                    </label>   
                    <br>
                    <br>
                    <label for="username"> Password </label> 
                    <br>
                    <input type="text" name = "username" />
                    <br><br>
                    <input type="submit" name = "submit" value = "save chanes"/>
                    <br><br>
                </div>
            </form>
      </div>      
    </body>
</html>