<?php

    session_start();
    require_once ("config/setup.php");
    require_once("config/database.php");



    $i = explode("*",$_POST['image']);
    $img = $i;
    
   
    $name = $_SESSION['login']['user_name'];

    $i = $i[1];
    $stickers = str_replace("sticker"," ",$i);
    $stickers = trim($stickers);
    $stickers = preg_replace('/\s\s+/',' ', $stickers);
    $stickers= preg_replace("/\b(\w+)\s+\\1\b/i", "$1", $stickers);
    $stickers = explode(" ",$stickers);
    $stickers = array_unique($stickers);
    $stickers = join(" ",$stickers);

    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img[0]);
    $upload = imagecreatefromstring($data);
    $file = "camagru".uniqid().".png";
    $filedest = "uploads/".$file;
    $success = imagepng($upload, "uploads/".$file);



        $dest = imagecreatefrompng("uploads/".$file);
        
        if (strstr($stickers, "1")!= null) {
            list($width,$height) = getimagesize('sticker1.png');
            $b = imagecreatefrompng('sticker1.png');
            imagecopy($dest, $b,0,0,0,0, $width, $height);
            header('Content-Type: image/png');
            imagepng($dest, "uploads/".$file);
        }    
        if (strstr($stickers, "2")!= null) {
            list($width,$height) = getimagesize('sticker2.png');
            $b = imagecreatefrompng('sticker2.png');
            imagecopy($dest, $b,10,10,0,0, 200, 200);
            header('Content-Type: image/png');
            imagepng($dest, "uploads/".$file);
        }    
        if (strstr($stickers, "3")!= null) {
            list($width,$height) = getimagesize('sticker3.png');
            $b = imagecreatefrompng('sticker3.png');
            imagecopy($dest, $b,20,20,0,0, 200, 200);
            header('Content-Type: image/png');
            imagepng($dest, "uploads/".$file);
        }    
        if (strstr($stickers, "4")!= null) {
            list($width,$height) = getimagesize('sticker4.png');
            $b = imagecreatefrompng('sticker4.png');
            imagecopy($dest, $b,30,30,100,100, 200, 200);
            header('Content-Type: image/png');
            imagepng($dest, "uploads/".$file);
        }    
        if (strstr($stickers, "5")!= null) {
            list($width,$height) = getimagesize('sticker5.png');
            $b = imagecreatefrompng('sticker5.png');
            imagecopy($dest, $b,40,40,0,0, 200, 200);
            header('Content-Type: image/png');
            imagepng($dest, "uploads/".$file);
        }    
        if (strstr($stickers, "6")!= null) {
            list($width,$height) = getimagesize('sticker6.png');
            $b = imagecreatefrompng('sticker6.png');
            imagecopy($dest, $b,50,50,0,0, 200, 200);
            header('Content-Type: image/png');
            imagepng($dest, "uploads/".$file);
        }    

        try
        {
            if($stickers != null)
            {
                $sql = $conn->prepare("INSERT INTO `gallery`( `user_name`,`imagename`,`edited`) VALUES(?,?,1)");
            }
            else
            {
                $sql = $conn->prepare("INSERT INTO `gallery`( `user_name`,`imagename`) VALUES(?,?)");
            }
  
            $sql->execute([$name,$file]);
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    
    $conn = NULL;

?>