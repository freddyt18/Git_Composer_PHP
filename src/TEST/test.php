<?php
    include("../Controller/collectingData.php");

    $db = new ConnectDB;
    
    $data = $db->conn->query(
        "SELECT * FROM accounts;"
    );


    /* if($data->num_rows > 0) {
        while($row = $data->fetch_assoc()){
            $user = $row["email"];
            $user = explode("@", $user);
            $name = $row["username"];

            echo "<pre>";
            var_dump($user);
            echo "</pre>";

            $user[0] = $row["username"];
            $user = implode("@", $user);

            $db->conn->query(
                "UPDATE accounts
                SET
                    email = '$user'
                WHERE
                    username LIKE '$name'
                "
            );

            echo "<pre>";
            echo $user;
            echo "</pre>";

            echo "<br>";
        }
    } */

    // $db->resetIncrement(12);

    $db->close();

?>