<?php
 session_start();
 require_once ("setup.php");
 require_once("config.php");
 
  $img = $_POST['img'];
 $name = $_SESSION['login'];
 //var_dump($name);

 $img = str_replace('data:image/png;base64,', '', $img);
 $img = str_replace(' ', '+', $img);
 $data = base64_decode($img);
 $upload = imagecreatefromstring($data);
 $file = "camagru".uniqid().".png";
 $filedest = "uploads/".$file;
 $success = imagepng($upload, $filedest);
 
 try{
     echo "s";
    // $servername = "localhost";
    // $username = "root";
    // $password = "123456";
    // $conn = new PDO("mysql:host=$servername", $username, $password);
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    try{
    $sql = $conn->prepare("INSERT INTO `gallery`( `user_name`,`imagename`) VALUES(?,?)"); 
    var_dump($sql);
    var_dump("t");
    $sql->execute(["erty",$file]);
    } catch (PDOException $e){
        echo $e->getMessage();
    }
    // $pdo = "INSERT INTO `gallery`( `user_name`,`imagename`) VALUES(?,?)";
    
    // $stmt = $conn->prepare($pdo);
    // echo "6";
    // // var_dump($stmt);
    // $results = $stmt->execute([$name,$file]);
    // echo "sdguguig";
    // var_dump($results);
    // if($results === TRUE){
    //     echo "yeah";
    // }else{
    //     echo "not";
    //}

    }catch(PDOExceptipn $e){
        echo $sql ."<br>". $e->getMessage();
    }

// if (isset($_POST['image']))
//     {
//         $filteredData = str_replace("data:image/png;base64,", "", $_POST['image']);
//         $filteredData = str_replace(" ", "+", $filteredData);
//         $unencodedData=base64_decode($filteredData);
//         $image_name = "34" . ".".uniqid("", true). '.png';
//         file_put_contents('uploads/'.$image_name, $unencodedData);
//          try{

//     $pdo = "INSERT INTO `gallery`( `user_name`,`imagename`) VALUES(?,?)";
    
//     $stmt = $conn->prepare($pdo);
//     $results = $stmt->execute([$name,$file]);
    
//     if($results === TRUE){
//         echo "yeah";
//     }else{
//         echo "not";
//     }

//  }catch(PDOExecption $e){
//      echo $e->getMessage();

//  }
//         super_impose("uploads/".$image_name,"uploads/".$image_name,"uploads/".$_POST['image']);
//         echo "image success";
//     }
//     function super_impose($src,$dest,$added)
//     {
//         $base = imagecreatefrompng($src);
        
//         echo "<br>".$src."<br>";
//         //echo $added;
//         $superpose = imagecreatefrompng($added);
//         list($width, $height) = getimagesize($src);
//         list($width_small, $height_small) = getimagesize($added);
//         imagecopyresampled($base , $superpose,  0, 0, 0, 0, 100, 100,$width_small, $height_small);
//         echo $base;
//         imagepng($base , $dest);
//     }


?>