html>
<head>
    <title>Document</title>
</head>
<body>
    <form action="gallary.php" method ="post" enctype = "multipart/form-data">
    Select image to upload:
    <input type="file" name = "filetoupload" id = "filetoupload>">
    <input type="submit" value = "upload image">
    </form>    
</body>
</html>

<?php
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["filetoupload"]["name"]);
    $uploadOK = 1;
    $imagefiletype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(isset($_POST['submit']))
    {
        $check = getimagesize($_FILES["filetoupload"]["tmp_name"]);
        if($check !== false)
        {
            echo "file is an image." . $check["mime"] . ".";
            $uploadOK = 1;
        }
        else
        {
            echo "file is not an image";
            $uploadOK = 0;
        }
    }
    if (file_exists($target_file))
    {
        echo "file already exists.";
        $uploadOk = 0;
    }
    if ($imagefiletype != "jpg" && $imagefiletype != "png" && $imagefiletype != "jpeg" )
    {
        echo "only jpg, jepeg and png files allowed";
        $uploadOK = 0;
    }
    if ($_FILES["filetoupload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0)
    {
        echo "Sorry, your file was not uploaded.";
    } 
    else 
    {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
        {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        }
        else
        {
            echo "Sorry, there was an error uploading your file.";
        }
    }
?>