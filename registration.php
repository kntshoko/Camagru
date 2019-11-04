<HTML>
    <HEAD>
        <STYLE>
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
                margin : 22px 0 12px 0;
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
        </STYLE>
    </HEAD>
    <BODY>      
        <h1 align = center>
            CAMAGRU
    </h1>
    <div class = "cl">
            <h2>
                REGISTRATION FORM
            </h2>
            <form action="registration.php" method ="post">
                 <div class="imgcon">
                     <img src="image.png" alt = "limg" class ="limg">
                 </div>   
                 <?php 
                    if($mg != "")
                    echo $mg . "<br>";
                ?>
                 <div class = "con">
                    First Name : <br>
                    <input type="text" name = "firstname" />
                    <br><br>
                    Last Name : 
                    <br>
                    <input type="text" name = "lastname" />
                    <br><br>
                    User Name : 
                    <br>
                    <input type="text" name = "username" />
                    <br><br>
                    Email Address: 
                    <br>
                    <input type="text" name = "email" />
                    <br><br>
                    Password : 
                    <br>
                    <input type="password" name = "password" />
                    <br><br>
                    comform Password : 
                    <br>
                    <input type="password" name = "compassword" />
                    <br><br>
                    <br>
                    <input type="submit" name = "submit" value = "register"/>
                    <br><br>
                </div>
            </form> 
            </div>
    </BODY>
</HTML>
<?php
    $mg = "";
    if (isset($_POST['submit']))
    {
        require_once("config.php"); 
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $compasword = $_POST['compassword'];
        if ($firstname == "" || $lastname == "" || $email == "" || $username == "" || $compasword != $password)
            $mg = "check your inputs";
            else{
                $sql = $conn->prepare("SELECT id FROM users WHERE `user_name`= $username LIMIT 1");
                $sql->execute([1]);
                //$row = $sql->fetch();
                if ($sql->num_rows > 0)
                {
                    $mg = "username already exists";
                }
                else{
                    
                }
            }
                
                $sql = $conn->prepare("INSERT INTO users (`firstname`,`lastname`,`user_name`,`email`,`password`) 
                VALUES (?,?,?,?,?)"); 
                $sql->execute([$firstname,$lastname,$username,$email,$password]);
                $conn = NULL;
    }
?>