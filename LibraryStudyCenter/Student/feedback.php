<?php 
require "../Checklogin.php";
?> 
<?php include("navbar.html"); ?>



<!--feedback form-->
    <form method="POST" action="feedback_submit.php">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card  mt-5 shadow-lg border-0 rounded-4">
                        <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                            <h3 class="mb-1">⭐ Feedback Form</h3>
                            <p class="mb-0">We value your feedback. Please rate our services.</p>
                        </div>

                        <div class="card-body p-4">

                            <!-- Seat -->
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">🪑 Seat Comfort</h5>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="seat" id="seat1" value="Very Good" required>
                                    <label class="btn btn-outline-success" for="seat1">😊 Very Good</label>

                                    <input type="radio" class="btn-check" name="seat" id="seat2" value="Good">
                                    <label class="btn btn-outline-primary" for="seat2">🙂 Good</label>

                                    <input type="radio" class="btn-check" name="seat" id="seat3" value="Average">
                                    <label class="btn btn-outline-warning" for="seat3">😐 Average</label>
                                </div>
                            </div>

                            <!-- Membership -->
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">💳 Membership</h5>
                                <div class="btn-group w-100">
                                    <input type="radio" class="btn-check" name="membership" id="m1" value="Very Good" required>
                                    <label class="btn btn-outline-success" for="m1">😊 Very Good</label>

                                    <input type="radio" class="btn-check" name="membership" id="m2" value="Good">
                                    <label class="btn btn-outline-primary" for="m2">🙂 Good</label>

                                    <input type="radio" class="btn-check" name="membership" id="m3" value="Average">
                                    <label class="btn btn-outline-warning" for="m3">😐 Average</label>
                                </div>
                            </div>

                            <!-- Environment -->
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">🌿 Environment</h5>
                                <div class="btn-group w-100">
                                    <input type="radio" class="btn-check" name="environment" id="e1" value="Very Good" required>
                                    <label class="btn btn-outline-success" for="e1">😊 Very Good</label>

                                    <input type="radio" class="btn-check" name="environment" id="e2" value="Good">
                                    <label class="btn btn-outline-primary" for="e2">🙂 Good</label>

                                    <input type="radio" class="btn-check" name="environment" id="e3" value="Average">
                                    <label class="btn btn-outline-warning" for="e3">😐 Average</label>
                                </div>
                            </div>

                            <!-- Internet -->
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">📶 Internet Speed</h5>
                                <div class="btn-group w-100">
                                    <input type="radio" class="btn-check" name="wifi" id="w1" value="Very Good" required>
                                    <label class="btn btn-outline-success" for="w1">😊 Very Good</label>

                                    <input type="radio" class="btn-check" name="wifi" id="w2" value="Good">
                                    <label class="btn btn-outline-primary" for="w2">🙂 Good</label>

                                    <input type="radio" class="btn-check" name="wifi" id="w3" value="Average">
                                    <label class="btn btn-outline-warning" for="w3">😐 Average</label>
                                </div>
                            </div>

                            <!-- Electronics -->
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">💡 Electronics</h5>
                                <div class="btn-group w-100">
                                    <input type="radio" class="btn-check" name="electronics" id="el1" value="Very Good" required>
                                    <label class="btn btn-outline-success" for="el1">😊 Very Good</label>

                                    <input type="radio" class="btn-check" name="electronics" id="el2" value="Good">
                                    <label class="btn btn-outline-primary" for="el2">🙂 Good</label>

                                    <input type="radio" class="btn-check" name="electronics" id="el3" value="Average">
                                    <label class="btn btn-outline-warning" for="el3">😐 Average</label>
                                </div>
                            </div>

                            <!-- Overall -->
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">⭐ Overall Rating</h5>
                                <div class="btn-group w-100">
                                    <input type="radio" class="btn-check" name="rating" id="r1" value="Very Good" required>
                                    <label class="btn btn-outline-success" for="r1">⭐⭐⭐⭐⭐</label>

                                    <input type="radio" class="btn-check" name="rating" id="r2" value="Good">
                                    <label class="btn btn-outline-primary" for="r2">⭐⭐⭐⭐</label>

                                    <input type="radio" class="btn-check" name="rating" id="r3" value="Average">
                                    <label class="btn btn-outline-warning" for="r3">⭐⭐⭐</label>
                                </div>
                            </div>

                            <!-- Feedback -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">💬 Additional Feedback</label>
                                <textarea class="form-control rounded-3 shadow-sm"
                                        name="message"
                                        rows="5"
                                        placeholder="Tell us what you liked or what we can improve..." style="resize:none"></textarea>
                            </div>

                            <!-- Submit -->
                            <div class="d-grid">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg rounded-pill">
                                     Submit Feedback
                                </button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>

    </div>
</div>
<?=require_once "footer.html"?>