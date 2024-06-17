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
    $status = $_POST['status'];

    $startDateTime = new DateTime($checkInDate);
    $endDateTime = new DateTime($checkOutDate);

    // Calculate the interval between two dates
    $interval = $startDateTime->diff($endDateTime);

    // Get the total number of days
    $numberOfDays = $interval->days;

    $sql=" SELECT room.cost from room join booking on room._id = booking.roomId  where room._id = '$roomId'";
    $result = mysqli_query($con,$sql);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $roomCost = $row['cost'];
    }
    echo $roomCost;
    $cost = $roomCost*$numberOfDays;

    $sql = "INSERT INTO `booking` (userId, servicePlanId, roomId, checkInDate, checkOutDate, cost)
            VALUES ('$userId', '$servicePlanId', '$roomId', '$checkInDate', '$checkOutDate',$cost)";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:displayBooking.php');
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

    <title>Booking CRUD Operations</title>
</head>

<body>
    <div class="container my-5">
        <h1>Bookings</h1>
        <!-- Add Plan Button -->

        <!-- Filter Form -->
        <form method="get" action="">
            <div class="form-row align-items-center my-2">
                <div class="col-auto">
                    <select class="form-control" name="filterHeader">
                        <option value="_id">ID</option>
                        <option value="userId">User ID</option>
                        <option value="servicePlanId">Service Plan ID</option>
                        <option value="roomId">Room ID</option>
                        <option value="checkInDate">Check-In Date</option>
                        <option value="checkOutDate">Check-Out Date</option>
                        <option value="cost">Invoice</option>
                        <option value="status">Status</option>
                    </select>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" name="searchValue" placeholder="Search...">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
                <div class="col-auto">
                    <a href="displayBooking.php" class="btn btn-danger">Remove Filter</a>
                </div>
            </div>
        </form>

        <!-- Booking Table -->
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Service Plan ID</th>
                    <th scope="col">Room ID</th>
                    <th scope="col">Check-In Date</th>
                    <th scope="col">Check-Out Date</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Status</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $filterHeader = isset($_GET['filterHeader']) ? $_GET['filterHeader'] : null;
                $searchValue = isset($_GET['searchValue']) ? $_GET['searchValue'] : null;

                $sql = 'SELECT * FROM booking';

                // Add filter conditions to the SQL query if a filter is provided
                if ($filterHeader && $searchValue) {
                    $sql .= " WHERE $filterHeader LIKE '%$searchValue%'";
                }

                // Add sorting to the SQL query
                if ($filterHeader) {
                    $sql .= " ORDER BY $filterHeader";
                }

                $result = mysqli_query($con, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $_id = $row["_id"];
                        $userId = $row["userId"];
                        $servicePlanId = $row["servicePlanId"];
                        $roomId = $row["roomId"];
                        $checkInDate = $row["checkInDate"];
                        $checkOutDate = $row["checkOutDate"];
                        $cost = $row['cost'];
                        $status = $row['status'];
                        echo '
                        <tr>
                            <td scope="row">' . $_id . '</td>
                            <td scope="row">' . $userId . '</td>
                            <td scope="row">' . $servicePlanId . '</td>
                            <td scope="row">' . $roomId . '</td>
                            <td scope="row">' . $checkInDate . '</td>
                            <td scope="row">' . $checkOutDate . '</td>
                            <td scope="row">' . $cost . '</td>
                            <td scope="row">' . $status . '</td>
                            

                            <td>
                                <button class="btn btn-primary"><a class="text-light" href="updateBooking.php?_id=' . $_id . '">Update</a></button>
                                <button class="btn btn-danger"><a class="text-light" href="deleteBooking.php?_id=' . $_id . '">Delete</a></button>
                            </td>
                        </tr>
                        ';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>