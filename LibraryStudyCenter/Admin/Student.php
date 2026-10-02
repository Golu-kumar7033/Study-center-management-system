 <?php
     require "login/chacklogin.php";
     require "../database.php";
 ?>

    <?php include("navbar.html"); ?>

     

        <main class="main mt-3 g-3" >
            <div class="row g-3 mt-2">
                <!-- Card 1  all-->
                <?php

                $sql = "SELECT COUNT(*) AS TOTAL FROM student_info";

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
                ?>
             <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                    <div class="d-flex align-items-center justify-content-between">

                        <!-- Left Side -->
                        <div class="d-flex align-items-center">
                            <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                style="width: 60px; height: 60px; background-color: #46776b;">
                                <i class="bi bi-person-fill fs-1 text-dark"></i>
                            </div>

                            <div>
                                <h4 class="fw-bold text-center mb-0 text-dark">
                                    <?php echo $total; ?>
                                </h4>
                                <p>Total Student</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            
             
                <!-- Card 4  blocked students->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                        <div class="d-flex align-items-center">
                            <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                style="width: 60px; height: 60px;  background-color: #46776b;">
                                <i class="bi bi-currency-rupee"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-dark">0</h4>
                                <p class="text-muted mb-0">Block Students</p>
                            </div>                                                  
                        </div>
                    </div>
                </div>-->                          
        
            </div>
            <div class="container-fluid" id="allstudents">
                <div class="row mt-3 g-3">
                    <div class="col-lg-12">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search By Name">
                            <button class="btn btn-primary me-2"><i class="bi bi-search"></i></button>
                        </div>
                        
                        <a href="addstudent.php" class="btn btn-primary mb-3" >
                        + Add New Student
                        </a>

                     



                        <?php
                        $ms="";
                        if(isset($_GET['ms'])&&$_GET['ms']!=''){
                            $ms=$_GET['ms'];
                        }          

                        ?>
                        <?php if(!empty($ms)):?>
                            
                            <div class="d-flex justify-content-center">
                                <div class="alert alert-success alert-dismissible fade show text-center px-5" role="alert">
                                    <strong><?= htmlspecialchars($ms) ?></strong>

                                    <button type="button"class="btn-close" data-bs-dismiss="alert"aria-label="Close"></button>
                                </div>
                            </div>
                        <?php endif?>    
            

                        <!--student record-->
                        <?php
                            $limit=5;
                            $page=isset($_GET['page'])?(int)$_GET['page']:1;
                            
                            if ($page < 1) {
                                $page = 1;
                            }

                            $offset = ($page - 1) * $limit;                            

                            $countstd=mysqli_prepare($conn,"SELECT COUNT(*) AS total FROM student_info");
                            mysqli_stmt_execute($countstd);
                            $total=mysqli_stmt_get_result($countstd);
                            $totalrow=mysqli_fetch_assoc($total);

                            $totalstudent=$totalrow['total'];
                            $totalPages = ceil($totalstudent / $limit);

                            $limit=(int)$limit;
                            $offset-(int)$offset;

                            $sql=mysqli_query($conn,"SELECT * FROM student_info WHERE student_id !=31 ORDER BY created_at DESC LIMIT $limit OFFSET $offset");
                            if($sql && mysqli_num_rows($sql)>0){  
                                $sno=$offset;                
                                 echo "<div class='table-responsive mt-4'>";
                                echo"<table class='table table-bordered text-center align-middle'>";
                                echo "<thead class='table-dark p-3' >";
                                    echo "<tr>";
                                         echo"  <th>SNO.</th>";

                                        //echo"  <th>ID</th>";
                                        echo"  <th>Image</th>";
                                        echo"  <th>Name</th>";
                                        echo"  <th>Phone</th>";
                                        echo"  <th>ID Proof</th>";
                                        echo"  <th>Actions</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo" <tbody>";
                                        while($row=mysqli_fetch_assoc($sql)){
                                            $sno=$sno+1;
                                            $id=$row['student_id'];
                                            $img=$row['student_image'];
                                            $idproof= $row['student_id_proof'];
                                            $ext = strtolower(pathinfo($idproof, PATHINFO_EXTENSION));

                                            echo " <tr>";
                                                        echo"<td>".$sno."</td>";
                                                     //  echo "<td>" . $row['student_id'] . "</td>";
                                                       echo "<td>
                                                            <img src='../ImgUploads/$img' width='50' class='rounded' id='studentimg' alt='Student Photo'>
                                                        </td>";
                                                        

                                                       echo" <td>". $row['student_name']."</td>";
                                                       echo" <td>". $row['student_phone']."</td>";
                                                       echo" <td>
                                                       <a href='../uploads/$idproof' > View</a>
                                                       </td>";
                                                        
                                                
                                                       echo" <td>";
                                                                echo"<div class='d-flex flex-wrap gap-1'>";
                                                               //echo" <button class='btn btn-success btn-sm'><i class='bi bi-pencil-square'></i></button>";
                                                               echo" <a href='delete_student.php?id=$id' onclick='return confirm('Are you sure?')'  class='btn btn-danger btn-sm'><i class='bi bi-trash'> Delete</i></a>";
                                                                //echo" <a href='edit_student.php?id=$id' class='btn btn-primary btn-sm'><i class='bi bi-pen'> Edit</i></a>";
                                                                echo" <a href='student_details.php?id=$id' class='btn btn-warning btn-sm'><i class='bi bi-eye'> View</i></a>";


                                                            echo"</div>";
                                                        echo"</td>";
                                                    echo"</tr>";
                                            
                                        }
                                echo" </tbody>";
                                echo" </table>";
                                echo "</div>";
                            }
                        ?>

                        <div class="d-flex justify-content-center align-items-center">
                            <nav>
                                <ul class="pagination justify-content-center">

                                    <?php if ($page > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page-1 ?>">Previous</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($page < $totalPages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page+1 ?>">Next</a>
                                        </li>
                                    <?php endif; ?>

                                </ul>
                            </nav>

                        </div>
                    
                    </div>
                </div>
            </div>
            
        </main>

    <?=require_once "footer.php"?>