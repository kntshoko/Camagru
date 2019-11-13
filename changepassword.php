
<?php
    
    $mg = "";
    if (session_id() == '')
    {
        header('Location: index.php');
        exit();
    }
    else
    {
            if (isset($_POST['submit']))
        {
            require_once("config.php");
            $sql = $conn->prepare("SELECT id FROM users WHERE `password`= ? LIMIT 1");
            $sql->execute(md5($_POST['currentpassword']));
            $row = $sql->fetch();
            if (empty($row) != true)
            {
                if ( $_POST['conpassword'] == null || $_POST['newpassword'] == null)
                {
                    $mg = "check your input";
                }
                else
                {
                    if ($_POST['conpassword'] == $_POST['newpassword'])
                    {
                        $email = $_SESSION['email'];
                        $password = $_SESSION['password'];
                        $sql = $conn->prepare("UPDATE users SET `password` = ?  WHERE `password` = '$password' AND `email` = '$email'");
                        $sql->execute([md5($_GET['conpassword'])]); 
                        $sql = $conn->prepare("UPDATE users SET token = ?  WHERE `email` = '$email'");
                        $sql->execute([""]); 
                        $_SESSION['password'] = md5($_GET['conpassword']);
                        header('Location: logedin.php');
                        exit();
                    }
                    else
                    {
                        $mg = "Passsword do not match";
                    }
                } 
                $conn = NULL;
            }
            else
            {
                $mg = "Passsword do not match";
            }
        }
    }

?>


<html>
    <head>
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
        h2{
            color: white; 
            font-family: inherit;
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
        
            <form action="changepassword.php" method ="post">
            <h2>CHANGE PASSWORD FORM</h2>
            <div class="imgcon">
                     <img src="image.png" alt = "limg" class ="limg">
                 </div>   
                 <h2> 
                    <?php 
                        if($mg != "")
                     echo $mg . "<br>";
                     ?>
                </h2>
                 <div class = "con">
                    <label for="password">Current Password:  </label>  
                    <br>
                    <input type="password" name = "currentpassword" />
                    <br><br>
                    <label for="newpassword"> New Password : </label> 
                    <br>
                    <input type="password" name = "newpassword" />
                    <br><br>
                    <label for="conpassword">Confirm New Password :  </label>   
                    <br>
                    <input type="password" name = "conpassword" />
                    <br><br>
                    <br>
                    <input type="submit" name = "submit" value = "register"/>
                    <br><br>
                </div>
            </form>
      </div>      
    </body>
</html>