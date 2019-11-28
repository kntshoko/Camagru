<?php

session_start();

if ($_SESSION['login'])
{
    header('loction: logedin.php');
    die();
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
            <a href="login.php">Login</a>
            <a href="registration.php">Register Account</a>
        </div>      
            <h1 align = center>
                CAMAGRU
            </h1>   
        <div class = "main">
            <div class = "imgs">
            <?php                         
                    require_once ("setup.php");
                    require_once("config.php"); 
                        
                    try{
                            $sql = $conn->prepare("SELECT * FROM gallery") ;
                            $sql->execute(); 
                            $result = $sql->fetchall();
                    }
                    catch(PDOExceptipn $e)
                    {
                    echo $e->getMessage();
                    }  
                    echo "<table>";
                       
                            foreach ($result as $row) {
                                echo "<tr>";
                                echo "<td>";
                                    ?>
                                        <div class="imgcon">
                                            <img src="<?php echo "uploads/".$row['imagename'];?>" alt = "pimg" class ="pimg">
                                        </div>   
                                        <?php
                                echo "</td>";
                                echo "</tr>";
                            }
                        echo "</tr>";
                    echo "</table>";
                ?>
            </div>
            <div class = "controls">

            </div>
        </div>
    </body>
</html>