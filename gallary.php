
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
                    <label for="filetoupload">Select image to upload:</label> 
 
                </div>
                <input type="file" onchange = "mydrw(this);">
                <img id ="preview" class = "preview">
                <button onClick = "setImage();"> set image</button>
            </div>  
        </div>
    </body>
    <script src="camagru.js"></script>
</html>