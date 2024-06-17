<?php
include('../admin.php');

$_id = $_GET['_id'];

$sql = "SELECT b.*, s.name AS servicePlanName, r.name AS roomName
        FROM booking b
        JOIN serviceplan s ON b.servicePlanId = s._id
        JOIN room r ON b.roomId = r._id
        WHERE b._id = $_id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$userId = $row["userId"];
$servicePlanId = $row["servicePlanId"];
$roomId = $row["roomId"];
$checkInDate = $row["checkInDate"];
$checkOutDate = $row["checkOutDate"];

// Fetch all service plans
$sqlServicePlans = "SELECT _id, name FROM serviceplan";
$resultServicePlans = mysqli_query($con, $sqlServicePlans);

// Fetch all rooms
$sqlRooms = "SELECT _id, name FROM room";
$resultRooms = mysqli_query($con, $sqlRooms);

if (isset($_POST['submit'])) {
    $userId = mysqli_real_escape_string($con, $_POST['_id']);
    $servicePlanId = mysqli_real_escape_string($con, $_POST['servicePlanId']);
    $roomId = mysqli_real_escape_string($con, $_POST['roomId']);
    $checkInDate = mysqli_real_escape_string($con, $_POST['checkInDate']);
    $checkOutDate = mysqli_real_escape_string($con, $_POST['checkOutDate']);

    // Fetch room cost
    $sql = "SELECT cost FROM room WHERE _id ='$roomId'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $roomCost = $row['cost'];
    }

    // Calculate the number of days
    $startDateTime = new DateTime($checkInDate);
    $endDateTime = new DateTime($checkOutDate);
    $interval = $startDateTime->diff($endDateTime);
    $numberOfDays = $interval->days;

    // Calculate the total cost
    $cost = $roomCost * $numberOfDays;

    // Fetch service plan cost
    $sql = "SELECT cost FROM serviceplan WHERE _id ='$servicePlanId'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $servicePlanCost = $row['cost'];
    }

    // Add service plan cost to the total cost
    $cost += $servicePlanCost;

    // Update the booking record
    $sql = "UPDATE booking
            SET
                servicePlanId = '$servicePlanId',
                roomId = '$roomId',
                checkInDate = '$checkInDate',
                checkOutDate = '$checkOutDate',
                cost = '$cost'
            WHERE _id = '$_id'";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location: displayBooking.php');
        exit();
    } else {
        die(mysqli_error($con));
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>CRUD Operations</title>
</head>

<body>
    <div class="container my-5">
        <form method="post">
            <div class="form-group">
                <label>Service Plan</label>
                <select class="form-control" name="servicePlanId">
                    <?php while ($rowServicePlan = mysqli_fetch_assoc($resultServicePlans)) : ?>
                    <option value="<?php echo $rowServicePlan['_id']; ?>"
                        <?php echo ($rowServicePlan['_id'] == $servicePlanId) ? 'selected' : ''; ?>>
                        <?php echo $rowServicePlan['name']; ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Room</label>
                <select class="form-control" name="roomId">
                    <?php while ($rowRoom = mysqli_fetch_assoc($resultRooms)) : ?>
                    <option value="<?php echo $rowRoom['_id']; ?>"
                        <?php echo ($rowRoom['_id'] == $roomId) ? 'selected' : ''; ?>>
                        <?php echo $rowRoom['name']; ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Check-In Date</label>
                <input type="date" class="form-control" name="checkInDate" value="<?php echo $checkInDate ?>">
            </div>
            <div class="form-group">
                <label>Check-Out Date</label>
                <input type="date" class="form-control" name="checkOutDate" value="<?php echo $checkOutDate ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
</body>

</html>