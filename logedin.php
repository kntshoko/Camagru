<?php
    if (session_id() == '')
    {
        header('Location: index.php');
        exit();
    }
?>
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
    </style>
</head>
<body>
    <div class="cl">
        <a href="#">GALLARY</a>
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
        stuffffffffffffa
    </div>
</body>
</html>