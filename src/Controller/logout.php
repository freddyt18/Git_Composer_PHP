<?php

    /* require("redirect.php");
    if(!directVisit()){
        include("getUserIP.php");
        resetTemp("../Data/tempData.dat");    
    } */
    require("collectingData.php");
    $db = new ConnectDB('accounts');
    $db->unsetCookie($_COOKIE['token']);
    header("Location: ../ex1.php");
    die();

?>