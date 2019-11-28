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
    <div class="cl">
        <a href="gallary.php">GALLARY</a>
        <div class="drop">
            <button class="setbtn">SETTINGS</button>
            <div class="cont">
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
                    }
                    catch(PDOExceptipn $e)
                    {
                    echo $e->getMessage();
                    }  
                    echo "<table>";
                       
                        $i = 0;
                       // while ($i < 4){
                            foreach ($result as $row) {
                                 echo "<tr>";
                                echo "<td>";
                                    ?>
                                        <img src="
                                            <?php
                                                echo "uploads/".$row['imagename'];
                                            ?>" 
                                        alt="" class ="pimg" onclick="window.location.href = 'wideview.php?imgid=<?php echo $row['imageid']?>&imgname=<?php echo $row['imagename']?>';">
                                        <br><br>
                                        <button type="button" value = "<?php echo $row['imageid']?>" id ="mylikes<?php echo $row['imageid']?>" onclick="mylikes('<?php echo 'mylikes'.$row['imageid']?>');"> likes</button>
                                        <button type="button" onclick="window.location.href = 'wideview.php?imgid=<?php echo $row['imageid']?>&imgname=<?php echo $row['imagename']?>';"> comments</button>
                                    <?php
                                echo "</td>";
                                echo "</tr>";
                         }
                        
                    echo "</table>";
                ?>
    </div>
</body>
</html>