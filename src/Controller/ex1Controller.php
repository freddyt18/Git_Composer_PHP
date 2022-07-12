<?php


    require("collectingData.php");
    $db = new ConnectDB('accounts');
    if(isset($_COOKIE['token'])){
        if($db->cookieExists($_COOKIE['token']) != ""){
            $url = "details.php?".$_COOKIE['token'];
            header("Location: $url");
        }
    } else {
        require('Helper/setCookies.php');
    }

    require("redirect.php");
    if(directVisit()){
        header("Location: ../ex1.php");
    }
    
    require("getUserIP.php");
    
    /* $ip = getUserIP();
    $path = "../Data/currentIP.dat"; */
    $pattern = "/\W/";

    /* if(isCurrentIPEmpty()){
        storeCurrentIP();
    } else {
        if(moreThanThreeTimes("../Data/currentTry.dat")){

            $liftLock = false;

            if(filesize("../Data/currentDateLocked.dat")==0){
                lockFile();
            } else {
                $current = fopen("../Data/currentDateLocked.dat", 'r');
                $data = fgets($current);

                if(date('H:i:s')>=date('H:i:s', strtotime(str_replace('/', '-', $data)))){
                    resetTry("../Data/currentTry.dat");
                    $liftLock = true;
                }

                fclose($current);
            }

            if(!$liftLock){
                header("Location: /../tooManyTries.php");
                die();
            }
        }
    } */
    
    if(isset($_POST["login"])){
        if(preg_match($pattern, $_POST["user"]) || preg_match($pattern, $_POST["pass"])){
            header("Location: /ex1.php");
            die();
        }

        $username = $_POST["user"];
        $password = $_POST["pass"];
        
        $access = false;
        $currentAccount = array();

        $db = new ConnectDB('accounts');
        if($db->validateLogin($username, $password, $_COOKIE['token'])){
            $access = true;
        }
        $db->close();

        if($access){
            // resetTry("../Data/currentTry.dat");
            $url = "details.php?".$_COOKIE['token'];
            header("Location: $url");
            die();

            /* echo "<br><pre>";
            var_dump($data->getEachAccount());
            echo "</pre>"; */
        } else {
            header("Location: /ex1.php");
            die();
        }

    }
    
?>
