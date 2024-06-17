<?php
include "config\connect.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Admin Page</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav">
                <li>
                    <a class="nav-link" href="/CRUD/admin_home.php">Home<span class="sr-only">Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/CRUD/booking/displayBooking.php">Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/CRUD//room/displayRoom.php">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/CRUD/serviceplan/displayPlan.php">Service Plans</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/CRUD/review/displayReview.php">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/CRUD/user/displayUser.php">Users</a>
                </li>
            </ul>
            <a class="nav-link text-white"href="/CRUD/config/logout.php">Logout</a>
        </div>
    </nav>
    <h1 class="m-2">Welcome Admin!</h1>
</body>

</html>