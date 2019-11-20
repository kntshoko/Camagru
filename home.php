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
        img{
            width : 400px;
            height : 300px;
        }
        </style>
    </head>
    <body>
    <div class = "cl">
            <a href="login.php">Login</a>
            <a href="registration.php">Register Account</a>
        </div>      
            <h1 align = center>
                CAMAGRU
            </h1>   
        <div class = "main">
            <div class = "imgs">
                <?php                         
                    require_once ("setup.php");
                    require_once("config.php");   
                        
                    try{
                            $sql = $conn->prepare("SELECT * FROM gallery") ;
                            $sql->execute(); 
                            $result = $sql->fetchall();
                    }
                    catch(PDOExceptipn $e)
                    {
                    echo $e->getMessage();
                    }  
                    echo "<table>";
                        echo "<tr>";
                            //? foreach ($result as $row) {
                                 echo "<td>";
                                     ?>
                                        <img src="
                                             <?php
                                                echo "uploads/".$result[1]['imagename'];
                            //                 ?>" 
                                         alt="">
                                     <?php
                            //     echo "</td>";
                            // }
                        echo "</tr>";
                    echo "</table>";
                ?>
            </div>
            <div class = "controls">

            </div>
        </div>
    </body>
</html>


function mydrw(input)
            {
            var reader = new FileReader();
            reader.onload = Function(e){
            document.getElementById("preview").setAttribute("src",e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            }
            function setImage()
            {
            var image = document.getElementById("preview");
            context.drawImage(image,0,0);
            }




            <div class = "foot">

                    <label for="filetoupload">Select image to upload:</label> 
                    <input type="file" onChange = "mydrw(this);">
                    <img id ="preview">
                    <button onClick = "settImage();"> set image</button>
                </div>  