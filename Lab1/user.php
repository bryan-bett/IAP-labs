<?php
    include "Crud.php";
    include "authenticator.php";
    include_once "DBConnector.php";


    class User implements Crud,Authenticator{
        private $user_id;
        private $first_name;
        private $last_name;
        private $city_name;
        private $db;
        private $con;

        function __construct($first_name, $last_name, $city_name, $username, $password){
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->city_name = $city_name;
            $this->username = $username;
            $this->password = $password;
            $this->db = new DBConnection();// call to DBCOnnection class
            $this->con = $this->db->getmyDB();
            //$this->con =$this->con->__construct();//call to __construct function
            // Subtitution to this was extending DBConnector.php to use the return value of the constructor
        }

        public function setUserId($user_id){
            $this->user_id = $user_id;
        }
        public function getUserId(){
            return $this->$user_id;
        }
        public function save(){
            $fn = $this->first_name;
            $ln = $this->last_name;
            $city = $this->city_name;
            $uname = $this->username;
            $this->hashPassword();
            $pass=$this->password;

            $stmt = $this->con->prepare("INSERT INTO users(first_name,last_name,user_city,username,password)VALUE (?,?,?,?,?)");
            $data= array($fn,$ln,$city,$uname,$pass);
            $stmt->execute($data);
            $res = $stmt;
            $stmt = null;
            $this->db->closeDatabase();
            // stores bool value true or false from a query to the db
            return $res;
        }
        public function readAll(){
            //$con = new DBConnection();
            $stmt = $this->con->prepare("SELECT * FROM users");
            $stmt->execute();
            $this->db->closeDatabase();

            //$result = $stmt->fetch(PDO::FETCH_ASSOC);
            //both work
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $arr[] = $row;
            }

            $result = $arr;
            if(!$arr) exit('No rows');
            return $result;
            //return array
        }
        public static function create(){
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
            if($fn==""||$ln==""||$city==""){
                return false;
            }
            return true;
        }
        public function createFormErrorSessions(){
            session_start();
            $_SESSION['form_errors'] = "All fields are required";
        }
    
        public function hashPassword(){
            $this->password = password_hash($this->password,PASSWORD_DEFAULT);
                
        }


        public function isPasswordCorrect($username,$password){
            $db = new DBConnection();// call to DBConnection class
            $con =$db->getmyDB();           
            
            $found = false;
            $stmt = $con->prepare("SELECT * FROM users");
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if(password_verify($password,$row['password']) && $username == $row['username']){
                    $found=true;
                }            
            }
            //close the database connection 
            $db->closeDatabase();
            return $found;
            //return true;
        }
        public function login(){
            if($this->isPasswordCorrect()){
                //password is correct so we load the protected page
                header("Location:private_page.php");
            }
        }

        public  function createUserSession($username){
            session_start();
            $_SESSION['username'] = $username;

        }
        public function logout(){
            session_start();
            unset($_SESSION['username']);
            session_destroy();
            header("Location:lab1.php");
        }    
    }   
?>