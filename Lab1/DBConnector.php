<?php
    define('DB_SERVER','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','btc3205');
    

    class DBConnection{
    public $dsn = "mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=utf8mb4";
    //public $dsn = "mysql:host=localhost;dbname=btc3205;charset=utf8mb4";

    //Warning: A non-numeric value encountered in C:\xampp\htdocs\labs\Lab 1\DBConnector.php on line 6

    public $options = [
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];
        
        public $conn;
        /*We connect our database inside our class constructor
        so we can always cause a database conncetion whenever an object is created 
        */
        function __construct(){
            try{
            $this->conn =new PDO($this->dsn, DB_USER, DB_PASS, $this->options);
            }
            catch (Exception $e) {
                error_log($e->getMessage());
                //echo $e->getMessage();
                exit('Something weird happened'); //something a user can understand
              }
        }
        public function getmyDB(){
            if ($this->conn instanceof PDO)
                {
                return $this->conn;
                }
        }
        
        public function closeDatabase(){
            $conn=null;
        }
    }
    //implement query, bind, execute and resultset
    //reference
    //https://stackoverflow.com/questions/42863856/call-to-a-member-function-on-null/42864293
?>