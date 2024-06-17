<?php
include "..\config\connect.php";
if (isset($_GET['_id']) && !empty($_GET['_id'])) {
    $_id = $_GET['_id'];
    $sql = "UPDATE `booking` SET `status` = 'Canceled' WHERE `_id` = $_id";
    $result = mysqli_query($con, $sql);

    if ($result) {
        header("location:displayBooking.php");
    } else {
        echo "Error deleting booking: " . mysqli_error($con);
    }
} else {
    echo "Invalid booking ID";
}
?>