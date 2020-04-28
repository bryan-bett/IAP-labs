<?php
    include "Crud.php";
    include_once 'DBConnector.php';
    class User implements Crud{
        private $user_id;
        private $first_name;
        private $last_name;
        private $city_name;
        private $con;

        function __construct($first_name, $last_name,$city_name){
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->city_name = $city_name;
            $this->con = new DBConnection;
        }
        public function setUserId(){
            $this->user_id = $user_id;
        }
        public function getUserId(){
            return $this->$user_id;
        }
        public function save(){
            $this->conn =new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("ERROR: Could not connect. " . $mysqli->connect_error);

            $fn = $this->first_name;
            $ln = $this->last_name;
            $city = $this ->city_name;
            $stm = "INSERT INTO users(first_name,last_name,user_city)VALUE ('$fn','$ln','$city')";
            $res = mysqli_query($this->con->conn,$stm) or die("Error: ".mysqli_error($this->con->conn));
            // stores bool value true or false from a query to the db
            $this->con->closeDatabase();
            return $res;
        }
        public function readAll(){
            $sql = "SELECT * FROM users";
            $result = $this->con->conn->query($sql);
            return $result;        }
        public function readUnique(){
            return null;
        }
        public function search(){
            return null;
        }
        public function update(){
            return null;
        }
        public function removeOne(){
            return null;
        }
        public function removeAll(){
            return null;
        }

    }

?>