
<?php

session_start();
if(!$_SESSION['login'])
{
        header('Location: index.php');
        exit();
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
        <script src="camagru.js"></script>
    </head>
    <body>
        <div class = "navbar">
            <a href="logedin.php">Go To Welcome</a>

            <a href="mypictures.php">My Pictures</a>
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
        <h1 style = "text-align : center">
                CAMAGRU
            </h1> 
            

        <div class = "main">     
            
        <div class = "thumbnail">
            <?php                         
                    require_once ("config/setup.php");
                    require_once("config/database.php");  
                        
                    try{
                            $sql = $conn->prepare("SELECT * FROM gallery WHERE `edited` = 1 AND
                            `user_name` = ? ORDER BY `imageid` DESC") ;
                            $sql->execute([$_SESSION['login']['user_name']]); 
                            $result = $sql->fetchall(); 
                            echo "<table>";
                             echo "<tr>";
                            foreach ($result as $row) {
                              
                                echo "<td>";
                                    ?>
                                    <div class ="imagecontainer">
                                          <img src="
                                            <?php
                                                echo "uploads/".$row['imagename'];
                                            ?>" 
                                        alt="" class ="thumbimage">
                                    </div>
                                    <?php
                                echo "</td>";

                                
                         }
                        echo "</tr>";
                    echo "</table>";
                    }
                    catch(PDOExceptipn $e)
                    {
                    echo $e->getMessage();
                    }  
                   
                ?>
            
            </div>

            <div class = "gallery">
                <button  onclick="myfunction()">enable webcam</button>
                <button  onclick="upload()" id = "upload" class="upload">upload</button>
                <div class="booth">
                    <video id="video"  class = "video"></video>
                    <a href="#" id = "capture" class="capturbutton">Take photo</a>
                    <canvas id = "canvas"  class = "canvas"></canvas>
                    <canvas id = "canvas2"  class = "canvas2" ></canvas>
                    <button onclick = "c_reset();">clear</button>
                </div>
                <div class ="stickers">
                    <p>stickers</p>
                    <table>
                        <td>
                            <img id ="sticker1" src ="sticker1.png" class = "stick" onClick = "stick('sticher1','1','1');">
                        </td> 
                        <td>
                            <img id ="sticker2" src ="sticker2.png" class = "stick" onClick = "stick('sticker2','10','10');">
                        </td>  
                        <td>
                            <img id ="sticker3" src ="sticker3.png" class = "stick"onClick = "stick('sticker3','20','20');">
                        </td> 
                        <td>
                            <img id ="sticker4" src ="sticker4.png" class = "stick" onClick = "stick('sticker4','30','30');" >
                        </td> 
                        <td>
                            <img id ="sticker5" src ="sticker5.png" class = "stick" onClick = "stick('sticker5','40','40');">
                        </td> 
                        <td>
                            <img id ="sticker6" src ="sticker6.png" class = "stick" onClick = "stick('sticker6','50','50');">
                        </td>  
                    </table>
                   
                </div>
                 <label for="filetoupload">Select image to upload:</label> 
                <input type="file" onchange = "mydrw(this);">
                <img id ="preview" class = "preview">
                <button onClick = "setImage();"> set image</button>
            </div>  
        </div>
    </body>
    <script src="camagru.js"></script>
</html>