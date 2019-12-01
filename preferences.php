
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
        $id =$_SESSION['login']['id'];
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
            $uname = $_POST['username']; 
            if($uname != null)
            { 
               
                $sql = $conn->prepare("SELECT id FROM users WHERE  `user_name` = ? LIMIT 1");
                $sql->execute($uname);
                $row = $sql->fetch();
                if (empty($row) == true)
                {
                   
                    $sql = $conn->prepare("UPDATE users SET `user_name` = $uname   WHERE `id` = $id");
                    $sql->execute(); 
                    echo "yooo";
                    $sql = $conn->prepare("UPDATE likes SET `user_name` = $uname   WHERE `user_name` = ?");
                    $sql->execute($_SESSION['login']['user_name']); 
                    $sql = $conn->prepare("UPDATE commets SET `user_name` = $uname   WHERE `user_name` = ?");
                    $sql->execute($_SESSION['login']['user_name']); 
                    $sql = $conn->prepare("UPDATE gallery SET `user_name` = $uname   WHERE `user_name` = ?");
                    $sql->execute($_SESSION['login']['user_name']); 

                    $_SESSION['login']['user_name'] = $uname;
                }
                else
                {
                    $mg = "username already exists";
                }
            }

            if(($_POST['notification'] == '1'))
            {
                
                try {
                    $sql = $conn->prepare("UPDATE `users` SET `notification`= 1 WHERE `id` = $id");
                    $sql->execute(); 
                    $_SESSION['login']['notification'] = 1;
                } catch (PDOExeption $e) {
                    $mg = $e->getMessage;
                }
            }
            else if(($_POST['notification'] != '1'))
            {
                $id =$_SESSION['login']['id'];
                
                try {
                    $sql = $conn->prepare("UPDATE `users` SET `notification`= 0 WHERE `id` = $id");
                    $sql->execute(); 
                    $_SESSION['login']['notification'] = 0;
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
        <div class = "navbar">
            <a href="logedin.php">Go To Home</a>
            <a href="logout.php">LOGOUT</a>
        </div>      
    <h1 align = center>
            CAMAGRU
    </h1>
    <div class = "main">
        
            <form action="preferences.php" method ="post">
            <h3 style = "color : white">PERFERENCES</h3>
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
                    <input type="password" name = "password" />
                    <br><br>
                    <input type="submit" name = "submit" value = "save chanes"/>
                    <br><br>
                </div>
            </form>
      </div>      
    </body>
</html>