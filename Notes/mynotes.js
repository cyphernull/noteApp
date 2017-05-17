$(function(){
    //define variables
    var activeNote = 0;
    var editMode = false;
    //load notes on page load: Ajax call to loadnotes.php
    $.ajax({
        url: "loadnotes.php",
        success: function (data){
            $('#notes').html(data);
            clickonNote(); clickDelete();
            
        },
        error: function(){
            $('#alertContent').text("There was an error with the Ajax Call. Please try again later.");
                    $("#alert").fadeIn();
        }
    
    });
    $('#add').click(function(){
        $.ajax({
            url: "createnotes.php",
            success: function(data){
                if(data == 'error'){
                    $('#alertContent').text("There was an issue inserting the new note in the database!");
                    $("#alert").fadeIn();
                }else{
                    //update activeNote to the id of the new note
                    activeNote = data;
                    $("textarea").val("");
                    //show hide elements
                    showHide(["#notepad", "#all"], ["#notes", "#add", "#edit", "#done"]);
                    $("textarea").focus();
                    clickonNote(); clickDelete();
                    
                }
            },
            error: function(){
                $('#alertContent').text("There was an error with the Ajax Call. Please try again later.");
                    $("#alert").fadeIn();
            }
        
        
        });
    
    
    });
$("textarea").keyup(function(){
    $.ajax({
        url: "updatenotes.php",
        type: "POST",
        data: {note: $(this).val(), id: activeNote},
        success: function(data){
            if (data=="error"){
                $("#alertContent").text("There was something wrong");
            }
        },
        error: function(data){
            $("#alertContent").text("There was something wrong");
            $("#alert").fadeIn();
        }
        });
});
    $("#all").click(function(){
        $.ajax({
            url: "loadnotes.php",
            success: function (data){
                if (data=='error'){
                    window.alert("fuck");
                }
                $('#notes').html(data);
                showHide(["#add", "#edit", "#notes"], ["#all", "#notepad"]);
                clickonNote(); clickDelete();
            },
            error: function(){
                $('#alertContent').text("There was an error with the Ajax Call. Please try again later.");
                        $("#alert").fadeIn();
            }

        });
    
    });
    $("#done").click(function(){
        editMode=false;
        $(".noteheader").removeClass("col-xs-7 col-sm-9");
        showHide(["#edit"],[this, ".delete"]);
    });
    $("#edit").click(function(){
        editMode=true;
        $(".noteheader").addClass("col-xs-7 col-sm-9");
        showHide(["#done",".delete"],[this]);
    });
function clickonNote(){
$(".noteheader").click(function(){
    if (!editMode){
        activeNote=$(this).attr("id");
        $("textarea").val($(this).find(".text").text());
        showHide(["#notepad", "#all"],["#notes", "#add", "#edit", "#done"]);
        $("textarea").focus();
    }
});
}
function clickDelete(){
    $(".delete").click(function(){
        var deletebtn=$(this);
        $.ajax({
        url: "deletenote.php",
        type: "POST",
        data: {id:deletebtn.next().attr("id")},
        success: function(data){
            if (data=="error"){
                $("#alertContent").text("There was something wrong");
            }else{
                deletebtn.parent().remove();
            }
        },
        error: function(data){
            $("#alertContent").text("There was something wrong");
            $("#alert").fadeIn();
        }
        });
    });
}
function showHide(arr1, arr2){
    for (i=0; i<arr1.length; i++){
        $(arr1[i]).show();
    }
    for (i=0; i<arr2.length; i++){
        $(arr2[i]).hide();
    }
}   
});