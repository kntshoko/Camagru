
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

            <a href="#">My Pictures</a>
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
            <p id = "demo"></p>     
        <div class = "main">     
            
            <div class = "gallery">
                <button  onclick="myfunction()">enable webcam</button>
                <button  onclick="upload()" id = "upload" class="upload">upload</button>
                <div class="booth">
                    <video id="video"  class = "video"></video>
                    <a href="#" id = "capture" class="capturbutton">Take photo</a>
                    <canvas id = "canvas"  class = "canvas"></canvas>
                </div>
                <div class ="stickers">
                    <p>stickers</p>
                    <table>
                        <td>
                            <img id ="sticker1" src ="sticker1.png" class = "stick">
                            <button onClick = "stick1();"> set image</button>
                        </td> 
                        <td>
                            <img id ="sticker2" src ="sticker2.jpeg" class = "stick" >
                            <button onClick = "stick2();"> sticker2</button>
                        </td> 
                        <td>
                            <img id ="sticker3" src ="sticker3.jpeg" class = "stick" ">
                            <button onClick = "stick3();"> sticker3</button>
                        </td> 
                        <td>
                            <img id ="sticker4" src ="sticker4.png" class = "stick" >
                            <button onClick = "stick4();"> sticker4</button>
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