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
            .foot label  
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
        .foot{
            position :absolute;
            top : 80%;
            height : 20%;
            width : 60%;
            padding :5%;
        }
        h2{
            color: white; 
            font-family: inherit;
        }
        .main
        {
            position :absolute;
            top: 20%;
            width: 60%;
            padding : 5%;
            height : 50%;
            background-color: #333;
        }
        </style>
    </head>
    <body>
        <div class = "cll">
            <a href="index.php">Go To Welcome</a>
        </div>      
        <h1 align = center>
            CAMAGRU
        </h1>
        <div class = "main">
        </div>
            <div class = "foot">
                <form action="upload.php" method ="post" enctype = "multipart/form-data">
                    Select image to upload:
                    <input type="file" name = "filetoupload" id = "filetoupload>">
                    <input type="submit" value = "upload image">
                </form>    
            </div>      
    </body>
</html>
