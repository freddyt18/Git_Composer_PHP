<?php

    /* class CollectData {
        public $path = "";
        private $file = "";
        private $lines = "";
        private $data = "";
        private $eachAccount = array();
        
        function __construct($path) {
            $this->path = $path;

            $this->file = new SplFileObject($this->path);
            
            while(!($this->file->eof())){
                $this->lines .= $this->file->fgets();
                $this->lines .= "!";
            }
            $this->file = null;

            $this->data = explode("!", $this->lines);
    
            foreach($this->data as $account) {
                $this->eachAccount[] = explode("-", $account);
            }
        }

        function getLines(){
            return $this->lines;
        }
        function getEachAccount(){
            return $this->eachAccount;
        }
    } */

    class ConnectDB {
        static private $servername = "localhost";
        static private $username = "root";
        static private $password = "11022004";
        public $conn = "";

        function __construct($table){
            $this->conn = new mysqli(self::$servername, self::$username, self::$password);
            
            $this->conn->query(
                "CREATE DATABASE IF NOT EXISTS webapp;"
            );
            $this->conn->query(
                "USE webapp;"
            );

            if($table == "accounts"){
                $this->conn->query(
                    "CREATE TABLE IF NOT EXISTS accounts (
                        userID int(250) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        username varchar(250) NOT NULL,
                        password varchar(250) NOT NULL,
                        email varchar(250) NOT NULL,
                        sex varchar(9) NOT NULL,
                        path varchar(250) NOT NULL,
                        cookies varchar(250) NOT NULL
                      );"
                );
            }

            else if($table == "stock"){
                $this->conn->query(
                    "CREATE TABLE IF NOT EXISTS stock (
                        itemID int(250) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        item_Name varchar(250) NOT NULL,
                        amount int(250) NOT NULL,
                        price decimal(10, 4) NOT NULL,
                        userID int(250) NOT NULL
                      );"
                );
            }
        }

        function close(){
            $this->conn->close();
        }

        function insertALL($username, $password, $email, $sex, $profile){
            $this->conn->query(
                "INSERT INTO accounts (username, password, email, sex, path)
                VALUES ('$username', '$password', '$email', '$sex', '$profile')"
            );
        }

        function resetIncrement($from){
            $this->conn->query(
                "ALTER TABLE accounts AUTO_INCREMENT = $from"
            );
        }

        function extractALL(){
            $data = $this->conn->query(
                "SELECT * FROM accounts"
            );

            if($data->num_rows > 0){
                while($row = $data->fetch_assoc()){
                    echo "id: ". $row["userID"]. " - Name: ". $row["username"]. " - Password: ". $row["password"]. " - Email: ". $row["email"]. " - Sex: ".$row["sex"]. " - Image: ".str_replace("\n", "", $row["path"]). "<br>";
                }
            }
        }

        function validateLogin($username, $password, $cookie){
            
            $data = $this->conn->query(
                "SELECT * FROM accounts"
            );
            if($data->num_rows > 0){
                while($row = $data->fetch_assoc()){
                    if($row["username"] == $username){
                        if(password_verify($password, $row["password"]) == 1){
                            $this->setCookieTo($row["username"], $cookie);
                            return true;
                        }
                    }
                }
            }
            return false;
        }

        function userExists($username){
            $data = $this->conn->query(
                "SELECT * FROM accounts"
            );
            if($data->num_rows > 0){
                while($row = $data->fetch_assoc()){
                    if(strtolower($row["username"]) == strtolower($username)){
                        return true;
                    }
                }
            }
            return false;
        }

        function setCookieTo($username, $cookie){
            $this->conn->query(
                "UPDATE accounts SET cookies='$cookie' WHERE username LIKE '$username'" 
            );
        }

        function cookieExists($cookie){
            $data = $this->conn->query(
                "SELECT * FROM accounts"
            );

            if($data->num_rows > 0){
                while($row = $data->fetch_assoc()){
                    if($row["cookies"] == $cookie){
                        return $row["username"];
                    }
                }
            }

            return "";
        }

        function account($cookie){
            $data = $this->conn->query(
                "SELECT * FROM accounts WHERE cookies LIKE '$cookie'"
            );
            return $data->fetch_assoc();
        }

        function unsetCookie($cookie){
            $this->conn->query(
                "UPDATE accounts SET cookies='' WHERE cookies LIKE '$cookie'"
            );
        }
    }

    function hashPassword($password){
        return password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
    }
?>