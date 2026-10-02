 <?php
    require "login/chacklogin.php";
 ?>
     <?php include_once ("navbar.html"); ?>

        <main class=" mt-3 g-3" >
            <div class="row mt-3">
                <h2 class="mb-3">Attendence Dashboard </h2>
                <!-- Card1 -->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                        <div class="d-flex align-items-center justify-content-between">

                            <!-- Left Side -->
                            <div class="d-flex align-items-center">
                                <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                    style="width: 60px; height: 60px;  background-color: #46776b;">
                                    <i class="bi bi-person-check-fill"></i>     
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0 text-dark">0</h4>
                                    <p class="text-muted mb-0">Total Student</p>
                                </div>
                            </div>

                           
                        </div>
                    </div>
                </div>
                <!-- Card2 -->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                        <div class="d-flex align-items-center justify-content-between">

                            <!-- Left Side -->
                            <div class="d-flex align-items-center">
                                <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                    style="width: 60px; height: 60px;  background-color: #46776b;">
                                    <i class="bi bi-person-check-fill"></i>     
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0 text-dark">0</h4>
                                    <p class="text-muted mb-0">Present Today</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
               

            </div>
            <div class="row">
                <!--student-->
                <div class="col-lg-12">
                    <!--attendeces-->
                    <h3>Student Attendence Table</h3>
                    <div class="mt-3 table-responsive">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Student Name</th>
                                    <th>Hall No</th>
                                    <th>Seat No</th>
                                    <th>Sloat Time</th>
                                    <th>Stetus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Aman Kumar</td>
                                    <td>Hall-1</td>
                                    <td>S23</td>
                                    <td>8:00-12:00</td>
                                    <td>Present</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <!--pagination-->
                    <div class="d-flex justify-content-center align-items-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">Previous</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
               
            </div>
            
        </main>

<?=require "footer.php"?>