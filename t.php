<?php

    session_start();
    require_once ("setup.php");
    require_once("config.php"); 



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
        
        if (strstr($stickers, "4")!= null) {
            list($width,$height) = getimagesize('sticker4.png');
            $b = imagecreatefrompng('sticker4.png');
            imagecopy($dest, $b,100,100,100,100, $width, $height);
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