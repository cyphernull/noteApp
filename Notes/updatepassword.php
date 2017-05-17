<?php
session_start();
include("connection.php");
$missingCPassword="<p>Please Enter Your Password</p>";
$incorrectCPassword="<p>Your Passworld Is Not Correct</p>";
$invalidPassword="<p>Please Enter A Valid Password</p>";
$missingPassword="<p>Please Enter A Password</p>";
$missingPassword2="<p>Please Confirm Your Password</p>";
$differentPassword="<p>Password Confirm Failed</p>";
$errors='';
if (empty($_POST["Cpassword"])){
    $errors.=$missingCPassword;
}else{
    $c_pass=$_POST["Cpassword"];
    $c_pass=filter_var($c_pass, FILTER_SANITIZE_STRING);
    $c_pass=mysqli_real_escape_string($link, $c_pass);
    $c_pass=hash('sha256', $c_pass);
    $user_id=$_SESSION["user_id"];
    $sql="SELECT user_password FROM users WHERE user_id='$user_id'";
    $result=mysqli_query($link, $sql);
    $count=mysqli_num_rows($result);
    if ($count!==1){
        echo "<div class='alert alert-danger'>Query Error</div>";
    }else{
        $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ($c_pass!=$row["user_password"]){
            $errors.=$incorrectCPassword;
        }
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
    $resultMess="<div class='alert alert-danger'>".$errors."</div>";
    echo $resultMess;
}else{
    $password=mysqli_real_escape_string($link, $password);
    $password=hash('sha256', $password);
    $sql="UPDATE users SET user_password='$password' WHERE user_id='$user_id'";
    $result=mysqli_query($link, $sql);
    if (!$result){
        echo "<div class='alert alert-danger'>An error occurred</div>";
    }else {
        echo "<div class='alert alert-success'>Password Updated</div>";
    }
    
}

?>