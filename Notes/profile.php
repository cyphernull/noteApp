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
    <title>My Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styling.css">
    <script src="js/jquery.js"></script>
    <style>
        .container{
            margin-top: 87px;
        }
        #notepad, #all, #done{
            display: none;
        }
        .btns{
            margin-bottom: 24px;
        }
        textarea{
            width: 100%;
            max-width: 100%;
            font-size: 1.2em;
            line-height: 1.5em;
            border-left: 20px rgb(210, 253, 94) solid;
            border-color: rgb(210, 253, 94);
            background-color: #edf7de;
            padding: 10px;
            color: rgb(41, 41, 41);
        }
        tr{
            cursor: pointer;
            font-size: 2em;
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
                <li class="active"><a href="#">Profile</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="mainpageloggedin.php">My notes</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Welcome <b><?php echo $username?></b></a></li>
                <li><a href="index.php?logout=1">Log out</a></li>
            </ul>    
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <h1> Account Settings</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-condensed">
<!--
                   <th>hhh</th>
                   <th>hhh</th>
                   <th>hhh</th>
-->
                    <tr data-target="#updateusername" data-toggle="modal">
                        
                        <td>Username</td>
                        <td><?php echo $username?></td>
                    </tr>
                    <tr data-target="#updateemail" data-toggle="modal">
                        <td>Email</td>
                        <td><?php echo $email?></td>
                    </tr>
                    <tr data-target="#updatepassword" data-toggle="modal">
                        <td>password</td>
                        <td><?php echo "........."?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<form method="post" id="updateusername-form">
    <div class="modal fade" id="updateusername" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" data-dismiss="modal">
                &times;
              </button>
              <h4 id="myModalLabel">
                Edit username
              </h4>
          </div>
          <div class="modal-body">
           <div id="updateusernameMessage">
               
           </div>
            <div class="form-group">
                <label for="username">New username:</label>
                <input type="text" class="form-control" name="username" maxlength="30" id="username" value="<?php echo $username?>">
            </div> 
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn green" name="login" value="Submit">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
</form>
<form method="post" id="updateemail-form">
    <div class="modal fade" id="updateemail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" data-dismiss="modal">
                &times;
              </button>
              <h4 id="myModalLabel">
                Edit email
              </h4>
          </div>
          <div class="modal-body">
           <div id="updateemailMessage">
               
           </div>
            <div class="form-group">
                <label for="email">New email:</label>
                <input type="email" class="form-control" name="email" maxlength="50" id="email" value="<?php echo $email?>">
            </div> 
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn green" name="login" value="Submit">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
</form>
<form method="post" id="updatepassword-form">
    <div class="modal fade" id="updatepassword" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" data-dismiss="modal">
                &times;
              </button>
              <h4 id="myModalLabel">
                Edit password
              </h4>
          </div>
          <div class="modal-body">
           <div id="updatepasswordMessage">
               
           </div>
            <div class="form-group">
                <label for="password" class="sr-only">Current password:</label>
                <input type="password" class="form-control" name="Cpassword" maxlength="30" id="password" placeholder="Current password">
            </div>
            <div class="form-group">
                <label for="password" class="sr-only">New password:</label>
                <input type="password" class="form-control" name="password" maxlength="30" id="password" placeholder="new password">
            </div>
            <div class="form-group">
                <label for="password2" class="sr-only">Confirm password:</label>
                <input type="password" class="form-control" name="password2" maxlength="30" id="password2" placeholder="confirm password">
            </div>   
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn green" name="login" value="Submit">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancel
            </button>
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
    <script src="profile.js"></script>
</body>
 
</html>












