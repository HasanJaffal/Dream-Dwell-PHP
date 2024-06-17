<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include your database connection file
include "config/connect.php";

if (isset($_POST['submit'])) {
    $userId = $_POST['userId'];
    $servicePlanId = $_POST['servicePlanId'];
    $roomId = $_POST['roomId'];
    $checkInDate = $_POST['checkInDate'];
    $checkOutDate = $_POST['checkOutDate'];

    $startDateTime = new DateTime($checkInDate);
    $endDateTime = new DateTime($checkOutDate);

    // Calculate the interval between two dates
    $interval = $startDateTime->diff($endDateTime);

    // Get the total number of days
    $numberOfDays = $interval->days;

    // Calculate room cost
    $sqlRoomCost = "SELECT cost FROM room WHERE _id ='$roomId'";
    $resultRoomCost = mysqli_query($con, $sqlRoomCost);

    if ($resultRoomCost) {
        $rowRoomCost = mysqli_fetch_assoc($resultRoomCost);
        $roomCost = $rowRoomCost['cost'];
    } else {
        die(mysqli_error($con));
    }

    // Calculate service plan cost
    $sqlServicePlanCost = "SELECT cost FROM serviceplan WHERE _id ='$servicePlanId'";
    $resultServicePlanCost = mysqli_query($con, $sqlServicePlanCost);

    if ($resultServicePlanCost) {
        $rowServicePlanCost = mysqli_fetch_assoc($resultServicePlanCost);
        $servicePlanCost = $rowServicePlanCost['cost'];
    } else {
        die(mysqli_error($con));
    }

    // Calculate total cost
    $totalCost = $roomCost * $numberOfDays + $servicePlanCost;

    $sql = "INSERT INTO `booking` (userId, servicePlanId, roomId, checkInDate, checkOutDate, cost)
            VALUES ('$userId', '$servicePlanId', '$roomId', '$checkInDate', '$checkOutDate', $totalCost)";
    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:checkout.php');
    } else {
        die(mysqli_error($con));
    }
}
?>