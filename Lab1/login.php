<?php
	include_once 'DBConnector.php';
	include_once 'User.php';

	$con=new DBConnection;
	if(isset($_POST['btn-login'])){
		$username=$_POST['username'];
		$password=$_POST['password'];
		$instance=User::create();
		$instance->setPassword($password);
		$instance->setUsername($username);

    if ($instance->isPasswordCorrect()) {
              $instance->createUserSession();
              header("Location:private_page.php");
          } else {
                ?>
                <script>alert("Wrong password")</script>
                <?php
                header("Location:login.php");
          }
    }


?>
<html>
  <head>
    <title>Title goes here</title>
    <script type="text/javascript" src="validate.js"></script>
    <link rel="stylesheet" type="text/css" href="validate.css">
  </head>
      <body>
        <form method="post" name="login" id="login" action="<?php echo $_SERVER['PHP_SELF']?>">
          <table align="center">
            <tr>
              <td><input type="text" name="username" placeholder="Username" required/></td>
            </tr>
            <?php
            ?>
            <tr>
              <td><input type="password" name="password" placeholder="password" required/></td>
            </tr>
            <tr>
              <td><button type="submit" name="btn-login"><strong>LOGIN</strong></button></td>
            </tr>
          </table>
        </form>
      </body>
 
 
</html>