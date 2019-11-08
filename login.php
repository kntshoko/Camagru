<html>
    <head>
        <style>
            body{
                text-align : center;
                font-family : Arial, Helvetica, sans-serif;
                background-color: rgb(250,200,150) ;
            }
            form{
                border : 3px solid #f1f1f1;
                background-color: white;
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
        </style>
    </head>
    <body>
    <h1 align = center>
            CAMAGRU
    </h1>
    <div class = "cl">

            <h2>
                LOGIN FORM
            </h2>
            <form action="index.php" methord ="post">
                 <div class="imgcon">
                 <img src="image.png" alt = "limg" class ="limg">
                 </div>   
                 <div class = "con">
                        User Name:<br> <input type="text" name = "user_name"/><br><br>
                        Password:<br> <input type="password" name = "password"/><br><br> 
                        <input type="submit" name = "Submit" value = "LOGIN"/>
                 </div>
                 <div class = "con">
                   <a href="registration.php">Register Account</a>
                   <a href="registration.php">Forgot Password</a>
                 </div>
            </form>
      </div>      
    </body>
</html>
<?php
?>