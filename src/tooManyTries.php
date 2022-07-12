<?php
    require("Controller/redirect.php");
    if(directVisit()){
        header("Location: ex1.php");
    }

    $current = fopen("Data/currentDateLocked.dat", 'r');
    $data = fgets($current);
    fclose($current);

    if(empty($data)){
        header("Location: ex1.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Too Many Tries</title>
</head>

<style>
    body, html {
        height: 100%;
        margin: 0;
    }
    
    div {
        height: 100%;
        color: white;
        background: rgba(0, 0, 0, 0.85)url("https://browsecat.net/sites/default/files/4k-ultra-gaming-wallpapers-98532-562440-1102330.png");
        background-blend-mode: darken;
        background-position: center;
        background-size: cover;
        text-align: center;
    }
    h1 {
        letter-spacing: .5vw;
        margin-top: 15%;
        font-size: 5vw;
    }
    h1 a {
        transition: .5s;
        letter-spacing: .05vw !important;
        color: white;
        font-size: 2vw;
    }
    h1 a:hover {
        color: rgb(137, 137, 137);
    }
</style>

<body>
    <div>
        &nbsp;
        <h1>
            Too many tries <br>
            <?php
                
                echo "Please wait until: <i>$data</i>";
                echo "<br>Now: <i><span id=\"span\"></span></i>";

                if(date('H:i:s')>=date('H:i:s', strtotime(str_replace('/', '-', $data)))){
                    header("Location: ex1.php");
                    die();
                }

                echo "<br> <a href=\"ex1.php\">If the page doesn't redirect, Click Here.</a>";
            ?>
        </h1>
    </div>

    <script>
        var span = document.getElementById('span');
        function time() {
            var d = new Date();
            var s = d.getSeconds();
            var m = d.getMinutes();
            var h = d.getHours()-5;
            span.textContent = 
                ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
        }
        setTimeout(function () {
            window.location.href = "ex1.php";
        }, 30000);
        setInterval(time, 1000);
    </script>
</body>
</html>