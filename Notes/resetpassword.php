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
                <p>Reset Password</p>
            </div>
            <div id="resultmessage"></div>
<?php
session_start();
include("connection.php");
if (!isset($_GET['user_id'])||!isset($_GET["key"])){
    echo "error";
    exit;
}
$user_id=$_GET['user_id'];
$key=$_GET['key'];
$time=time()-86400;
$user_id=mysqli_real_escape_string($link, $user_id);
$key=mysqli_real_escape_string($link, $key);
$sql="SELECT user_id FROM forgotpassword WHERE activate_key='$key' AND user_id='$user_id' AND time>'$time' AND status='pending'";
$result=mysqli_query($link, $sql);
if (!$result){
    echo "Error";
    exit;
}
$count=mysqli_num_rows($result);
if ($count!=1){
    echo "wrong";
    exit;
}
echo "
<form method='post' id='passwordreset'>
<input type='hidden' name='key' value=$key>
<input type='hidden' name='user_id' value=$user_id>
<div class='form-group'>
<label for='password'>New Password</label>
<input name='password' id='password' class='form-control' type='password'>
</div>
<div class='form-group'>
<label for='password2'>Confirm Password</label>
<input name='password2' id='password2' class='form-control' type='password'>
</div>
<input type='submit' class='btn btn-success btn-lg' value='Reset' name='resetpassword'>
</form>
<br/>
";
?>
        </div>
    </div>
</div>
    <script src="js/bootstrap.js"></script>
    <script>
    $("#passwordreset").submit(function(event){ 
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    console.log("ajax");
    var datatopost = $(this).serializeArray();
    console.log(datatopost);
    //send them to signup.php using AJAX
    $.ajax({
        url: "storeresetpassword.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            console.log("ajax");
            $('#resultmessage').html(data);
        },
        error: function(){
            console.log("ajax");
            $("#resultmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
    });

});
    </script>
</body>
 
</html>









