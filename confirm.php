<?php
    if (isset($_POST['submit']))
    { 
        $email = $_GET['email'];
        $token = $_GET['token'];
        $username = $_GET['username'];
        require_once("config.php");
        $sql = $conn->prepare("UPDATE users SET account = ?  WHERE `email` = '$email' AND `user_name` = '$username' AND token = '$token'");
        $sql->execute([1]); 
        $conn = NULL;
    }
?>
<html>
<head>
    <title>confirm</title>
    <style>
        .cl
        {
            position :absolute;
            left : 30%;
            height : 60%;
            width : 40%;
        }
        body
        {
                text-align : center;
                font-family : Arial, Helvetica, sans-serif;
                background-color: rgb(250,200,150) ;
        }
        form
        {
                border : 3px solid #f1f1f1;
                background-color: white;
        }
    </style>
</head>
<body>
<h1 align = center>
            CAMAGRU
    </h1>
    <div class = "cl">
            <h2>
                confirm
            </h2>
            <form action="index.php" methord ="post">   
                 <div class = "con"> 
                        <input type="submit" name = "Submit" value = "CONFIRM"/>
                 </div>
            </form>
      </div>      
</body>
</html>