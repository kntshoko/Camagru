<?php

session_start();
if(!$_SESSION['login'])
{
        header('Location: logedin.php');
        exit();
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

        <?php                         
                    require_once ("setup.php");
                    require_once("config.php");   
                        
                    try{
                            $sql = $conn->prepare("SELECT * FROM gallery ORDER BY `imageid` DESC") ;
                            $sql->execute(); 
                            $result = $sql->fetchall(); 
                            echo "<table>";

                            foreach ($result as $row) {
                                 echo "<tr>";
                                echo "<td>";
                                    ?>
                                    <p><b><?php echo $row['user_name'];?></b></p>
                                    <div class ="imagecontainer">
                                          <img src="
                                            <?php
                                                echo "uploads/".$row['imagename'];
                                            ?>" 
                                        alt="" class ="postimage" onclick="window.location.href = 'wideview.php?imgid=<?php echo $row['imageid']?>&imgname=<?php echo $row['imagename']?>';">
                                    </div>
                                    <p>
                                    <?php
                                    try {
                                        $count = $conn->prepare("SELECT * FROM `likes` WHERE `imageid` =?");
                                        $count->execute([$row['imageid']]);
                                        $l = $count->fetchall();
                                        $count = $conn->prepare("SELECT * FROM `comments` WHERE `imageid` =?");
                                        $count->execute($row['imageid']);
                                        $c = $count->fetchall();
                                        //var_dump($count);
                                        echo count($l)." likes ".count($c)."  comments";
                                    } catch (PDOExceptipn $e) {
                                        echo "failed == ".$e->getMessage();
                                    }
                                        
                                    ?>
                                    </p>
                                        <button type="button" value = "<?php echo $row['imageid']?>" id ="mylikes<?php echo $row['imageid']?>" onclick="mylikes('<?php echo 'mylikes'.$row['imageid']?>');"> likes</button>
                                        <button type="button" onclick="window.location.href = 'wideview.php?imgid=<?php echo $row['imageid']?>&imgname=<?php echo $row['imagename']?>';"> comments</button>
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