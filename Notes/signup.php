<?php
session_start();
include ("connection.php");
$missingUsername="<p>Please Enter A Username</p>";
$missingEmail="<p>Please Enter An Email Address</p>";
$invalidEmail="<p>Please Enter A Valid Email Address</p>";
$missingPassword="<p>Please Enter A Password</p>";
$invalidPassword="<p>Your Password Must Contain At Least Six Numbers With At Least One Capital Letter</p>";
$missingPassword2="<p>Please Confirm Your Password</p>";
$differentPassword="<p>Password Confirm Failed</p>";
$errors='';
if (empty($_POST["username"])){
    $errors.=$missingUsername;
}else{
    $username=filter_var($_POST["username"], FILTER_SANITIZE_STRING);
}
if (empty($_POST["email"])){
    $errors.=$missingEmail;
}else{
    $email=filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors.=$invalidEmail;
    }
}
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
}else{

@$username=mysqli_real_escape_string($link, $username);
@$email=mysqli_real_escape_string($link, $email);
@$password=mysqli_real_escape_string($link, $password);
$password= hash('sha256',$password);
@$sql="SELECT * FROM users WHERE user_name='$username'";
$result=mysqli_query($link, $sql);
if (!$result){
    echo "<div class='alert alert-danger'>Wrong Query</div>";
    exit;
}
$results=mysqli_num_rows($result);
if ($results){
    echo "<div class='alert alert-danger'>This Username Has Already Been Regitered Please Login</div>";
    exit;
}
$sql="SELECT * FROM users WHERE user_email='$email'";
$result=mysqli_query($link, $sql);
if (!$result){
    echo "<div class='alert alert-danger'>Wrong Query</div>";
    exit;
}
$results=mysqli_num_rows($result);
if ($results){
    echo "<div class='alert alert-danger'>This Email Has Already Been Regitered Please Login</div>";
    exit;
}
$activation_key=bin2hex(openssl_random_pseudo_bytes(16));
$sql="INSERT INTO users (user_name,user_email,user_password,activation) VALUES ('$username','$email','$password','$activation_key')";
$result=mysqli_query($link, $sql);
if (!$result){
    echo "<div class='alert alert-danger'>Wrong Query</div>";
    echo mysqli_error($link);
}else{
$to=$email;
$subjet="Confirm Your Email Address";
$message="<p>Please click on this link to activate your account</p>";
$message.="<a href="."http://www.ericchoo.s1.natapp.cc/Notes/activate.php?email=".urlencode($email)."&key=$activation_key".">Activate</a>";
require_once("email-functions.php");
$flag = sendMail($to,$subjet,$message);
if($flag){
     echo '<div class="alert alert-success">An Email Has Been Sent To Your Email Account.</div>';
}else{
     echo '<div class="alert alert-warning">Web Error.</div>';
}
}
}
?>






















