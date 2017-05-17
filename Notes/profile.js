$("#updateusername-form").submit(function(event){
    event.preventDefault();
    var datatopost = $(this).serializeArray();
    $.ajax({
        url: "updateusername.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if (data){
                $("#updateusernameMessage").html(data);
            }else{
                location.reload();
            }
        },
        error: function(data){
            $("#updateusernameMessage").html("<div class='alert alert-danger'>There was an error<div>");
        }
    });
//    $.post({}).done().fail();
});

$("#updatepassword-form").submit(function(event){
    event.preventDefault();
    var datatopost = $(this).serializeArray();
    $.ajax({
        url: "updatepassword.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if (data){
                $("#updatepasswordMessage").html(data);
            }else{
                location.reload();
            }
        },
        error: function(data){
            $("#updatepasswordMessage").html("<div class='alert alert-danger'>There was an error<div>");
        }
    });
//    $.post({}).done().fail();
});

$("#updateemail-form").submit(function(event){
    event.preventDefault();
    var datatopost = $(this).serializeArray();
    $.ajax({
        url: "updateemail.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if (data){
                $("#updateemailMessage").html(data);
            }
        },
        error: function(data){
            $("#updateemailMessage").html("<div class='alert alert-danger'>There was an error<div>");
        }
    });
//    $.post({}).done().fail();
});