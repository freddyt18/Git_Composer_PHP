<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>

<style>
    div, div span, div input,input[type=submit] {
        font-size: 3vw;
    }
</style>

<body>
    <center>
        <form enctype=multipart/form-data action="#" method="post">
            <div>
                <span>Profile: </span> <input type="file" name="profile" accept="image/png, image/jpeg">
            </div>
            <input type="submit" name="submit">
        </form>
    </center>
</body>
</html>


<?php
    
    /* if(isset($_POST)){

        // move_uploaded_file($_FILES["profile"]['tmp_name'], "./".basename($_FILES["profile"]['name']));

        $name = explode(".", $_FILES["profile"]['name']);
        $_FILES["profile"]['name'] = implode(".", $name);
        $_FILES["profile"]['name'] = 'test'.".".$name[1];

        var_dump($_FILES);
        echo "<br>";

        echo "<pre>";
        var_dump($_FILES);
        echo "</pre>";
    } else {
        header("Location: fileUpload.php");
        die();
    } */

?>


