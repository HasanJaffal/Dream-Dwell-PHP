<?php
require "config\config.php";
if (!empty($_SESSION["_id"])) {
    $_id = $_SESSION["_id"];
    $result = mysqli_query($con, "select * from user where _id=$_id");
    $row = mysqli_fetch_assoc($result);

    // Fetch rooms, service plans, bookings, and reviews
    $roomResult = mysqli_query($con, "SELECT * FROM room");
    $rooms = mysqli_fetch_all($roomResult, MYSQLI_ASSOC);

    $servicePlanResult = mysqli_query($con, "SELECT * FROM serviceplan");
    $servicePlans = mysqli_fetch_all($servicePlanResult, MYSQLI_ASSOC);

    $bookingResult = mysqli_query($con, "SELECT * FROM booking WHERE userId=$_id AND status != 'Canceled'");
    $bookings = mysqli_fetch_all($bookingResult, MYSQLI_ASSOC);

    $reviewResult = mysqli_query($con, "SELECT * FROM review"); 
    $reviews = mysqli_fetch_all($reviewResult, MYSQLI_ASSOC);

} else {
    header("location: config/login.php");
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Your Page Title</title>

    <style>
    /* Custom CSS */
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: dodgerblue;
        color: white;
        text-align: center;
        padding-top: 12px;
    }

    .section {
        margin-top: 20px;
        margin-bottom: 100px;
    }

    .navbar {
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Dream Dwell</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="toggleSection('homeSection')">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="toggleSection('roomsSection')">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="toggleSection('servicePlansSection')">Service Plans</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="toggleSection('addBookingSection')">Add Booking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="toggleSection('currentBookingsSection')">Current Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="toggleSection('reviewsSection')">Reviews</a>
                </li>
            </ul>
        </div>
        <a href="config/logout.php"><button class="btn btn-danger"">Lougout</button></a>
    </nav>

    <div class="container mt-3">
        <!-- Welcome Header -->
        <div class="section collapse" id="homeSection">
            <h1>Welcome to Dream Dwell!</h1>
            <p>You are logged in as <?php echo $row['userName']; ?>.</P>
        </div>

        <!-- Rooms Section -->
        <div class=" section collapse" id="roomsSection">
                    <h2>Rooms</h2>
                    <div class="row">
                        <?php foreach ($rooms as $room) : ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Use the src attribute to specify the image path -->
                                    <img class="card-img-top my-1" src="assets/images/<?php echo $room['image']; ?>"
                                        alt="Room Image">
                                    <h5 class="card-title"><?php echo $room['name']; ?></h5>
                                    <p class="card-text">Number of Beds: <?php echo $room['num_beds']; ?></p>
                                    <p class="card-text">Cost / Night: $<?php echo $room['cost']; ?></p>
                                    <p class="card-text"><?php echo $room['description']; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
        </div>


        <!-- Service Plans Section -->
        <div class="section collapse" id="servicePlansSection">
            <h2>Service Plans</h2>
            <div class="row">
                <?php foreach ($servicePlans as $plan) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $plan['name']; ?></h5>
                            <p class="card-text">Cost: $<?php echo $plan['cost']; ?></p>
                            <p class="card-text"><?php echo $plan['description']; ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Add Booking Section -->
        <div class="section collapse" id="addBookingSection">
            <h2>Add Booking</h2>
            <div class="col-md-6">
                <form method="post" action="process_booking.php">
                    <!-- User ID (Assuming you get it from $_SESSION['_id']) -->
                    <input type="hidden" name="userId" value="<?php echo $_SESSION['_id']; ?>">

                    <!-- Service Plan -->
                    <div class="form-group">
                        <label for="servicePlan">Select Service Plan:</label>
                        <select class="form-control" name="servicePlanId" id="servicePlan">
                            <?php foreach ($servicePlans as $plan): ?>
                            <option value="<?php echo $plan['_id']; ?>"><?php echo $plan['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Room -->
                    <div class="form-group">
                        <label for="room">Select Room:</label>
                        <select class="form-control" name="roomId" id="room">
                            <?php foreach ($rooms as $room): ?>
                            <option value="<?php echo $room['_id']; ?>"><?php echo $room['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Check-In Date -->
                    <div class="form-group">
                        <label for="checkInDate">Check-In Date:</label>
                        <input type="date" class="form-control" name="checkInDate" id="checkInDate" required>
                    </div>

                    <!-- Check-Out Date -->
                    <div class="form-group">
                        <label for="checkOutDate">Check-Out Date:</label>
                        <input type="date" class="form-control" name="checkOutDate" id="checkOutDate" required>
                    </div>

                    <!-- Add more fields as needed -->

                    <button type="submit" class="btn btn-primary" name="submit">Book
                        Now</button>
                </form>
            </div>
        </div>


        <!-- Current Bookings Section -->
        <div class="section collapse" id="currentBookingsSection">
            <h2>Current Bookings</h2>
            <div class="row">
                <?php foreach ($bookings as $booking) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Booking <?php echo $booking['_id']; ?></h5>
                            <p class="card-text">Check-In: <?php echo $booking['checkInDate']; ?></p>
                            <p class="card-text">Check-Out: <?php echo $booking['checkOutDate']; ?></p>
                            <p class="card-text">Service Plan: <?php echo $booking['servicePlanId']; ?></p>
                            <p class="card-text">Room: <?php echo $booking['roomId']; ?></p>
                            <p class="card-text">Invoice: $<?php echo $booking['cost']; ?></p>
                            <!-- Add Cancel Booking Button -->
                            <form method="post" action="cancel_booking.php" class="my-2">
                                <input type="hidden" name="bookingId" value="<?php echo $booking['_id']; ?>">
                                <button type="submit" class="btn btn-danger">Cancel Booking</button>
                            </form>
                            <form method="post" action="update_booking.php" class="my-2">
                                <input type="hidden" name="bookingId" value="<?php echo $booking['_id']; ?>">
                                <button type="submit" name="submitUpdate" class="btn btn-primary">Update
                                    Booking</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>


        <!-- Reviews Section -->
        <div class="section collapse" id="reviewsSection">
            <h2>Add Review</h2>
            <!-- Add Review Form -->
            <!-- Add Review Form -->
            <form method="post" action="process_review.php">
                <!-- Assuming you get userId, rating, and comment from your form -->
                <input type="hidden" name="userId" value="<?php echo $_SESSION['_id']; ?>">

                <!-- Rating -->
                <div class="form-group">
                    <label for="rating">Rating:</label>
                    <select class="form-control" name="rating" id="rating" required>
                        <!-- Add your rating options, for example, 1 to 5 -->
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <!-- Comment -->
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" name="comment" id="comment" rows="4" required></textarea>
                </div>

                <!-- Add more fields as needed -->

                <button type="submit" class="btn btn-primary" name="submit">Submit Review</button>
            </form>
            <br>

            <h2>Reviews From Guests</h2>
            <div class="row my-5">
                <?php foreach ($reviews as $review) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Guest <?php echo $review['_id']; ?></h5>
                            <p class="card-text">Rating:
                                <?php
                                    $rating = $review['rating'];

                                    for ($i = 0; $i < $rating; $i++) {
                                        echo '⭐'; // You can use any star symbol or HTML entity that you prefer
                                    }
                                ?>
                            </p>
                            <p class="card-text">Comment: <?php echo $review['comment']; ?></p>
                            <!-- Display other review details -->
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>


        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2023 Dream Dwell. All rights reserved.</p>
        </div>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>

        <script>
        function toggleSection(sectionId) {
            // Hide all sections
            var sections = document.getElementsByClassName('section');
            for (var i = 0; i < sections.length; i++) {
                sections[i].classList.remove('show');
            }

            // Show the selected section
            var selectedSection = document.getElementById(sectionId);
            selectedSection.classList.add('show');
        }

        // Home section is initially toggled when the page loads
        window.onload = function() {
            toggleSection('homeSection');
        };
        </script>

</body>

</html>