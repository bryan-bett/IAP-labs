<?php
    include_once 'DBConnector.php';
    include_once 'user.php';
    //$con = new DBConnection();/*Database connection is  made*/ 
    //why tho

    //data insertion code starts here
    
    if (isset($_POST['btn-save'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city = $_POST['city_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        //creating a user object
        $user = new User ($first_name,$last_name,$city,$username,$password);
        if (!$user->validateForm()){
            $user->createFormErrorSessions();
            echo "Something happened";
            header("Refresh:2");
            die();
        }
        $res = $user->save();
        if($res){
            echo "Done";
            ?>
            <script>alert("User created successfully")</script>
            <?php
        }else{
            ?>
            <script>alert("Error")</script>
            <?php
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
                <input type="text" name="username" placeholder="Username">
                </td>
            </tr>
            <tr>
                <td>
                <input type="password" name="password" placeholder="Password">
                </td>
            </tr>
            <tr>
                <td>
                <button type="submit" name="btn-save"><strong>SAVE</strong></button>
                </td>
            </tr>
            <tr>
                <td>
                        <a href="login.php">Login</a>
                </td>
        </table>
    </form>
</body>
</html>