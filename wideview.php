<?php
    session_start();
    if(!$_SESSION['login'])
    {
        header('Location: logedin.php');
        exit();
    }
    require_once ("config/setup.php");
    require_once("config/database.php");
    $username = $_SESSION['login']['user_name'];

    $imgname = $_GET['imgname'];
    $imgid = $_GET['imgid'];



    if(isset($_POST['submit']))
    { 
        if($_POST['comment'])
        {
            $comment = $_POST['comment'];
            try
            {
                $sql = $conn->prepare("INSERT INTO comments ( `user_name`, `imageid`,`comment`) VALUES (?,?,?)");
                $sql->execute([$username,$imgid,htmlspecialchars($comment)]);
                $sql =$conn->prepare("SELECT * FROM `gallery` WHERE `imageid` = $imgid ");
                $sql->execute();
                $row = $sql->fetch();
                if(!empty($row))
                {
                    $use = $row['user_name'];
                    $sql =$conn->prepare("SELECT * FROM `users` WHERE `user_name` = ?");
                    $sql->execute([$use]);  
                    $result = $sql->fetch();
                    if($result['notification'] == 1)
                    {
                        $to = $result['email'];
                        $subject = "CAMAGRU comment on image ";
                        $message = "<br><br><h1>$username</h1><p>$comment</p><br><br>click on the link below<br><a href ='http://localhost:8081/Camagru/'>login to Camagru</a>";
                        $headers = 'From: nonreply'."\r\n";
                        $headers .= "MIME-Version: 1.0"."\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
                        mail($to,$subject,$message,$headers);
                    }
                }
            }
            catch(PDOException $e)
            {
            echo "<br> failer ==" . $e->getMessage();
            }
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
        <div class = "navbar">
            <a href="logedin.php">Go To Home</a>
             <div class="dropdown">
            <button class="setbtn">SETTINGS</button>
            <div class="dropcontainer">
                <a href="changepassword.php">change password</a>
                <a href="preferences.php">preferences</a>
                <a href="deleteaccount.php">Delete account</a>
            </div>
        </div> 
            <a href="logout.php">LOGOUT</a>
        </div>      
        <h1>
            CAMAGRU
        </h1>
 <div class = "main">

        <form action="wideview.php?imgid=<?php echo $imgid?>&imgname=<?php echo  $imgname?>" method ="post"  class = 'commentform'>
        
        <div class="imagecontainer">
                 <img src="uploads/<?php echo $imgname?>" alt = "pimg" class ="postimage">
             </div>   
             <div class = "commentcontainer">
                <label for="comment"> send comment : </label> 
                <br>
                <input type="text" name = "comment" />
                <br>
                <input type="submit" name = "submit" value = "comment"/>
                <br><br>
            </div>
            <table>
                <?php
        try
        {
            $sql = $conn->prepare("SELECT * FROM `comments` WHERE `imageid` = $imgid") ;
            $sql->execute(); 
            $result = $sql->fetchall();
            foreach ($result as $key)
            {
                echo "<tr>";
                    echo "<td>";
                        echo $key['user_name'];
                    echo "</td>";
                    echo "<td>";
                        echo $key['comment'];
                    echo "</td>";
                echo "</tr>";
            }

        }
            catch(PDOException $e)
        {
            echo "<br> failer ==" . $e->getMessage();
        }
                ?>
        </table>
        </form>   
     </div>  
</body>
</html>