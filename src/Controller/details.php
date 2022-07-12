<?php
    /* require("redirect.php");
    if(directVisit()){
        header("Location: ../ex1.php");
    } */

   /*  include("collectingData.php");
    $data = new CollectData("../Data/tempData.dat");
    $myAccount = $data->getEachAccount()[0]; */

    require("collectingData.php");
    $db = new ConnectDB('accounts');
    $myAccount = $db->account($_COOKIE['token']);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
</head>

<style>
    body, html {
        height: 100%;
        margin: 0;
    }
    div {
        height: 100%;
        background: rgba(0, 0, 0, 0.7)url("https://www.99images.com/download-image/980685/1920x1080");
        background-size: cover;
        background-position: center;
        background-blend-mode: darken;
        display: block;
        text-align: center;
    }
    h1 {
        margin: 0 auto;
        margin-top: 5%;
        width: 90%;
        border: 1px solid rgba(250, 250, 250, 0.2);
        text-align: center;
        color: white;
        font-size: 8vw;
        letter-spacing: 1vw;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 10px;
    }

    a {
        font-weight: bold;
        font-size: 1.5vw;
        color: white;
    }

    h1 span {
        letter-spacing: normal;
        font-weight: 300;
        font-size: 2vw;
    }

    img {
        width: 10%;
    }

    form {
        letter-spacing: normal !important;
        font-size: 1vw !important;
    }
    input[type=submit] {
        margin: 10px 0;
        font-size: 1vw;
    }
</style>

<body>
    <div>
        &nbsp;
        <img src="<?=$myAccount["path"]?>" alt="">
        <br>
        <a href="logout.php">Log Out | </a>
        <a href="/../mystock.php">Go to Dashboard</a>
        <h1>
            <?=$myAccount["username"]." ( ".$myAccount["userID"].")"?>
            <br>
            <span>Password: <?=$myAccount["password"]?></span>
            <span>Email: <?=$myAccount["email"]?></span>

            <form enctype=multipart/form-data action="./changeProfile.php" method="post">
                Change Profile Picture: <input name="profile" type="file" accept="image/png, image/jpeg" required>
                <br>
                <input type="submit" value="Submit" name="submit">
            </form>
        </h1>
    </div>
    <script type="text/javascript">
        window.addEventListener('beforeunload', (event) => {
            // Cancel the event as stated by the standard.
            event.preventDefault();
            // Chrome requires returnValue to be set.
            event.returnValue = 'Data will be reset. Are you sure?';
        });
    </script>
</body>
</html>