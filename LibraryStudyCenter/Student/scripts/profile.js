
$(document).ready(function(){
       
    $.ajax({
        url: "fetchdata.php",
        type: "POST",
        dataType: "json",
        success: function(data){
            $("#studentname").html(data.student_name);
            let img = data.student_image;

            if (img && img.trim() !== "") {
                $("#studentimg").attr("src", "../Imguploads/" + img);
            } else {
                $("#studentimg").attr("src", "image/he.png"); // default image
            }
            $("#about-data").html(`
                <p><i class="fas fa-envelope text-primary"></i> ${data.student_email}</p>
                <p><i class="fas fa-phone text-success"></i> ${data.student_phone}</p>
                <p><i class="fa-solid fa-mars-stroke text-success"></i> ${data.student_gender}</p>

                <p><i class="fas fa-map-marker-alt text-danger"></i> ${data.permanent_address}</p>
            `);
        }  
    });

        $.ajax({
            url:"fetchdata.php",
            type:"POST",
            dataType:"json",
            success:function(data){
               $("#name").val(data.student_name);
               $("#email").val(data.student_email);
               $("#phone").val(data.student_phone);
               $("#address").val(data.permanent_address);
               let img = data.student_image;
                if (img && img.trim() !== "") {
                    $("#studentimg").attr("src", "../Imguploads/" + img);
                } else {
                    $("#studentimg").attr("src", "image/he.png"); // default image
                }


            },
            

        });
    
});