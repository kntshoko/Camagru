<?php

session_start();
//if(!$_SESSION['login'])
//{
  //      header('Location: logedin.php');
    //    exit();
//}
require_once ("setup.php");
require_once("config.php");  
if (isset($_POST['delete']))
{
    
    $imgid = $_GET['imgid'];
    echo $imgid;
    try {
        $sql = $conn->prepare("DELETE FROM `gallery` WHERE `imageid` = $imgid");
        $sql->execute();
        $sql = $conn->prepare("DELETE FROM `comments` WHERE `imageid` = $imgid");
        $sql->execute();
        $sql = $conn->prepare("DELETE FROM `likes` WHERE `imageid` = $imgid");
        $sql->execute();
    } catch (PDOExceptipn $e) {
        echo "failed  ".$e->getMessage();
    }
    
}

?>
<html>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="camagru.js"></script>
</head>
<body>
    <div class="navbar">
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

        <?php                         
                     
                     require_once ("setup.php");
                     require_once("config.php"); 
                    try{
                            $sql = $conn->prepare("SELECT * FROM gallery") ;
                            $sql->execute(); 
                            $result = $sql->fetchall(); 
                            echo "<table>";

                            foreach ($result as $row) {
                                 echo "<tr>";
                                echo "<td>";
                                    ?>
                                    <p><?php echo $row['user_name'];?></p>
                                    <div class ="imagecontainer">
                                          <img src="
                                            <?php
                                                echo "uploads/".$row['imagename'];
                                            ?>" 
                                        alt="" class ="postimage">
                                    </div>
                                    <form action="mypictures.php?imgid=<?php echo $row['imageid']?>" method="post">
                                    <input type="submit" name = "delete" value = "delete"/>
                                    </form>
                                       
                                    <?php
                                echo "</td>";

                                echo "</tr>";
                         }
                        
                    echo "</table>";
                    }
                    catch(PDOExceptipn $e)
                    {
                    echo $e->getMessage();
                    }  
                   
                ?>
    </div>
</body>
</html>