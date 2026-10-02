
    $(document).ready(function(){

       $.ajax({
            url: "fetchslot.php",
            type: "POST",
            dataType: "html",
            success: function(response) {
                $("#slots").html(response);
            }
        });

    });