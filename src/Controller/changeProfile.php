<?php

    require("redirect.php");
    if(directVisit()){
        header("Location: ../ex1.php");
    }

    if(isset($_POST)){
        include("collectingData.php");
        $db = new ConnectDB('accounts');
        $cookie = $_COOKIE['token'];

        $username = $db->conn->query(
            "SELECT username FROM accounts WHERE cookies LIKE '$cookie'"
        )->fetch_assoc()["username"];

        
        $name = explode(".", $_FILES["profile"]['name']);
        $name = $username.".".$name[1];
        $_FILES["profile"]['name'] = str_replace("\n", "", $name);
        
        $target_file = "../Assets/".basename($_FILES["profile"]['name']);

        $target_file = str_replace("\n", "", $target_file);

        if(move_uploaded_file($_FILES["profile"]['tmp_name'], $target_file)){
            $db->conn->query(
                "UPDATE accounts
                SET
                    path = '$target_file'
                WHERE
                    cookies LIKE '$cookie'
                "
            );
        };

    }

    header("Location: details.php");
    die();

?>