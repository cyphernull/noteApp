<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery.js"></script>
    <style>
        .contact-form{
            border: 1px solid #c0c0c0;
            margin-top: 30px;
            border-radius: 10px;
            box-shadow: 3px 3px 16px #c0c0c0;
        }
        .head{
            height: 85px;
        }
        .head p{
            font-size: 40px;
            line-height: 85px;
        }
        @media(max-width:768px){
            .head p{
                font-size: 30px;
            }
        }
        .alert p{
            font-style: italic;
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-offset-1 col-sm-10 contact-form">
            <div class="head">
                <p>New Email Activation</p>
            </div>
            <div id="resultmessage">
<?php
session_start();
include("connection.php");
if (!isset($_GET['email'])||!isset($_GET["key"])||!isset($_GET['newemail'])){
    echo "<div class='alert alert-danger'>Account Activation Failed</div>";
    exit;
}
$email=$_GET['email'];
$newemail=$_GET['newemail'];
$key=$_GET['key'];
$email=mysqli_real_escape_string($link, $email);
$newemail=mysqli_real_escape_string($link, $newemail);
$key=mysqli_real_escape_string($link, $key);
$sql="UPDATE users SET user_email='$newemail', activation2='0' WHERE (user_email='$email' AND activation2='$key') LIMIT 1";
$result=mysqli_query($link, $sql);
if (mysqli_affected_rows($link)==1){
    session_destroy();
    setcookie("rememberme","",time()-6000);
    echo "<div class='alert alert-success'>Account Activated</div>";
    echo '<a href="index.php" type="button" class="btn btn-lg btn-success">Login</a>';
    echo "<br/>";
}else{
    echo "<div class='alert alert-danger'>Account Activation Failed Or Already Activated</div>";
}
?>
            </div>
</div>
    </div>
</div>
    <script src="js/bootstrap.js"></script>
</body>
 
</html>

