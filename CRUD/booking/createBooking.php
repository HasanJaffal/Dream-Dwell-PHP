<?php
include('../admin.php');
?>
<?php
// Equivalent to @section('content')
ob_start();
?>
<?php
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

    $sql=" SELECT cost from room where _id ='$roomId'";
    $result = mysqli_query($con,$sql);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $roomCost = $row['cost'];
    }
    $cost = $roomCost*$numberOfDays;
    $sql=" SELECT cost from serviceplan where _id ='$servicePlanId'";
    $result = mysqli_query($con,$sql);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $servicePlanCost = $row['cost'];
    }
    $cost = $cost+$servicePlanCost;
    $status = $paid;
    $sql = "INSERT INTO `booking` (userId, servicePlanId, roomId, checkInDate, checkOutDate, cost, status)
            VALUES ('$userId', '$servicePlanId', '$roomId', '$checkInDate', '$checkOutDate', '$cost', '$status')";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:displayBooking.php');
    } else {
        die(mysqli_error($con));
    }
}
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

    <title>Booking Form</title>
</head>

<body>
    <div class="container my-5">
        <form method="post">
            <div class="form-group">
                <label>User ID</label>
                <input type="number" class="form-control" placeholder="User ID" name="userId">
            </div>
            <div class="form-group">
                <label>Service Plan ID</label>
                <input type="number" class="form-control" placeholder="Service Plan ID" name="servicePlanId">
            </div>
            <div class="form-group">
                <label>Room ID</label>
                <input type="number" class="form-control" placeholder="Room ID" name="roomId">
            </div>
            <div class="form-group">
                <label>Check-In</label>
                <input type="date" class="form-control" name="checkInDate">
            </div>
            <div class="form-group">
                <label>Check-Out</label>
                <input type="date" class="form-control" name="checkOutDate">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>