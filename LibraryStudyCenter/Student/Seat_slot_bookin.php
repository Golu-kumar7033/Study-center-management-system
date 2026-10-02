<?php 
require "../checklogin.php";
require "../database.php";

$slotdata = mysqli_query($conn, "SELECT * FROM time_slot ORDER BY id");
?>

<?php include_once("navbar.html");?>

<div class="slots" >
    <h2 class="text-center mb-4" style="margin-top:100px;">Select ⌛ Time Slot</h2>

    <div class="d-flex flex-wrap gap-3 justify-content-center">
        <?php while($slot = mysqli_fetch_assoc($slotdata)) { 
             $start = $slot['start_time'];
        $end   = $slot['end_time'];

            ?>

            <a href="seats.php?slot_id=<?= $slot['id'] ?>" 
               class="btn border-primary slots p-3 mt-4  fs-3 " id="slot">
               <?= $start . " - " . $end?>
            </a>
        <?php } ?>
    </div>
</div>

<?php require_once "footer.html"; ?>