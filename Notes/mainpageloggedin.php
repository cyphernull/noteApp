<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
include("connection.php");
$user_id=$_SESSION['user_id'];
$sql="SELECT * FROM users WHERE user_id='$user_id'";
$result=mysqli_query($link, $sql);
$count=mysqli_num_rows($result);
if ($count==1){
    $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
    $username=$row["user_name"];
    $email=$row["user_email"];
}else{
    echo "Error1";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Notes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styling.css">
    <script src="js/jquery.js"></script>
    <style>
        body{
            font-family: sans-serif;
            background: url("images/vector-notepad.png") no-repeat center center;
            background-attachment: fixed;
            background-size: cover;
        }
        .container{
            margin-top: 120px;
        }
        @media(max-width: 768px){
            .container{
                margin-top: 80px;
            }
        }
        #notepad, #all, #done{
            display: none;
        }
        #notepad{
            margin-bottom: 30px;
        }
        .btns{
            margin-bottom: 24px;
        }
        textarea{
            width: 100%;
            max-width: 100%;
            font-size: 1.2em;
            line-height: 1.5em;
            border-left: 20px rgb(87, 88, 45) solid;
            border-color: rgb(87, 88, 45);
            background-color: #edf7de;
            padding: 10px;
            color: rgb(41, 41, 41);
        }
        .delete{
            display: none;
        }
        .noteheader{
            border: 1px solid grey;
            border-radius: 10px;
            
            cursor: pointer;
            padding: 10px;
            font-size: 0.9em;
            background: linear-gradient(#ffffff, #c0c0c0);
        }
        .note{
            margin-bottom: 10px;
            height: 70px;
/*            line-height: 70px;*/
        }
        .btn-danger{
            line-height: 45px;
        }
        .note:last-child{
            margin-bottom: 55px;
        }
        .clearfix:after{ 
　　         content:''; 
　　         display:block; 
　　         height:0; 
　　         font-size:0; 
　　         clear:both; 
　　         overflow:hidden; 
        } 
        .text{
            font-size: 1.55em;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .timetext{
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body>
<nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
        <a href="#" class="navbar-brand">Online Notes</a>
        <button type="button" class="navbar-toggle" data-target="#navbar-collapse" data-toggle="collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="profile.php">Profile</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="#contact-modal" data-toggle="modal">Contact Us</a></li>
                <li class="active"><a href="#">My notes</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Welcome <b><?php echo $username?></b></a></li>
                <li><a href="index.php?logout=1">Log out</a></li>
            </ul>    
        </div>
    </div>
</nav>
<div class="container">
   <div class="alert alert-danger collapse">
       <a class='close' data-dismiss='alert'>&times;</a>
       <p id="alertContent"></p>
   </div>
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="btns">
                <button type="button" class="btn btn-info btn-lg func" id="add">Add Notes</button>
                <button type="button" class="btn btn-info btn-lg pull-right func" id="edit">Edit</button>
                <button type="button" class="btn green btn-lg pull-right func" id="done">Done</button>
                <button type="button" class="btn btn-info btn-lg func" id="all">Save</button>
            </div>
            <div id="notepad">
                <textarea rows="10"></textarea>
            </div>
            <div id="notes" class="notes">
                <!--ajax-->
            </div>
        </div>
    </div>
</div>
<form method="post" id="contact-form">
    <div class="modal fade" id="contact-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" data-dismiss="modal">
                &times;
              </button>
              <h4 id="myModalLabel">
                Contact Us
              </h4>
          </div>
          <div class="modal-body">
           <div id="contactMessage">
               
           </div>
            <div class="form-group">
                <label for="cname">Name</label>
                <input type="text" class="form-control" name="cname" placeholder="Name" maxlength="30" id="cname">
            </div>
            <div class="form-group">
                <label for="cemail">Email</label>
                <input type="text" class="form-control" name="cemail" placeholder="Email Address" maxlength="50" id="cemail">
            </div>
            <div class="form-group">
                <label for="mes">Message</label>
                <textarea class="form-control" name="mes" row="5" id="mes"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn green" name="submitmes" value="Send Message">
          </div>
        </div>
      </div>
    </div>
</form>
<div class="footer">
    <div class="container-fluid">
        <p>Eric Choo &copy; <?php $today =date("Y"); echo $today; ?></p>
    </div>
</div>
    <script src="js/bootstrap.js"></script>
    <script src="mynotes.js"></script>
    <script>
        $(function(){
            window.onresize=function(){
        var wid=$(window).width();
        if (wid <=768){
            $(".func").removeClass("btn-lg");
        }
        if (wid >=769){
            $(".func").addClass("btn-lg");
        }
            };
        });
    </script>
    <script src="index.js"></script>
</body>
 
</html>












