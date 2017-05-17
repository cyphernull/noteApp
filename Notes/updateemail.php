<?php
session_start();
include("connection.php");
$user_id=$_SESSION["user_id"];
$newemail=$_POST["email"];
$sql="SELECT * FROM users WHERE user_email='$newemail'";
$result=mysqli_query($link, $sql);
$count=mysqli_num_rows($result);
if ($count>0){
    echo "<div class='alert alert-danger'>This email has already been signed up</div>";exit;
}
$sql="SELECT * FROM users WHERE user_id='$user_id'";
$result=mysqli_query($link, $sql);
$count=mysqli_num_rows($result);
if ($count==1){
    $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
    $username=$row["user_name"];
    $email=$row["user_email"];
}else{
    echo "Error1";
    exit;
}
$activation_key=bin2hex(openssl_random_pseudo_bytes(16));
$sql="UPDATE users SET activation2='$activation_key' WHERE user_id='$user_id'";
$result=mysqli_query($link, $sql);
if (!$result){
    echo "<div class='alert alert-danger'>Somthing Wrong</div>";
}else{
    require_once("email-functions.php");
    $to=$newemail;
    $subjet="Confirm Your New Email Address";
    $message="<p>Please click on this link to activate your account</p>";
    $message .= "<a href="."http://www.ericchoo.s1.natapp.cc/Notes/activatenewemail.php?email=" . urlencode($email) . "&newemail=" . urlencode($newemail) . "&key=$activation_key>"."Activate"."</a>";
    $flag = sendMail($to,$subjet,$message);
    if($flag){
        echo '<div class="alert alert-success">An Email Has Been Sent To Your Email Account.</div>';
    }else{
         echo '<div class="alert alert-warning">Web Error.</div>';
    }
}
?>