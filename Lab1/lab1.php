<?php
    include_once 'DBConnector.php';
    include_once 'user.php';
    include_once 'fileUploader.php';
    $con = new DBConnection();

    //data insertion code starts here
    
    if (isset($_POST['btn-save'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city = $_POST['city_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $file = $_FILES["fileToUpload"]; 


        //creating a user object
        $user = new User ($first_name,$last_name,$city,$username,$password);
        //creating a FileUploader object
        $uploader = new FileUploader();
        if (!$user->validateForm()){
            $user->createFormErrorSessions();
            echo "All fields are required";
            header("Refresh:1");
            die();
        }else if ($user->isUserExist()){
            $user->createFormErrorSessions();
            $_SESSION['form_errors'] = "This username is already taken";
            header("Refresh:1");
            die();
        }
        //save details and upload file
        $res = $user->save();
        $file_upload_response = $uploader->uploadFile($file);

        if($res && $file_upload_response){
            echo "Done";
            ?>
            <script>alert("Save operation successful")</script>
            <?php
        }else if(!$file_upload_response && empty($_SESSION['form_errors'])){
        $_SESSION['form_errors'] = "File upload was unsuccessful";
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data"
                    name="user_details" id="user_details" onsubmit="return validateForm()">
        <table align="center">
            <tr>
                <div id="form_error">
                    <?php
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        if (!empty($_SESSION['form_errors'])) {
                            echo " " . $_SESSION['form_errors'];
                            unset($_SESSION['form_errors']);
                        }
                    ?>
                </div>
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
                Profile image:
                <input type="file" name="fileToUpload" id="fileToUpload">
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