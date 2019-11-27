<?php

session_start();
if(!$_SESSION['login'])
{
        header('Location: index.php');
        exit();
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
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        form
        {
                background-color: #333;
                text-align : center;
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
        table{
            padding : none;
            position : absolute;
           width : 50%;
            height : 40%;
        }
        img{
            /* position : absolute; */
            /* width : 40%; */
            /* height : 30%; */
        }
        button{
            display: block;
            /* position : absolute; */
        }
    </style>
</head>
<body>
    <div class="cl">
        <a href="gallary.php">GALLARY</a>
        <div class="drop">
            <button class="setbtn">SETTINGS</button>
            <div class="cont">
                <a href="changepassword.php">change password</a>
                <a href="preferences.php">preferences</a>
                <a href="deleteaccount.php">Delete account</a>
            </div>
        </div> 
        <a href="logout.php">LOGOUT</a>
    </div>  
    <h1 align = center>
            CAMAGRU
    </h1>   
    <div class = "main">
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
                       
                        $i = 0;
                       // while ($i < 4){
                            foreach ($result as $row) {
                                 echo "<tr>";
                                echo "<td>";
                                    ?>
                                        <img src="
                                            <?php
                                                echo "uploads/".$row['imagename'];
                                            ?>" 
                                        alt="">
                                        <button type="button" value = "<?php echo $row['imageid']?>" id ="mylikes<?php echo $row['imageid']?>" onclick="mylikes('<?php echo 'mylikes'.$row['imageid']?>');"> likes</button>
                                        <button type="button" onclick="window.location.href = 'wideview.php?imgid=<?php echo $row['imageid']?>&imgname=<?php echo $row['imagename']?>';"> comments</button>
                                    <?php
                                echo "</td>";
                                echo "</tr>";
                         //  $i++;
                         }
                        
                    echo "</table>";
                ?>
    </div>
    <script>

    
function mylikes(id) {
  var xhttp = new XMLHttpRequest();
    var x =  document.getElementById(id)

  xhttp.open("POST", "likes.php", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  console.log(x.value);
  xhttp.send("value="+x.value);
}


            /////check same as the one above

    /*        document.getElementById("upload").addEventListener("click", function() {
    var canvas = document.getElementById("canvas");
    var dataURL = canvas.toDataURL("image/png");
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        console.log(xhr.status, xhr.responseText);
    };
    
    xhr.open('POST', 't.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("image="+dataURL);
    // 
    }*/

            ////
    </script>
</body>
</html>