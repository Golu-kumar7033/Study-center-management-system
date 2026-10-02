$(document).ready(function(){


    // Show home by default
    $("#home").show();

    $(".taboption").click(function(){
        $(".section").hide();
        var id = $(this).data("id");
        $("#" + id).show();
    });

    function generateSeats(containerId, hallName, seatCount) {
        for (let i = 1; i <= seatCount; i++) {
            $("#" + containerId).append(
                '<div class="col-3 mb-2">' +
                    '<div class="card p-3 bg-primary text-white seat">' +
                        hallName + '-S' + i +
                    '</div>' +
                '</div>'
            );
        }
    }
    generateSeats("seatContainer", "H1", 30);
    generateSeats("seatContainer2", "H2", 30);

  
});