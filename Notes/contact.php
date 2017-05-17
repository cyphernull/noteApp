<?php
$name=$_POST["cname"];
$email=$_POST["cemail"];
$message=$_POST["mes"];
$errors='';
$missing_name ='<p>Please enter your name!</>';
$missing_email ='<p>Please enter your Email!</>';
$invalid_email ='<p>Please enter your <strong>Valid</strong> Email!</>';
$missing_message ='<p>Please enter your Messages!</>';
if (empty($name)){
    $errors.=$missing_name;
}else{
    $name=filter_var($name, FILTER_SANITIZE_STRING);
}
if (empty($email)){
    $errors.=$missing_email;
}else{
    $email=filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors.=$invalid_email;
    }
}
if (empty($message)){
    $errors.=$missing_message;
}else {
    $message=filter_var($message, FILTER_SANITIZE_STRING);
}
if ($errors){
    $resultMessage='<div class="alert alert-danger">'.$errors.'</div>';
    
}else{
   require_once("email-functions.php");
   $to="eric.choo1997@yahoo.com";
   $subjet="Contact";
   $message = "
   <p>Name: $name.</p>
   <p>Email: $email.</p>
   <p>Message:</p>
   <p><strong>$message</strong></p>"; 
   $flag = sendMail($to,$subjet,$message);
   if($flag){
        $resultMessage='<div class="alert alert-success">Thanks For Your Message.</div>';
   }else{
        $resultMessage='<div class="alert alert-warning">Web Error.</div>';
    }
}
echo $resultMessage;
?>