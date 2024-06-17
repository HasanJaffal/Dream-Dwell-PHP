<?php
// Include your database connection file
include "config/connect.php";

if (isset($_POST['bookingId'])) {
    $bookingId = $_POST['bookingId'];

    // Update the booking status to 'canceled'
    $sql = "UPDATE `booking` SET `status` = 'Canceled' WHERE `_id` = $bookingId";

    $result = mysqli_query($con, $sql);

    if ($result) {
        // Redirect to the page displaying current bookings after successful cancellation
        header('location: index.php');
    } else {
        die(mysqli_error($con));
    }
}
?>