
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
        <div class = "cl">
            <a href="logedin.php">Go To Welcome</a>
        </div>         
        <div class = "bd">     
            <h1 align = center>
                CAMAGRU
            </h1>
            <div class = "main">
                <button type="button" onclick="myfunction()">enable webcam</button>
                <button type="button" id = "upload" class="upload">upload</button>
                <div class="booth">
                    <?php
                        if ($filedest != null)
                        {
                            echo $filedest;
                        } 
                    ?>
                    <video id="video"  class = "video"></video>
                    <canvas id = "canvas"  class = "canvas"></canvas>
                    <a href="#" id = "capture" class="capturbutton">Take photo</a>
                </div>
            </div>
            <div class = "foot">
                <label for="filetoupload">Select image to upload:</label> 
                <input type="file" onchange = "mydrw(this);">
                <img id ="preview">
                <button onClick = "setImage();"> set image</button>
            </div>  
            <div class="left">
            </div> 
        </div>
    </body>
    <script src="camagru.js"></script>
</html>