 <?php
  require "login/chacklogin.php";
                                      require "../database.php";
 ?>


    <?php include("navbar.html"); ?>

        <main class="comtainer mt-3 g-3" >
            <div class="row">
                <div class=" mt-3 col-lg-4 col-md-6 mb-3">
                    <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                        <div class="d-flex align-items-center justify-content-between">

                            <!-- Left Side -->
                            <div class="d-flex align-items-center">
                                <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                    style="width: 60px; height: 60px; background-color: #397e64;">
                                    <i class="bi bi-credit-card fs-3"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0 text-dark">
                                    <?php
                                        $sql = "SELECT COUNT(*) AS TOTAL FROM plans";

                                        $stmt = mysqli_prepare($conn, $sql);

                                        if ($stmt) {
                                            mysqli_stmt_execute($stmt);
                                            $result = mysqli_stmt_get_result($stmt);
                                            $row = mysqli_fetch_assoc($result);

                                            $total = $row['TOTAL'];
                                        } else {
                                            echo "Error: " . mysqli_error($conn);
                                            exit;
                                        }
                                        echo $total;

                                        
                                    ?></h4>
                                    <p class="text-muted mb-0">Total Planes</p>
                                </div>
                            </div>

    
                        </div>
                    </div>
                </div>
               
                <!--card 4-->
                <div class=" mt-3 col-lg-4 col-md-6 mb-3">
                    <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                        <div class="d-flex align-items-center justify-content-between">

                            <!-- Left Side -->
                            <div class="d-flex align-items-center">
                                <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                    style="width: 60px; height: 60px; background-color: #fef2f2;">
                                    <i class="bi bi-person-check-fill"></i>     
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0 text-dark">0</h4>
                                    <p class="text-muted mb-0">Total Revenue</p>
                                </div>
                            </div>

                            <!-- Right Side -
                            <div>                                                
                                <a href="#seats" class="text-primary  text-decoration-none">
                                View All
                                <i class="bi bi-arrow-bar-right"></i>
                                </a>           
                            </div>
                                            -->
                        </div>
                    </div>
                </div>

            </div>

           <?php
                $ms = "";
                if (isset($_GET['ms']) && $_GET['ms'] != '') {
                    $ms = $_GET['ms'];
                    echo"<div class='d-flex justify-content-center'><strong class='p-3 alert alert-success px-5 mt-5'>$ms</strong></div>
                    
                    ";
                }
                ?>

            <div class="row">
                <div class="col-lg-12">
                    <h1>Plans</h1>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#exampleModal">+ CREATE PLANE</button>
                    </div>
                    <!--plane-->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Create new plane</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="create_plane.php" method="POST">
                                    <div class="mb-3">
                                        <label  for="name" class="form-label">Plan Name</label>
                                        <input class="form-control" type="text"  name="pname" id="name" required >
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Membership Fee</label>
                                        <input class="form-control" name="price" type="text" id="price"required >
                                    </div>
                                    <div class="mb-3">
                                        <label for="duration" class="form-label">Duration</label>
                                        <input class="form-control" type="text" name="ptime" id="duration" required >
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="features" class="form-label">Features</label>
                                        <textarea class="form-control"name="feture" id="features" style="resize:none;" name="features"  placeholder="Enter each feature separated by a comma" ></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="createplan"> Create</button>
                                </form>
                            </div>
                        </div>
                    </div>                   

                </div>
            </div>           
        </main>
        <section id="plans" class="mt-5 container-fluid ">
                        
            <?php
            require "../database.php";

            $result = mysqli_query($conn, "SELECT * FROM plans");

            if ($result && mysqli_num_rows($result) > 0) {

                echo "<div class='table-responsive'>";
                echo "<table id='slotTable' class='table table-striped text-center' style=' border-radius: 8px; overflow: hidden;'>";
                echo "<thead class='table-dark'>";
                echo "<tr>";
                echo "<th>SNO.</th>";
                echo "<th>Plane Name</th>";
                echo "<th>Plane Fee</th>";

                echo "<th>Create Date</th>";
                echo "<th>Actions</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $sno=0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $sno=$sno+1;
                   $plan_id= $row['plan_id'];
                   
                    echo "<tr>";
                    echo "<td>".$sno."</td>";
                    echo "<td>" . htmlspecialchars($row['plan_name']) . "</td>";
                    echo "<td>" ."🪙" . htmlspecialchars($row['amount']) . "</td>";

                    echo "<td>" . date('Y:m:d h:m A',strtotime($row['created_at'])). "</td>";
                    echo "<td>";

                    echo "<a href='deleteplane.php?id=" .$plan_id. "' class='btn btn-danger btn-sm mb-3' onclick=\"return confirm('Are you sure?')\">Delete</a>";

                    echo "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";

            } else {
                echo "<p class='text-center'>No plan available.</p>";
            }
            ?>
            
        </section>
<?php require_once "footer.php"?>
