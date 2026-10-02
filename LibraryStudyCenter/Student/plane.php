<?php 
require "../checklogin.php";
require "../database.php";

$slot_id = (int)$_GET['slot_id'] ;
$seat_id = (int)$_GET['seat_id'] ;

var_dump($slot_id,$seat_id);

$plans = mysqli_query($conn, "SELECT * FROM plans");
?>

<?php require "navbar.html"; ?>

<div class="container ">
    <h2 class="text-center  mb-4" style="margin-top:70px">Choose Plan</h2>

    <div class="row">
        <?php while($plan = mysqli_fetch_assoc($plans)) { ?>
            <div class="col-md-4 mb-4">
    <div class="card plan-card h-100 border-0 shadow-sm text-center">

        <div class="card-body p-4">

            <span class="badge bg-primary mb-3">Popular</span>

            <h4 class="fw-bold text-dark">
                <?= $plan['plan_name'] ?>
            </h4>

            <h2 class="text-primary text-warning fw-bold my-3">
                ₹ <?= number_format($plan['amount']) ?>
            </h2>

            <p class="text-muted mb-4">
                <i class="fa-solid fa-calendar-days me-2"></i>
                <?= $plan['duration_days'] ?> Days
            </p>

            <a href="booked.php?slot_id=<?= $slot_id ?>&seat_id=<?= $seat_id ?>&plan_id=<?= $plan['plan_id'] ?>"
               class="btn btn-primary w-100 rounded-pill">
                <i class="fa-solid fa-check me-2"></i>
                Select Plan
            </a>

        </div>

    </div>
</div>
        <?php } ?>
    </div>
</div>

<?php require_once "footer.html"; ?>