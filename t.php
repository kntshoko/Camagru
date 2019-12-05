<?php

    session_start();
    require_once ("setup.php");
    require_once("config.php"); 

    $img = explode("*",$_POST['image']);

    $name = $_SESSION['login']['user_name'];

    $stickers = str_replace("sticker"," ",$img[1]);
    $stickers = trim($stickers);
    $stickers = preg_replace('/\s\s+/',' ', $stickers);
    $stickers= preg_replace("/\b(\w+)\s+\\1\b/i", "$1", $stickers);
    $stickers = explode(" ",$stickers);
    $stickers = array_unique($stickers);
    $stickers = join(" ",$stickers);
    $img = str_replace('data:image/png;base64,', '', $img[0]);
    $img = str_replace(' ', '+', $img[0]);
    $data = base64_decode($img[0]);
    $upload = imagecreatefromstring($data);
    $file = "camagru".uniqid().".png";
    $filedest = "uploads/".$file;
    imagepng($upload, $filedest);
    if ($stickers != null) 
    {   
        $dest = imagecreatefrompng($filedest);

        if (strstr($stickers, "1")!= null) {
            $b = imagecreatefrompng('sticker1.png');
            imagecopy($b,$d, 100,0,100,100, WIDTH, HEIGHT);
        }
        if (strstr($stickers, "2")!= null) {
            list($width,$height) = getimagesize('sticker2.png');
            $b = imagecreatefrompng('sticker2.png');
            imagecopy($b,$d, 100,0,100,100, $width, $height);
            header('Content-Type: image/png');
            imagepng($dest, $filedest);
        }
        
    }
    else
    {

    
        try
        {
            $sql = $conn->prepare("INSERT INTO `gallery`( `user_name`,`imagename`) VALUES(?,?)"); 
            $sql->execute([$name,$file]);
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    $conn = NULL;

?>