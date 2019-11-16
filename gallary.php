
<?php
if(isset($_POST['submit'])){
   // session_start();
   // include_once ('config/setup.php');
    //include_once ('config/database.php');
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
                echo $file;
     /*           try{
                $sql = "INSERT INTO `camagru`.`gallery` (`name`,comments, images) VALUES (?,?,?)";
                var_dump($sql);
                $stmt = $conn->prepare($sql);
                
                $stmt->execute([$name,'', $newname]);
                 move_uploaded_file($fileTemp, $filedest);
                 header("location: home.php");
                }catch(PDOException $e){
                    echo $e->getMessage();
                }*/
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
            input[type=submit], input[type=file]{
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
        </style>
    </head>
    <body>
        <div class = "cll">
            <a href="index.php">Go To Welcome</a>
        </div>         
        <div class = "bd">     
            <h1 align = center>
                CAMAGRU
            </h1>
                <div class = "main">
                </div>
                <div class = "foot">
                    <form action="upload.php" method ="post" enctype = "multipart/form-data">
                       <label for="filetoupload">Select image to upload:</label> 
                        <input type="file" name = "filetoupload" id = "filetoupload>">
                        <input type="submit" value = "upload image">
                    </form>    
                </div>  
                <div class="left">
                </div> 
        </div>
    </body>
</html>