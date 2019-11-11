<?php
        $email = $_GET['email'];
        $token = $_GET['token'];
        $username = $_GET['username'];
        echo $username;
        echo "n1<br>";
        require_once("config.php");
        echo "n2<br>";
        $sql = $conn->prepare("SELECT * FROM `users` WHERE `email` = '$email' AND `token` = '$token' limit 1");
        echo "n3<br>";
        //$sql->execute([$username,$email,$token]);
        $sql->execute();
        echo "n4<br>";
        $row = $sql->fetch();
        echo "n5<br>".$row;
        if (empty($row) == true)
        {
            echo "n100";
        }
        else
        {
            echo "n6<br>";
            $sql = $conn->prepare("UPDATE users SET account = ?  WHERE `email` = '$email' AND token = '$token'");
            echo "n7<br>";
            $sql->execute([1]); 
            echo "n8<br>";
            $sql = $conn->prepare("UPDATE users SET token = ?  WHERE `email` = '$email' AND  token = '$token'");
            echo "n9<br>";
            $sql->execute([""]); 
            echo "n10<br>"; 
            echo "n11<br>";
            $sql = $conn->prepare("SELECT id FROM users WHERE `email` = '$email' AND `account` = 1 LIMIT 1");
            echo "n12<br>";
            $sql->execute();
            echo "n13<br>";
            $row = $sql->fetch();
            echo "n14<br>";
            if (empty($row) != true)
            {
                echo "n15<br>";
            }
            else
            {
                //header('Location: login.php');
                //exit();
                echo "n17<br>";
            }
            echo "n18<br>";
            
        } $conn = NULL;
?>
