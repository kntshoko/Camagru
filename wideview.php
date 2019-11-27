<?php
session_start();
require_once ("setup.php");
require_once("config.php"); 
$username = $_SESSION['login'];

    $imgname = $_GET['imgname'];
    $imgid = $_GET['imgid'];

    try
    {
        $sql = $conn->prepare("SELECT * FROM `comments` WHERE imageid = ?") ;
        $sql->execute($imgid); 
        $result = $sql->fetchall();
        echo "<table>";
        foreach ($result as $key) {
            echo "<tr>";
                echo "<td>";
                    echo $key['user_name'];
                echo "</td>";
                echo "<td>";
                    echo $key['comment'];
                echo "</td>";
            echo "</tr>";
        }
        echo "</table>";

    }
        catch(PDOException $e)
    {
        echo "<br> failer ==" . $e->getMessage();
    }

    if(isset($_POST['submit']))
    { 
        if($_POST['comment'])
        {
            $comment = $_POST['comment'];
            try
            {
                $sql = $conn->prepare("INSERT INTO comments ( `user_name`, `imageid`,`comment`) VALUES (?,?,?)");
                $sql->execute([$username,$imgid,$comment]);
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
    <style>
            body{
                font-family: Arial, Helvetica, sans-serif;
            }
            form{
                background-color: #333;
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

            input[type=text], input[type=password]{
                width : 60%;
                padding : 12px 20px;
                margin : 8px 0;
                display : inline-block;
                border : 1px solid #ccc;
                box-sizing : border-box;
            }
            input[type=submit]{
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
            img .limg{
                width : 40%;
                border : 1px solid #f1f1f1;
                border-radius : 50%;
            }
            .con{
                padding : 16px;
            }
            .cl{
            position :absolute;
            left : 30%;
            height : 60%;
            width : 40%;
        }
        h2{
            color: white; 
            font-family: inherit;
        }
        table{
            color : white;
        }
        </style>
</head>
<body>
<div class = "cll">
            <a href="logedin.php">Go To Home</a>
        </div>      
    <h1 align = center>
            CAMAGRU
    </h1>
<div class = "cl">
        
        <form action="wideview.php?imgid=<?php echo $imgid?>&imgname=<?php echo  $imgname?>" method ="post">
        <h2>commentes</h2>
        <div class="imgcon">
                 <img src="uploads/<?php echo $imgname?>" alt = "limg" class ="limg">
             </div>   
             <h2> 
                <?php 
                    if($mg != "")
                 echo $mg . "<br>";
                 ?>
            </h2>
             <div class = "con">
                <label for="newpassword"> send : </label> 
                <br>
                <input type="text" name = "comment" />
                <br><br>
                <br>
                <input type="submit" name = "submit" value = "comment"/>
                <br><br>
            </div>
            <table>
            <?php
            

            ?>
        </table>
        </form>
       
  </div>      
</body>
</html>