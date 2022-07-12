<?php
    require("redirect.php");
    if(directVisit()){
        header("Location: ../ex1.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Already Exists</title>
</head>

<style>
    body, html {
        height: 100%;
        margin: 0;
    }
    div {
        height: 100%;
        background: rgba(0, 0, 0, 0.55)url("https://wallpapercave.com/wp/wp9643561.jpg");
        background-blend-mode: darken;
        background-size: cover;
        background-position: center;
        display: block;
    }
    h1 {
        width: 90%;
        margin: 12% auto;
        color: white;
        text-align: center;
        letter-spacing: 1vw;
        font-size: 9vw;
    }
    h1 a {
        transition: .5s;
        letter-spacing: .5vw;
        font-size: 4vw;
        color: white;
    }
    h1 a:hover {
        color: rgb(110, 110, 110);
    }
    h1 span {
        font-size: 2vw;
    }
</style>

<body>
    <div>
        &nbsp;
        <h1>
            Account Already Exists <br><a href="../register.php">Back To Register</a>
        </h1>
    </div>
</body>
</html>