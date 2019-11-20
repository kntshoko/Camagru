
<html>
    <head>
        <title>Document</title>
        <style>
             body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .cl {
            overflow: hidden;
            background-color: #333;
        }

        .cl a {
            float: left;
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .drop {
            float: left;
            overflow: hidden;
        }

        .drop .setbtn {
            font-size: 16px;  
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }

        .cl a:hover, .drop:hover .setbtn {
            background-color: red;
        }

        .cont {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .cont a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .cont a:hover {
             background-color: #ddd;
        }

        .drop:hover .cont {
            display: block;
        }
        .main
        {
            top: 40%;
            width: 90%;
            padding : 5%;
            height : 60%;
            background-color: #333;
        }
        .imgs{
            width : 100%;
            height : auto;
            position : absolute;
            border : 4px yellow;
        }
        .img
        {
            display : block;
            position : absolute;
            width : 100%;
            height : auto;
        }
        .img1{
             display : inline-block;
             float : left;
             
        }
        table{
            position : absolute;
        }
        img{
            /* position : absolute; */
            width : 40%;
            height : 30%;
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
                            foreach ($result as $row) {
                                echo "<td>";
                                    ?>
                                        <img src="
                                            <?php
                                                echo "uploads/".$row['imagename'];
                                            ?>" 
                                        alt="">
                                    <?php
                                echo "</td>";
                            }
                        echo "</tr>";
                    echo "</table>";
                ?>
            </div>
            <div class = "controls">

            </div>
        </div>
    </body>
</html>