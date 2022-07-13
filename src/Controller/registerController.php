<?php
    require("redirect.php");
    if(directVisit()){
        header("Location: ../ex1.php");
    }

    function compareLower($str1, $str2){
        if(strtolower($str1)==strtolower($str2)){
            return true;
        }
        return false;
    }

    $pattern = "/\W/";
    $passwordPattern = "/[\s]/";
    if(isset($_POST)){
        $username = $_POST["user"];
        $password = $_POST["pass"];
        $email = $_POST["email"];
        $sex = $_POST["sex"];

        if(preg_match($pattern, $username) || preg_match($passwordPattern, $password)){
            header("Location: /register.php");
            die();
        }

        if(!empty($username)){
            include("collectingData.php");
            $db = new ConnectDB('accounts');
            
            if($db->userExists($username)){
                $db->close();
                header("Location: exists.php");
                die();
            } else {
                
                $name = explode(".", $_FILES["profile"]['name']);
                foreach($name as $key => $part) {
                    if(count($name)-1 == $key) {
                        $name = $username.".".$part;
                        break;
                    }
                }
                $_FILES["profile"]['name'] = $name;

                $target_file = "../Assets/".basename($_FILES["profile"]['name']);


                if(
                    !(
                        move_uploaded_file($_FILES["profile"]['tmp_name'], $target_file)
                    )
                ){
                    header("Location: ../register.php");
                    die();
                };

                $db->insertALL($username, hashPassword($password), $email, $sex, $target_file);
                $db->setCookieTo($username, $_COOKIE['token']);
                $db->close();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>After Registration</title>
</head>

<style>
    body, html {
        overflow-y: hidden;
        overflow-x: hidden;
        height: 100%;
        background: #000;
        margin: 0;
    }
    div.name {
        transition: .4s;
        margin-left: auto;
        margin-right: auto;
        color: white;
        font-size: 9vw;
        letter-spacing: .5vw;
        width: 98%;
        text-align: center;
        background: rgb(31, 31, 31);
        border: 1px solid rgb(111, 111, 111);
        border-radius: 5px;
    }
    div.name:hover {
        transform: translateX(-150%);
    }
    h1 {
        font-size: 3vw;
        text-align: center;
        margin-top: 14%;
        margin-bottom: 1%;
        color: white;
    }
    div.info {
        transition: 1s;
        transform: translateX(150%);
        text-align: center;
        width: 70%;
        margin-top: -11%;
        margin-left: auto;
        margin-right: auto;
        color: white;
        background: rgb(10, 10, 10);
        border: 1px solid rgb(111, 111, 111);
        border-radius: 5px;
        font-size: 3vw;
    }
    div.name:hover ~ div.info {
        transform: translateX(0%);
    }
    h1 a {
        color: white;
        font-size: 1.5vw;
    }
</style>

<body>
    <h1>Hover Me (Keep Your Cursor Still) <br> <a href="/../ex1.php">Back to Login</a> </h1>
    <div class="name">
        <?=$username?>
    </div>
    <div class="info">
        Email: <?=$email?>
        <br>
        Password: <?=$password?>
        <br>
        Sex: <?=$sex?>
        <br>
    </div>
</body>
</html>
