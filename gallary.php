<?php
$filedest = "";
if(isset($_POST['submit'])){
    session_start();
    $name = $_SESSION['login'];
    $file = $_FILES['file'];
    $filename = $_FILES['file']['name'];
    $fileTemp = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];  
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
     $fileExt = explode('.', $filename);
     $fileActExt = strtolower(end($fileExt));
     $allowed = array('jpg','jpeg','png','gif');
     if (in_array($fileActExt, $allowed)){
        if($fileError === 0){
             if($fileSize < 10000000){
                $newname = uniqid('', true).".".$fileActExt;
                $filedest = 'uploads/'.$newname;
                
             }else{
                 echo "FILE IS TO LAREG";
             }
         }else{
             echo "Error uploading";
         }
     }else{
         echo "You uploaded wrong file type";
    }
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
        <div class = "cll">
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
    <script>
     var canvas = document.getElementById('canvas');
                var context = canvas.getContext('2d');
    function myfunction()
{
    // var video = document.getElementById('video');
    // var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    //var vendorUrl = window.URL || window.webkitURL;

    navigator.getMedia =  navigator.getUserMedia ||
                          navigator.webkitGetUserMedia||
                          navigator.mozGetUserMedia||
                          navigator.msGetUserMedia;
    
    navigator.getMedia(
        {
            video : true,
            audio : false
        },
        function(stream)
        {
            video.srcObject = stream;
            video.play();
        },
        function(error)
        {

        }
    );


    document.getElementById('capture').addEventListener('click',function()
    {
        canvas.width = video.clientWidth;
        canvas.height = video.clientWidth;
        context.drawImage(video, 0,0);
    })

    document.getElementById("upload").addEventListener("click", function() {
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
    });
    }

    document.getElementById('capture').addEventListener('click',function()
    {
        canvas.width = video.clientWidth;
        canvas.height = video.clientWidth;
        context.drawImage(video, 0,0);
    })

    document.getElementById("upload").addEventListener("click", function() {
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
    });



                // var canvas = document.getElementById('canvas');
                // var context = canvas.getContext('2d');


                            function mydrw(input)
            {
            var reader = new FileReader();
            reader.onload = function (e){
            document.getElementById("preview").setAttribute("src",e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            }
            function setImage()
            {
            var image = document.getElementById("preview");
            context.drawImage(image,0,0);
            }






    </script>
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
</html>