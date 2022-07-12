<?php
    require_once('Controller/collectingData.php');
    $db = new ConnectDB('stock');
    if(!$db->cookieExists($_COOKIE['token'])){
        header("Location: ex1.php");
    }

    if(isset($_GET["delete"])){
        delete($db, $_GET["id"]);
        header("Location: mystock.php");
    }

    if(isset($_GET["submit"])){
        $token = $_COOKIE['token'];
        insertIntoStock(
            $db, 
            $_GET["name"], 
            $_GET["amt"], 
            $_GET["price"], 
            $db->conn->query("SELECT userID FROM accounts WHERE cookies LIKE '$token'")->fetch_assoc()["userID"]
        );
        header("Location: mystock.php");
    }

    function insertIntoStock($db, $name, $amt, $price, $userID){
        $db->conn->query(
            "INSERT INTO STOCK (item_Name, amount, price, userID)
            VALUES('$name', $amt, $price, $userID);"
        );
    }

    function delete($db, $id){
        $db->conn->query(
            "DELETE FROM stock WHERE itemID = $id;"
        );
    }

    function listAllStock($db){
        $data = $db->conn->query(
            "SELECT * FROM STOCK;"
        );

        if($data->num_rows > 0) {
            while($row = $data->fetch_assoc()){
                $id = $row["itemID"];
                $name = $row["item_Name"];
                $amount = $row["amount"];
                $price = $row["price"];
                $userID = $row["userID"];
                echo "<tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$amount</td>
                    <td>$$price</td>
                    <td>$userID</td>
                    <td>
                        <span data-internalid=\"$id\" class=\"delete_item\">DELETE</span>
                        |
                        <a href=\"editStock.php?id=$id\" target=\"_blank\">EDIT</a>
                    </td>
                </tr>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.12.1/b-2.2.3/sl-1.4.0/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="Editor-2.0.8/css/editor.dataTables.css">
 
    <script type="text/javascript" src="/jquery/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.12.1/b-2.2.3/sl-1.4.0/datatables.min.js"></script>
    <script type="text/javascript" src="Editor-2.0.8/js/dataTables.editor.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Schools Table</title>
</head>

<style>
    a,
    span.delete_item {
        text-decoration: underline;
        transition: .5s all;
        text-decoration-color: #009870;
        color: black;
    }
    a:hover,
    span.delete_item:hover {
        cursor: pointer;
        color: #009870;
    }
    .content-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 1.2em;
        min-width: 400px;
        border-radius: 5px 5px 0 0;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }
    .content-table thead tr {
        background-color: #009870;
        color: #fff;
        text-align: center;
    }
    .content-table th,
    .content-table td {
        padding: 12px 15px;
    }
    .content-table tbody tr {
        border-bottom: 1px solid #000;
    }
    .content-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }
    .content-table tbody tr:last-of-type {
        border-bottom: 3px solid #009870;
    }
    .content-table tbody td {
        border-right: 5px solid #009870;
    }
    .content-table tbody td:last-of-type {
        border-right: 0;
    }
    form div,
    button {
        margin-top: 10px;
    }
    </style>

<body>
    <script>
        if(window.history.replaceState){
            window.history.replaceState(null, null, window.location.href)
        }
        $(document).ready(function (){
            $('#mystock').DataTable();
        });
    </script>

    <center>
        <table id="mystock" class="content-table" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Amount</th>
                    <th>Price</th>
                    <th>UserID</th>
                    <th></th>
                </tr>
                <tbody style="text-align: center;">
                    <?php
                    
                        listAllStock($db);

                    ?>
                </tbody>
            </thead>
        </table>
    </center>

    <center>
        <form action="" method="GET">
            <div>
                Item Name: <input type="text" name="name" required>
            </div>
            <div>
                Amount: <input type="number" name="amt" required>
            </div>
            <div>
                Price per Item: <input type="number" step="0.01" name="price" required>
            </div>
            <button type="submit" name="submit">Add</button>
            <br><br>
            <a href="ex1.php">Back To Profile</a>
        </form>
    </center>

    <script>
        const alert = () => alert("test");
        window.onload = async () => {
            const links = document.querySelectorAll('span.delete_item')

            links.forEach((link) => {
                link.addEventListener('click', () => {
                    const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                    setTimeout(() => {
                        window.location.href = "mystock.php?delete=&id=" + link.attributes[0].value
                    }, 2000);
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Data is safe!',
                    'error'
                    )
                }
                })
                })
            })
        }
    </script>

</body>
</html>
