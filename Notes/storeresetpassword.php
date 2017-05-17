<?php
session_start();
include("connection.php");
if (!isset($_POST['user_id'])||!isset($_POST["key"])){
    echo "error1";
    exit;
}
$user_id=$_POST['user_id'];
$key=$_POST['key'];
$time=time()-86400;
$user_id=mysqli_real_escape_string($link, $user_id);
$key=mysqli_real_escape_string($link, $key);
$sql="SELECT user_id FROM forgotpassword WHERE activate_key='$key' AND user_id='$user_id' AND time>'$time' AND status='pending'";
$result=mysqli_query($link, $sql);
if (!$result){
    echo "Error2";
    exit;
}
$count=mysqli_num_rows($result);
if ($count!=1){
    echo "wrong4";
    exit;
}
$missingPassword="<p>Please Enter A Password</p>";
$invalidPassword="<p>Please Enter A Valid Password</p>";
$missingPassword2="<p>Please Confirm Your Password</p>";
$differentPassword="<p>Password Confirm Failed</p>";
$errors="";
if (empty($_POST["password"])){
    $errors.=$missingPassword;
}elseif(!(strlen($_POST["password"])>6 and preg_match('/[A-Z]/',$_POST["password"]) and preg_match('/[0-9]/',$_POST["password"]))) {
    $errors.=$invalidPassword;
}else{
    $password=filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    if (empty($_POST["password2"])){
        $errors.=$missingPassword2;
    }else{
        $password2=filter_var($_POST["password2"], FILTER_SANITIZE_STRING);
        if ($password!==$password2){
            $errors.=$differentPassword;
        }
    }
}
if ($errors){
    $resultMessage="<div class='alert alert-danger'>".$errors."</div>";
    echo $resultMessage;
    exit;
}
@$password=mysqli_real_escape_string($link, $password);
$password= hash('sha256',$password);
@$user_id=mysqli_real_escape_string($link, $user_id);
$sql="UPDATE users SET user_password='$password' WHERE user_id='$user_id'";
$result=mysqli_query($link, $sql);
if (!$result){
    echo "Error5";
    exit;
}
$sql="UPDATE forgotpassword SET status='used' WHERE activate_key='$key' AND user_id='$user_id'";
$result=mysqli_query($link, $sql);
if (!$result){
    echo "Error6";
}else{
echo "<div class='alert alert-success'>Updated<a href='index.php'>Login</a></div>";
}
?>