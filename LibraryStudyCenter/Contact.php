>
    <nav>
        <?php require "Navigation.php";?>
    </nav>
   <!-- Contact us -->
    <div class="header  container-fluid" style="margin-top:100px;">
        <h1>Contact</h1>
    </div> 
<section class="contact_info p-4 mt-5">
    <div class="container-fluid">
        <h3 class="m-2">Get in Touch</h3>

        <div class="row">

            <!-- Phone -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                <div class="card">
                    <div class="card-header">Call us:</div>
                    <div class="card-body">
                        <p class="fs-5">
                            <i class="fa-solid fa-phone me-3"></i> +91 7033670192
                        </p>
                        <p class="fs-5">
                            <i class="fa-solid fa-phone me-3"></i> +91 8036542695
                        </p>
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                <div class="card">
                    <div class="card-header">Email:</div>
                    <div class="card-body">
                        <p class="fs-5">
                            <i class="fa-regular fa-envelope me-3"></i> studycenter@gmail.com
                        </p>
                        <p class="fs-5">
                            <i class="fa-regular fa-envelope me-3"></i> studycenter.ed@gmail.com
                        </p>
                    </div>
                </div>
            </div>

            <!-- Office -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                <div class="card">
                    <div class="card-header">Office</div>
                    <div class="card-body">
                        <p class="fs-5">
                            <i class="fa-solid fa-location-dot me-2"></i>Office Location
                        </p>
                        <p>
                            102 XT Road, Purba Apartment 2nd Floor <br>
                            Near Maripur, Muzaffarpur, Bihar - 842001
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Contact Form -->
        <div class="contact mt-4">
            <h3>Have questions? Feel free to write us</h3>

            <div class="row">

                <div class="col-lg-6">
                    <img src="../imges/contact.webp" class="img-fluid" alt="Contact Image">
                </div>

                <div class="col-lg-6 mt-2">
                    <form action="send.php" method="POST">

                        <div class="row mb-3">
                            <div class="col-6">
                                <input type="text" name="name" class="form-control p-3" placeholder="Name" required>
                            </div>

                            <div class="col-6">
                                <input type="email" name="email" class="form-control p-3" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <input     type="tel" name="tel" class="form-control p-3"  placeholder="Phone Number"  pattern="[0-9]{10}"  maxlength="10"  required>            
                            </div>

                            <div class="col-6">
                                <input type="text" name="subject" class="form-control p-3" placeholder="Subject" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <input type="text" name="city" class="form-control p-3" placeholder="City" required>
                            </div>

                            <div class="col-6">
                                <input type="text" name="state" class="form-control p-3" placeholder="State" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <textarea class="form-control " name="text" rows="5" style="resize:none;" placeholder="Write here..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary px-4 py-2">
                            Submit
                        </button>

                    </form>
                </div>

            </div>
        </div>

    </div>
</section>
     
    <footer>
        <?php require "Footer.php"?>
    </footer>
    