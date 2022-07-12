<?php
    require("Controller/collectingData.php");
    $db = new ConnectDB('accounts');

    if(isset($_COOKIE['token'])){
        if($db->cookieExists($_COOKIE['token']) != ""){
            $url = "Controller/details.php?".$_COOKIE['token'];
            header("Location: $url");
        }
    } else {
        require('Helper/setCookies.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>Exercise 1</title>
</head>

<style>
    body, html {
        height: 100%;
        margin: 0;
    }
    div.WHOLE-PAGE{
        background: rgba(0, 0, 0, 0.6)url("https://wallpapercave.com/wp/wp4705314.jpg");
        height: 100%;
        background-position: center;
        background-size: cover;
        background-blend-mode: darken;
        display: block;
    }
    div.WHOLE-PAGE div:nth-child(1) img {
        width: 200px;
    }
    div.WHOLE-PAGE div:last-child {
        box-sizing: border-box;
        display: flex;
    }
    div.WHOLE-PAGE div:nth-child(2) form input[type=submit] {
        transition: .4s;
        background: white;
        border-radius: 30px;
        border-color: transparent;
        font-size: .5rem;
        font-weight: bold;
        width: 30%;
        height: 5vw;
        color: black;
        font-size: 3vw;
        letter-spacing: .2rem;
        margin-top: 1%;
        margin-bottom: 2%;
    }
    div.WHOLE-PAGE div:nth-child(2) form input[type=submit]:hover {
        background: rgb(120, 120, 120);
        color: rgb(54, 54, 54);
    }
    div.WHOLE-PAGE div:nth-child(2) form div input {
        border-radius: 30px;
        margin-bottom: 5%;
        padding-left: 30px;
    }
    a {
        transition: .4s;
        font-size: 2vw;
        color: white; 
    }
    a:hover {
        color: rgb(155, 155, 155);
    }
</style>

<body>
    <div class="WHOLE-PAGE">
        <div style="height: min-content;">
            <img src="Assets/deadpool.png"/>
        </div>
        
        <div>
            <form method="post" action="/Controller/ex1Controller.php" style="margin: 0 auto; padding: 5%;"> 
                <div style="display: flex; color: white; font-size: 3vw;">
                    Username: &nbsp;&nbsp;&nbsp; <input type="text" name="user" required>
                </div>
                <div style="display: flex; color: white; font-size: 3vw;">
                    Password: &nbsp;&nbsp;&nbsp;&nbsp;  <input type="password" name="pass" required>
                </div>
                <center>
                    <input type="submit" name="login" value="Login">
                </center>
                <center>
                    <a href="/register.php">Register</a>
                </center>

            </form>
        </div>
    </div>
</body>
</html>
