<?php
include('../admin.php');

$_id = $_GET['_id'];

$sql = "SELECT * FROM room WHERE _id = $_id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$name = $row["name"];
$image = $row["image"];
$num_beds = $row["num_beds"];
$description = $row["description"];
$cost = $row["cost"];
$booked = $row["booked"];

if (isset($_POST['submit'])) {
    // Update input values based on form submission
    $name = $_POST["name"];
    $image = $_POST["image"];
    $num_beds = $_POST["num_beds"];
    $description = $_POST["description"];
    $cost = $_POST["cost"];
    $booked = $_POST["booked"];

    $sql = "UPDATE room
            SET name = ?,
                image = ?,
                num_beds = ?,
                description = ?,
                cost = ?,
                booked = ?
            WHERE _id = ?";

    // Use prepared statement
    $stmt = mysqli_prepare($con, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'ssisdsi', $name, $image, $num_beds, $description, $cost, $booked, $_id);

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header('location: displayRoom.php');
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
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Room Name" name="name" value="<?php echo $name ?>">
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="text" class="form-control" placeholder="image" name="image" value="<?php echo $image ?>">
            </div>
            <div class="form-group">
                <label>Number of Beds</label>
                <input type="number" class="form-control" placeholder="Number of Beds" name="num_beds"
                    value="<?php echo $num_beds ?>">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input class="form-control" placeholder="Description" name="description"
                    value="<?php echo $description ?>"></input>
            </div>
            <div class="form-group">
                <label>Cost</label>
                <input type="text" class="form-control" placeholder="Cost" name="cost" value="<?php echo $cost ?>">
            </div>
            <div class="form-group">
                <label>Booked</label>
                <input type="text" class="form-control" placeholder="Booked Status" name="booked"
                    value="<?php echo $booked ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
</body>

</html>