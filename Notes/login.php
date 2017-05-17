<?php
session_start();
include("connection.php");
$missingEmail="<p>Please Enter Your Email Address</p>";
$missingPassword="<p>Please Enter Your Password</p>";
$errors='';
if (empty($_POST["login-email"])){
    $errors.=$missingEmail;
}else{
    $email=filter_var($_POST["login-email"], FILTER_SANITIZE_EMAIL);
}
if (empty($_POST["login-password"])){
    $errors.=$missingPassword;
}else{
    $password=filter_var($_POST["login-password"], FILTER_SANITIZE_STRING);
}
if ($errors){
    $result= "<div class='alert alert-danger'>".$errors."</div>";
    echo $result;
}else{
    @$email=mysqli_real_escape_string($link, $email);
    @$password=mysqli_real_escape_string($link, $password);
    $password = hash('sha256', $password);
    $sql="SELECT * FROM users WHERE user_email='$email' AND user_password='$password' AND activation='activated'";
    $results=mysqli_query($link, $sql);
    if (!$results){
        echo "fail";
        exit;
    }
    $count=mysqli_num_rows($results);
    if ($count!=1){
        echo "<div class='alert alert-danger'>Wrong Password Or Email</div>";
    }else{
        $row=mysqli_fetch_array($results, MYSQLI_ASSOC);
        $_SESSION['user_id']=$row["user_id"];
        $_SESSION['user_name']=$row["user_name"];
        $_SESSION['user_email']=$row["user_email"];
        if (empty($_POST["rememberMe"])){
           echo "success";
        }else{
            $authentificator1=bin2hex(openssl_random_pseudo_bytes(10));
            $authentificator2=openssl_random_pseudo_bytes(20);
            function f1($a, $b){
                $c=$a.",".bin2hex($b);
                return $c;
            }
            $cookievalue= f1($authentificator1,$authentificator2);
            setcookie(
                "rememberme",
                $cookievalue,
                time()+1296000
            );
            function f2($a){
                $b= hash('sha256', $a);
                return $b;
            }
            $f2authentificator2=f2($authentificator2);
            $user_id=$_SESSION['user_id'];
            $expiration=date("Y-m-d H:i:s", time()+1296000);
            $sql="INSERT INTO rememberme (authentificator1,f2authentificator2,user_id,expires) VALUES ('$authentificator1','$f2authentificator2','$user_id','$expiration')";
            $result=mysqli_query($link, $sql);
            if (!$result){
                echo "error";
                echo mysqli_error($link);
            }else{
                echo "success";
            }
        }
    }
}








?>