$(document).ready(function(){

   
$(".card").click(function () {

    if ($(this).hasClass("disabled")) return;

    let seat_id = $(this).data("seat-id");

    $(".card").removeClass('bg-warning').addClass('bg-primary-subtle');
    $(this).removeClass('bg-primary-subtle').addClass('bg-warning');

    $("#book").attr("href", "booked.php?slot_id=<?= $slot_id ?>&seat_id=" + seat_id);
});

});