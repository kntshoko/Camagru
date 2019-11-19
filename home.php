<html>
<head>
    <style>
        body{
            /* background-color: rgb(250,200,150) ; */
        }
    </style>
</head>
<body>
<?php
    echo "yyyyy";
                //require "setup.php";
                require_once ("setup.php");
                require_once("config.php");

                try
                {
                    $sql = $conn->prepare("SELECT * FROM `gallery` "); 
                    
                    $sql->execute();
                    // $result = $sql->fetch(PDO::FETCH_ASSOC)
                    var_dump($sql);
                while ($row = $sql->fetch(PDO::FETCH_ASSOC))
                {
                    echo '<A href= "#">
                    <DIV class="gallery-image" style= "background-image: url(uploads/'.$row['image_name'].');" width = 300 height = 300 ></DIV></A>
                    <h2>'.$row['image_uploader_name'].'</h2>
                    <p> '.$row['image_caption'].'<p>
                    ';    
                }
                }   
                catch(PDOExceptipn $e)
                {
                    echo $e->getMessage();
                }
  
                
            ?>
</body>
</html>