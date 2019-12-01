
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
            require_once ("setup.php");
            require_once("config.php");
            

            if (!(md5($_POST['currentpassword']) == $_SESSION['login']['password']))
            {

                $mg = "password incorect";
            }
            else
            {
                echo "currentpassword  == ".$_POST['currentpassword']."<br>";
                echo "currentpassword  == ".md5($_POST['currentpassword'])."<br>";
                echo "password  -----------> ".$_SESSION['login']['password']."<br>";
                if ( $_POST['cpassword'] == null || $_POST['npassword'] == null)
                {
                    $mg = "check your input";
                }
                else
                {
                    if ($_POST['cpassword'] == $_POST['npassword'])
                    {
                        $id = $_SESSION['login']['id'];
                        $sql = $conn->prepare("UPDATE users SET `password` = ?  WHERE  `id` = '$id'");
                        $sql->execute(md5($_GET['conpassword'])); 
                        print_r($sql);
                        die();
                        $_SESSION['login']['password'] = md5($_GET['cpassword']);
                        header('Location: logout.php');
                        exit();
                    }
                    else
                    {
                        $mg = "new  Passswords do not match";
                    }
                } 
                $conn = NULL;
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