<?php

session_start();
if(!$_SESSION['login'])
{
        header('Location: index.php');
        exit();
}
?>
<html>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
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
                                        <button type="button" value = "<?php echo $row['imageid']?>" id ="mylikes<?php echo $row['imageid']?>" onclick="mylikes('<?php echo 'mylikes'.$row['imageid']?>');"> likes</button>
                                        <button type="button" onclick="window.location.href = 'wideview.php?imgid=<?php echo $row['imageid']?>&imgname=<?php echo $row['imagename']?>';"> comments</button>
                                    <?php
                                echo "</td>";
                                echo "</tr>";
                         //  $i++;
                         }
                        
                    echo "</table>";
                ?>
    </div>
    <script>

    
function mylikes(id) {
  var xhttp = new XMLHttpRequest();
    var x =  document.getElementById(id)

  xhttp.open("POST", "likes.php", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  console.log(x.value);
  xhttp.send("value="+x.value);
}


            /////check same as the one above

    /*        document.getElementById("upload").addEventListener("click", function() {
    var canvas = document.getElementById("canvas");
    var dataURL = canvas.toDataURL("image/png");
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        console.log(xhr.status, xhr.responseText);
    };
    
    xhr.open('POST', 't.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("image="+dataURL);
    // 
    }*/

            ////
    </script>
</body>
</html>