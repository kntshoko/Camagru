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
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{
                font-family: Arial, Helvetica, sans-serif;
            }
            form{
                text-align : center;
            }
            .cll {
            overflow: hidden;
            background-color: #333;
            }
            .cll a:hover{
            background-color: red;
            }
            .cll a {
            float: left;
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            }
            .cl label  
            {
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            }
            .foot label  
            {
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            }
            input[type=text], input[type=password]{
                width : 60%;
                padding : 12px 20px;
                margin : 8px 0;
                display : inline-block;
                border : 1px solid #ccc;
                box-sizing : border-box;
            }
            input[type=submit],  /*input[type=file]*/{ 
                width : 30%;
                padding : 10px 18px;
                margin : 8px 0;
                display : inline-block;
                border : 1px solid #ccc;
                box-sizing : border-box;
                color: white;
                background-color : #847ef7;
            }
            .imgcon{
                text-align :center;
                margin : 24px 0 12px 0;
            }
            img.limg{
                width : 40%;
                border : 1px solid #f1f1f1;
                border-radius : 50%;
            }
            .container{
                padding : 16px;
            }
            .cl{
            position :absolute;
            left : 30%;
            height : 60%;
            width : 40%;
        }
        .foot label  
            {
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            }
        .foot{
            position :absolute;
            top : 78%;
            height : 20%;
            width : 78%;
            padding : 0%;
            background-color: #333;
        }
        h2{
            color: white; 
            font-family: inherit;
        }
        .main
        {
            position :absolute;
            width: 78%;
            padding : 0%;
            height : 65%;
            background-color: #333;
        }
        .left{
            position :absolute;
            left : 80%;
            height : 86%;
            width : 20%;
            padding : 00%;
            background-color: #333;
        }
        .bd{
            position :absolute;
            width: 99%;
            height : 95%;
            top : 5%;
            display : inline-block;
        }
        .booth
        {
            position :absolute;
            width: 87%;
            height: 87%;
            background-color: #ccc;
            border: 10px solid #ddd;
            /* margin: 0 auto; */
            position: absolute
        }
        .capturbutton{
            display :block;
            margin : 10px 0;
            padding : 10px 20px;
            background-color : cornflowerblue;
            color : #fff;
            text-align : center;
            text-decoration : none; 
        }
        .video, .canvas{
            display :block;
            margin : auto;
            width :50%;
             height : 40%; 
        }
        /* {
            margin :auto;
            width :30%;
             height :30%; 
        } */
        </style>
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