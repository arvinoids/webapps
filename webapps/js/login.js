$("#btn-submit").click(function (e) { 
    
    $.ajax({
        type: "POST",
        url: "ldaplogin.php",
        data: {
            username: $("#username").val(),
            password: $("#password").val()
        },
        dataType: "text",
        success: function (data, textStatus, jqXHR) {
           // alert(jqXHR.responseText);
                
        },
        error: function(jqXHR, textStatus, errorThrown) {

            alert(jqXHR.status + " " + errorThrown);
        }
    });

});

// submission flow
