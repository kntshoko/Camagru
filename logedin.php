<?php

session_start();
$page;
if(!$_SESSION['login'])
{
        header('Location: logedin.php');
        exit();
}
if(isset($_POST['page']))
        $page = $_POST['page'];      
require_once ("config/setup.php");
require_once("config/database.php");

    try{
        $sql = $conn->prepare("SELECT * FROM gallery ORDER BY `imageid` DESC") ;
        $sql->execute(); 
        $result = $sql->fetchall(); 
    }
        catch(PDOExceptipn $e)
    {
        echo $e->getMessage();
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
               <h1 style= "text-align :center;">
                CAMAGRU
            </h1>       
        <div class = "main">
            <form action="logedin.php?page=<?php if(isset($page)){echo $page;}else{echo 0;}?>" method="post">
                <input type="submit" name = "previous" value="previous">
            </form>
        <?php                         
                   
                   if (!isset($_POST['page']))
                   {
                       $m = 0;
                   } 
                   else
                       $m =   $_POST['page'];
                   
                   if (isset($_POST['next'])) {
                       $m += 4;
                   }
                   if (isset($_POST['previous'])) {
                       $m -= 4;
                       if($m < 0) {
                           $m = 0;
                       }
                   }
                   $i = 0;
                  
                            echo "<table>";
                            if (isset($result[$m]))
                            {
                                while($result[$m] && $i < 5) {
                                 echo "<tr>";
                                echo "<td>";
                                    ?>
                                    <p><b><?php echo $result[$m]['user_name'];?></b></p>
                                    <div class ="imagecontainer">
                                          <img src="
                                            <?php
                                                echo "uploads/".$result[$m]['imagename'];
                                            ?>" 
                                        alt="" class ="postimage" onclick="window.location.href = 'wideview.php?imgid=<?php echo $result[$m]['imageid']?>&imgname=<?php echo $result[$m]['imagename']?>';">
                                    </div>
                                    <p>
                                    <?php
                                    try {
                                        $count = $conn->prepare("SELECT * FROM `likes` WHERE `imageid` =?");
                                        $count->execute([$result[$m]['imageid']]);
                                        $l = $count->fetchall();
                                        echo count($l)." likes ";
                                    } catch (PDOExceptipn $e) {
                                        echo "failed == ".$e->getMessage();
                                    }
                                        
                                    ?>
                                    </p>
                                        <button type="button" value = "<?php echo $result[$m]['imageid']?>" id ="mylikes<?php echo $result[$m]['imageid']?>" onclick="mylikes('<?php echo 'mylikes'.$result[$m]['imageid']?>');"> likes</button>
                                        <button type="button" onclick="window.location.href = 'wideview.php?imgid=<?php echo $result[$m]['imageid']?>&imgname=<?php echo $result[$m]['imagename']?>';"> comments</button>
                                    <?php
                                echo "</td>";

                                echo "</tr>";
                                $m++;
                                $i++;
                         }
                        }
                            
                        
                    echo "</table>";
                    
                   
                ?><form action="logedin.php?page=<?php echo $m?>" method="post">
                <input type="submit" name = "next" value="next">
            </form>
    </div>
</body>
</html>