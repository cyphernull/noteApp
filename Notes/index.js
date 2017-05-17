$("#signup-form").submit(function(event){
    event.preventDefault();
    var datatopost = $(this).serializeArray();
    $.ajax({
        url: "signup.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if (data){
                $("#signupMessage").html(data);
            }
        },
        error: function(data){
            $("#signupMessage").html("<div class='alert alert-danger'>There was an error<div>");
        }
    });
//    $.post({}).done().fail();
});
$("#login-form").submit(function(event){
    event.preventDefault();
    var datatopost = $(this).serializeArray();
    $.ajax({
        url: "login.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if (data=="success"){
                window.location="mainpageloggedin.php";
            }else{
                $("#loginMessage").html(data);
            }
        },
        error: function(data){
            $("#loginMessage").html("<p>error</p>");
        }
    });
//    $.post({}).done().fail();
});

$("#forgotpasswordform").submit(function(event){ 
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    console.log("ajax");
    var datatopost = $(this).serializeArray();
    console.log(datatopost);
    //send them to signup.php using AJAX
    $.ajax({
        url: "forgot-password.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            console.log("ajax");
            $('#forgotpasswordmessage').html(data);
        },
        error: function(){
            console.log("ajax");
            $("#forgotpasswordmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
    });

});
$("#contact-form").submit(function(event){
    console.log("ajax");
    event.preventDefault();
    var datatopost = $(this).serializeArray();
    $.ajax({
    url: "contact.php",
    type: "POST",
    data: datatopost,
    success: function(data){
        console.log("ajax");
        $('#contactMessage').html(data);
    },
    error: function(){
        console.log("ajax");
        $("#contactMessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
        
    }
    
    });
//    $.post({}).done().fail();
});
