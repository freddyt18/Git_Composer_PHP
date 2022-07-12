<?php
    $INVALID = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Register</title>
</head>

<style>

    body, html {
        height: 100%;
        margin: 0;
    }

    div.WHOLE-PAGE {
        display: flex;
    }

    div.WHOLE-PAGE div.img {
        position: absolute;
        width: 70%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4)url("https://wallpapercave.com/wp/wp4705314.jpg");
        background-size: cover;
        background-position: center;
        background-blend-mode: darken;
    }

    div.WHOLE-PAGE div.form {
        position: absolute;
        width: 30%;
        height: 100%;
        right: 0;
        background: rgba(0, 0, 0, 0.3)linear-gradient(to bottom left, #4f463a, #180d09);
        background-blend-mode: darken;
        display: block;
        text-align: center;
    }

    div.WHOLE-PAGE div.form form div {
        font-size: 1.5vw;
        color: white;
        margin-bottom: 10%;
    }

    div.WHOLE-PAGE div.form form center input[type=submit] {
        transition: .4s;
        border-radius: 20px;
        border-color: transparent;
        font-size: 2vw;
        width: 35%;
    }
    div.WHOLE-PAGE div.form form center input[type=submit]:hover {
        background: rgb(153, 153, 153);
        color: rgb(44, 44, 44);
    }
    div.WHOLE-PAGE div.form form div input {
        border-radius: 20px;
        border-color: transparent;
        padding-left: 10px;
    }

</style>

<body>
    <div class="WHOLE-PAGE">
        <div class="img">&nbsp;</div>
        <div class="form">
            <form enctype=multipart/form-data action="/Controller/registerController.php" method="post" style="margin-top: 25%;">
                <div style="font-weight: bold; font-size: 2.5vw;">
                    Registration Form
                </div>
                <div>
                    Username: <input type="text" required name="user" maxlength="20">
                </div>
                <div>
                    Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" required name="email" maxlength="50">
                </div>  
                <div>
                    Password: &nbsp;<input type="password" required name="pass" maxlength="30">
                </div>
                <div>
                    Sex:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <select name="sex" id="sex" required>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div style="width: 90%; margin: 5% auto;">
                    <span>Profile: </span> <input style="color: white; font-size: 1vw;" type="file" name="profile" accept="image/png, image/jpeg" required>
                </div>
                <center>
                    <input type="submit" value="Register" name="Register">
                </center>
                <center>
                    <br>
                    <br><br><a href="ex1.php" style="color: white; font-size: 1.5vw;">Back To Login</a>
                </center>
            </form>
        </div>
    </div>
</body>
</html>