<?php
require "login/chacklogin.php";
$ms="";
if(isset($_GET['ms']) && $_GET['ms']!=''){
    $ms=$_GET['ms'];
}
?>

       
  

<?php include("navbar.html"); ?>
    <div class="d-flex align-items-center justify-content-center mb-4" style="margin-top:100px">
        <h1 class="me-3">⌛ Time Slot</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            + Create Slot
        </button>
    </div>

    <!-- Slots Display -->
    <div class="container">
        <div class="row "id="slots">
        </div>
    </div>
    
    <div class="d-flex justify-content-center mt-3">
    <?php if(!empty($ms)):?>
        <span class="alert alert-danger"><?=$ms?></span>
    <?php endif?>
    </div>  

    <!-- Create Slot Modal -->
    <div class="modal mt-5 fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title">Create Slot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form action="create_slot.php" method="POST">
                        
                        <div class="mb-3">
                            <label>Slot Name</label>
                            <input class="form-control" type="text" name="slot_name" required>
                        </div>

                        <div class="mb-3">
                            <label>Start Time</label>
                            <div class="d-flex gap-2">
                                <input class="form-control" type="time" name="start_time" required>
                                <select class="form-control" name="ampm">
                                    <option value=":AM">AM</option>
                                    <option value=":PM">PM</option>
                                </select>
                            </div>                        
                        </div>

                        <div class="mb-3 ">
                            <label class="form-contrl">End Time</label>
                            <div class="d-flex gap-2">
                                <input class="form-control" type="time" name="end_time" required>
                                <select class="form-control" name="ampme">
                                    <option value=":AM">AM</option>
                                    <option value=":PM">PM</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Create</button>
                    
                    </form>
                </div>

            </div>
        </div>
    </div>


<?php require_once "footer.php"?>