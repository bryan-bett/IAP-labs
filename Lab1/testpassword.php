<?php
    include_once "DBConnector.php";

    class user{
        private $db;
        private $con;
        public $tests =  "test8";
        public $passwords = "password";
        public $test2 = "test";

        function pass($test,$password){
            $db = new DBConnection();// call to DBConnection class
            $con =$db->getmyDB();           
            
            $stmt = $con->prepare("SELECT * FROM users");
            $stmt->execute();
            $row= $stmt->fetch();
            //print_r ($row);
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($password==$row['password'] && $test == $row['username']){
                    print_r ($row);

                }
            }
            /*while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $arr[] = $row;
}
if(!$arr) exit('No rows');
var_export($arr);*/
        }
        public $smthn;
        //pass($tests,$passwords);
        public function getSum($num1, $num2){
            $sum = $num1 + $num2;
            echo "Sum of the two numbers $num1 and $num2 is : $sum";
          }
           
          // Calling function
          
    }
    $obj = new user;
    $obj->getSum(10, 20);
    $obj->pass("test","password");
?>
<html>
    <p><?php ?></p>
</html>