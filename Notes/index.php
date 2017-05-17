<?php
session_start();
include("connection.php");
@include("logout.php");
include("remember.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Note App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styling.css">
    <style>
        body{
    font-family: sans-serif;
    background: url("images/wallpaper02.jpg") no-repeat center center;
    background-attachment: fixed;
    background-size: cover;
}
    .contact-form{
            border: 1px solid #c0c0c0;
            margin-top: 30px;
            border-radius: 10px;
            box-shadow: 3px 3px 16px #c0c0c0;
        }
    </style>
    <script src="js/jquery.js"></script>
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
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="#contact-modal" data-toggle="modal">Contact Us</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#login-modal" data-toggle="modal">Login</a></li>
            </ul>    
        </div>
    </div>
</nav>
<div class="jumbotron" id="myContainer">
    <h1>Online Notes App</h1>
    <p>Note wherever you go</p>
    <p>Easy and Secure</p>
    <button type="button" class="btn btn-lg green signup" data-target="#signup-modal" data-toggle="modal">Sign up for FREE</button>
</div>
<form method="post" id="login-form">
    <div class="modal fade" id="login-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" data-dismiss="modal">
                &times;
              </button>
              <h4 id="myModalLabel">
                Login
              </h4>
          </div>
          <div class="modal-body">
           <div id="loginMessage">
               
           </div>
            <div class="form-group">
                <label class="sr-only" for="login-email">Email</label>
                <input type="text" class="form-control" name="login-email" placeholder="Email Address" maxlength="50" id="login-email">
            </div>
            <div class="form-group">
                <label class="sr-only" for="login-password">Password</label>
                <input type="password" class="form-control" name="login-password" placeholder="Password" maxlength="30" id="login-password">
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="rememberMe" id="rememberMe">Remember me</label>
                <a href="#forgotpasswordform" class="pull-right" data-dismiss="modal" data-target="#forgotpasswordModal" data-toggle="modal">Forgot Password?</a>
            </div>
            
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn green" name="login" value="Log in">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancel
            </button>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="#signup-modal" data-toggle="modal">
              Register
            </button>
          </div>
        </div>
      </div>
    </div>
</form>
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
<form method="post" id="signup-form">
    <div class="modal fade" id="signup-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" data-dismiss="modal">
                &times;
              </button>
              <h4 id="myModalLabel">
                Sign Up and Start To Use
              </h4>
          </div>
          <div class="modal-body">
           <div id="signupMessage">
               
           </div>
            <div class="form-group">
                <label class="sr-only" for="username">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username" maxlength="30" id="username">
            </div>
            <div class="form-group">
                <label class="sr-only" for="email">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Email Address" maxlength="50" id="email">
            </div>
            <div class="form-group">
                <label class="sr-only" for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" maxlength="30" id="password">
            </div>
            <div class="form-group">
                <label class="sr-only" for="password2">Confirm Password</label>
                <input type="password" class="form-control" name="password2" placeholder="Confirm Password" maxlength="30" id="password2">
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn green" name="signup" value="Sign up">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
</form>
<form method="post" id="forgotpasswordform">
        <div class="modal fade" id="forgotpasswordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">
                    &times;
                  </button>
                  <h4 id="myModalLabel">
                    Forgot Password? Enter your email address: 
                  </h4>
              </div>
              <div class="modal-body">
                  
                  <!--forgot password message from PHP file-->
                  <div id="forgotpasswordmessage"></div>
                  
                                       
                  <div class="form-group">
                      <label for="forgotemail" class="sr-only">Email:</label>
                      <input class="form-control" type="email" name="forgotemail" id="forgotemail" placeholder="Email" maxlength="50">
                  </div>
              </div>
              <div class="modal-footer">
                  <input class="btn green" name="forgotpassword" type="submit" value="Submit">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                  Cancel
                </button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="#signup-modal" data-toggle="modal">
                  Register
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
    <script src="index.js"></script>
</body>
 
</html>












