<?php
    include_once 'DBconnector.php';
    include_once 'user.php';
    if (isset($_POST['btn-login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $instance = User::create();
        $instance ->setPassword($password);
        $instance ->setUsername($username);

        if($instance->isPasswordCorrect()){
            $insatnce->login();
            //close db connection
            $con->closeDatabase();
            //next create a user session
            $instance->createUserSession();
        }
        else{
            $con->closeDatabase();
            //echo "wrong password";
            header("Location:login.php");
        }
    }
?>
<html>
    <head>
        <title>Login</title>
        <script type='text/javascript' src='validate.js'></script>
        <link rel='stylesheet' type='text/css' href='validate.css'>
    </head>
    <body>
        <form method="post" name="login" id="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <table align="center">
                <tr>
                    <td><input type="text" name= "username" placeholder="Username" required/></td>
                </tr>
                <tr>
                    <td><input type="password" name="password" placeholder="Password" required></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn-login"><strong>Login</strong></button></td>
                </tr>
        </form>
    </body>
</html>