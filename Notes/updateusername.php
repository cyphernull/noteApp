<?php
session_start();
include("connection.php");
$id=$_SESSION["user_id"];
$username=$_POST["username"];
$sql="UPDATE users SET user_name='$username' WHERE user_id='$id'";
$result=mysqli_query($link, $sql);
if (!$result){
    echo "<div class='alert alert-danger'>An error occurred</div>";
}else {
    echo "<div class='alert alert-success'>Username Updated</div>";
}
?>