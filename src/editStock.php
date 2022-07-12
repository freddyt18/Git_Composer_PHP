<?php

    require('Controller/collectingData.php');
    $db = new ConnectDB('stock');

    if(!$db->cookieExists($_COOKIE['token'])){
        header("Location: ex1.php");
    }

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $data = $db->conn->query(
            "SELECT * FROM STOCK WHERE itemID = $id"
        );
        if($data){
            $row = $data->fetch_assoc();
        }
    }

    if(isset($_GET["edit"])){
        $item_Name = $_GET["name"];
        $price = $_GET["price"];
        $amount = $_GET["amount"];
        $id = $_GET["id"];

        $db->conn->query(
            "UPDATE STOCK
            SET item_Name = '$item_Name',
                price = $price,
                amount = $amount
            WHERE
                itemID = $id;"
        );
        header("Location: editStock.php?id=$id");
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit | <?=$row["item_Name"]?></title>
</head>

<style>
    body {
        display: flex;
        height: 100vh;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #71b7e6, #9b59b6);
        font-size: 20px;
        overflow-y: hidden;
    }
    
    .container {
        max-width: 400px;
        width: 100%;
        padding-top: 20px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        background: #fff;
        padding: 25px 30px;
        border-radius: 5px;
    }
    
    .container .title {
        text-align: center;
    }
    
    .item-detail {
        margin: 20px;
        left: 0;
    }
    
    .container .input-box {
        margin: 20px;
        left: 0;
    }
    
    .container .button {
        text-align: center;
    }
    
    form .button input {
        padding: 10px;
        height: 100%;
        width: 40%;
        outline: none;
        color: #fff;
        background: linear-gradient(135deg, #71b7e6, #9b59b6);
        font-size: 18px;
        border: none;
        border-radius: 7px;
    }
</style>

<body>
    <div class="container">
        <div class="title">Item ID: <?=$_GET["id"]?></div>
        <form action="#">
            <div class="item-detail">
                <div class="input-box">
                    <span class="details">Item Name:</span>
                    <input type="text" name="name" placeholder="<?=$row["item_Name"]?>">
                </div>
                <div class="input-box">
                    <span class="details">Price:</span>
                    <input type="text" name="price" placeholder="<?=$row["price"]?>">
                </div>
                <div class="input-box">
                    <span class="details">Amount:</span>
                    <input type="text" name="amount" placeholder="<?=$row["amount"]?>">
                </div>
                <input type="text" name="id" hidden value="<?=$_GET["id"]?>">
            </div>
            <div class="button">
                <input type="submit" value="Submit" name="edit">
            </div>
        </form>
    </div>
</body>

</html>