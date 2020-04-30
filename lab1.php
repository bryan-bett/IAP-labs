<?php
    include_once 'DBConnector.php';
    include_once 'user.php';
    $con = new DBConnection();/*Database connection is  made*/ 
    //data insertion code starts here
    if (isset($_POST['btn-save'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city = $_POST['city_name'];
        //creating a user object
        $user = new User ($first_name,$last_name,$city);
        if (!$user->validateForm()){
            $user->createFormErrorSessions();
            header("Refresh:2");
            die();
        }
        $res = $user->save();
        if($res){
            echo "Save operation was successful \n ";
            //echo $res;
        }else{
            echo "An error occured!";
        }
    }
?>

<html>
<head>
    <title>Form</title>
    <script type="text/javascript" src="validate.js"></script>
    <link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" 
                    name="user_details" id="user_details" onsubmit="return validateForm()">
        <table align="center">
            <tr>
                <td>
                    <?php
                        session_start();
                        if(!empty($_SESSION['form_errors'])){
                            echo " ". $_SESSION['form_error'];
                            unset($_SESSION['form_error']);
                        }
                    ?>
                <td>
            </tr>
            <tr>
                <td>
                <input type="text" name="first_name" placeholder="First Name">
                </td>
            </tr>
            <tr>
                <td>
                <input type="text" name="last_name" placeholder="Last Name">
                </td>
            </tr>
            <tr>
                <td>
                <input type="text" name="city_name" placeholder="City">
                </td>
            </tr>
            <tr>
                <td>
                <button type="submit" name="btn-save"><strong>SAVE</strong></button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>