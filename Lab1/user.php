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

        private $created_at;
        private $utc_offset;

        function __construct($first_name, $last_name, $city_name, $username, $password,$created_at,$utc_offset){
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->city_name = $city_name;
            $this->username = $username;
            $this->password = $password;
            $this->db = new DBConnection();// call to DBCOnnection class
            $this->con = $this->db->getmyDB();

            $this->created_at = date("Y-m-d H:i:s", intdiv(intval($created_at) , 1000));
            $this->utc_offset = intval($utc_offset);
        }

        public function setUserId($user_id){
            $this->user_id = $user_id;
        }
        public function getUserId(){
            return $this->user_id;
        }
        public function save(){
            $fn = $this->first_name;
            $ln = $this->last_name;
            $city = $this->city_name;
            $uname = $this->username;
            $this->hashPassword();
            $pass=$this->password;
            $created_at = $this->created_at;
            $offset = $this->utc_offset;

            $stmt = $this->con->prepare("INSERT INTO users(first_name,last_name,user_city,username,password,created_at,offset)VALUE (?,?,?,?,?,?,?)");
            $data= array($fn,$ln,$city,$uname,$pass,$created_at,$offset);
            $stmt->execute($data);
            $res=$stmt;
            $stmt = null;
            $this->db->closeDatabase();
            // stores bool value true or false from a query to the db
            return $res;
        }
        public function readAll(){
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
        public function isUserExist(){
            $stmt = $this->con->prepare("SELECT * FROM users WHERE username = '$this->username' LIMIT 1");
            $stmt->execute();
            return $stmt->rowCount() > 0;          
        }
        public static function create(){
            $instance = new self("","","","","","","");
            return $instance;
        }

        public function setUsername($username){
             $this->username = $username;
        }
        public function getUsername(){
            return $this->username;
        }
        public function setPassword($password){
             $this->password = $password;
        }
        public function getPassword(){
            return $this->password;
        }

        public function getCreatedAt()
        {
            return $this->created_at;
        }

        public function setCreatedAt($created_at)
        {
            $this->created_at = $created_at;
        }

        public function getUTCOffset()
        {
            return $this->utc_offset;
        }

        public function setUTCOffset($offset)
        {
            $this->utc_offset = $offset;
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
            $pass = $this->password;
            $uname = $this->username;

            if($fn==""||$ln==""||$city==""||$pass==""||$uname==""){
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


        public function isPasswordCorrect(){
            $found = false;
            $stmt = $this->con->prepare("SELECT * FROM users");
            $stmt->execute();
            if ($stmt === FALSE){
                die("Error: " .$this->con->errorInfo());
            }
            else{
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    if (password_verify($this->getPassword(),$row['password']) && $this->getUsername() == $row['username']) {
                        $this->setUserId($row['id']);
                        $found = true;
                    }
                }
            }
            //close the database connection 
            $this->db->closeDatabase();
            return $found;
            //return true;
        }
        public function login(){
            if($this->isPasswordCorrect()){
                //password is correct so we load the protected page
                header("Location:private_page.php");
            }
        }

        public  function createUserSession(){
            session_start();
            $_SESSION['username'] = $this->getUserId();
            $_SESSION['user_id'] = $this->user_id;

        }
        public function logout(){
            session_start();
            unset($_SESSION['username']);
            unset($_SESSION['user_id']);
            session_destroy();
            header("Location:lab1.php");
        }    
    }   
?>