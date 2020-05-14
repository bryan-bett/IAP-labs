<?php
    include "Crud.php";
    include "authenticator.php";

    class User implements Crud,Authenticator{
        private $user_id;
        private $first_name;
        private $last_name;
        private $city_name;
        private $con;

        private $username;
        private $password;
        function __construct(){
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->city_name = $city_name;
            $this->username = $username;
            $this->password = $password;
            $this->con = new DBConnection;
        }
        /*public function setUser($first_name, $last_name,$city_name){
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->city_name = $city_name;
            $this->con = new DBConnection;
        }
        public function setLoginCred(){
            $this->username = $username;
            $this->password = $password;
        }*/

        public static function create (){
            $instance = new self();
            return $instance;
        }
        public function setUsername($username){
            return $this->Username = $username;
        }
        public function getUsername(){
            return $this->username;
        }
        public function setPassword($password){
            return $this->password = $password;
        }
        public function getPassword(){
            return $this->password;
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
            $this ->hashPAssword();
            $pass = $this->password;
            $uname = $this->username;
            $stm = "INSERT INTO users(first_name,last_name,user_city,username,password)VALUE ('$fn','$ln','$city','$uname','$pass')";
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

        // lab 2 
        // server side validation
        public function validateForm(){
            //return false if values are empty
            $fn = $this->first_name;
            $ln = $this->last_name;
            $city = $this->city_name;
            if($fn == "" || $ln == "" || $city == ""){
                return false;
            }
            return true;
        }
        public function createFormErrorSessions(){
            session_start();
            $_SESSION['form_error']= "All fields are required";
            //echo $_SESSION['form_error'];
        }
        public function hashPassword(){
            // inbuilt function password_hashes our password
            $this ->password = password_hash($this->password,PASSWORD_DEFAULT);
        }
        public function isPasswordCorrect(){
            $con = new DBConnector;
            $found = false;
            $res = mysqli_query("SELECT * FROM user") or die ("Error: ".mysqli_error());
            while ($row=mysql_fetch_array($res)){
                if(password_verify($this->getPassword(),$row['password']) && $this->getUsername()==$row['username']){
                    $found = true;
                }
            }
            //close the db connection
            $con->closeDatabase();
            return $found;
            //return true;
        }
        public function login(){
            if($this->isPasswordCorrect()){
                //password is correct. so we load the protected page
                header("Location: private_page.php");
            }
        }
        public function createUserSession(){
            session_start();
            $_SESSION['username'] = $this->getUsername();
        }
        public function logout(){
            session_start();
            unset($_SESSION['username']);
            session_destroy();
            header("Location:lab1.php");

        }
    }

?>