<?php

    session_start();
    $page;
    if (isset($_SESSION['login']))
    {
        header('location: logedin.php');
       exit();
    }
    if(isset($_POST['page']))
        $page = $_POST['page'];                    
    require_once ("config/setup.php");
    require_once("config/database.php");
        
    try{
            $sql = $conn->prepare("SELECT * FROM gallery") ;
            $sql->execute(); 
            $result = $sql->fetchall();
    }
    catch(PDOExceptipn $e)
    {
    echo $e->getMessage();
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
            <a href="login.php">Login</a>
            <a href="registration.php">Register Account</a>
        </div>      
            <h1 >
                CAMAGRU
            </h1>   
        <div class = "main">
        <form action="index.php?page=<?php if(isset($page)){echo $page;}else{echo 0;}?>" method="post">
                <input type="submit" name = "previous" value="previous">
            </form>
            <div class = "imgs">
            <?php     
                    if (!isset($_POST['page']))
                    {
                        $page = 0;
                    }   
                    
                    if (isset($_POST['next'])) {
                        $page += 4;
                    }
                    if (isset($_POST['previous'])) {
                        $page -= 4;
                        if(isset($page) < 0) {
                            $page = 0;
                        }
                    }
                    echo "<table>";
                    $i = 0; 
                            while($result[$page] && isset($page) > -1 && $i < 5) {
                                echo "<tr>";
                                echo "<td>";
                                    ?>
                                        <div class="imagecontainer">
                                            <img src="<?php echo "uploads/".$result[$page]['imagename'];?>" alt = "pimg" class ="postimage">
                                        </div>   
                                        <?php
                                echo "</td>";
                                echo "</tr>";
                                $page++;
                                $i++;
                            }
                        echo "</tr>";
                    echo "</table>";
                ?>
            </div>
            <form action="index.php?page=<?php echo $page?>" method="post">
                <input type="submit" name = "next" value="next">
            </form>
        </div>
    </body>
</html>