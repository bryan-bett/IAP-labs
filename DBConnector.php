<?php
    define('DB_SERVER','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','btc3205');

    class DBConnection{
        public $conn;
        function __construct(){
            $this->conn =new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("ERROR: Could not connect. " . $mysqli->connect_error);
        }
        
        public function closeDatabase(){
            mysqli_close($this->conn);
        }
    }
?>