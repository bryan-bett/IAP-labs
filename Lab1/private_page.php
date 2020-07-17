<?php
    include_once 'DBConnector.php';

    session_start();
    if(!isset($_SESSION['username'])){
        header("Location:login.php");
    }
     
    function fetchUserApiKey()
    {
        $db = new DBConnection();
        $con = $db->getmyDB();
        $user_id = $_SESSION["user_id"];
        $res = $con->prepare("SELECT api_key FROM api_keys WHERE user_id = $user_id");
        $res->execute();
        if ($res===FALSE || is_null($res)) {
            return "";
        } else {
            $row = $res->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
    }
?>
<html>
    <head>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="validate.css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                
        <script type="text/javascript" src="validate.js"></script>
        <script type="text/javascript" src="apikey.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css.map">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css.map">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css.map">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css.map">
    </head>
    <body>
        <p align='right'><a href="logout.php">Logout</a></p>
        <hr>
        <h3>Here, we will create an API that will allow Users/Developer to order items from external systems</h3>
        <hr>
        <h4>We now put this feature of allowing users to generate an API key. Click the button to generate the API key</h4>

        <button class="btn btn-primary" id="api-key-btn">Generate API key </button> <br> <br>

        <strong>Your API key:</strong>(Note that if your API key is already in use by already running applications, generating a new key will stop the application from functioning) <br>
        <textarea name="api_key" id="api_key" cols="100" rows="2"><?php echo fetchUserApiKey();?></textarea>
        
        <h3>Service description</h3>
        We have a service/API that allows external applications to order food and also
        pull all order status by using order id. Let's do it.

        <hr>
    </body>
</html>