<?php
include "..\config\connect.php";

if (isset($_POST['submit'])) {
    $booked = $_POST['booked'];
    $num_beds = $_POST['num_beds'];
    $image = $_POST['image'];
    $cost = $_POST['cost'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO `room` (booked, num_beds, image, cost, name, description)
            VALUES ('$booked', '$num_beds', '$image', '$cost', '$name', '$description')";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location: displayRoom.php');
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

    <title>CRUD Operations</title>
</head>

<body>
    <div class="container my-5">
        <form method="post">
            <div class="form-group">
                <label>Booked Status</label>
                <input type="text" class="form-control" placeholder="Booked Status" name="booked">
            </div>
            <div class="form-group">
                <label>Number of Beds</label>
                <input type="number" class="form-control" placeholder="Number of Beds" name="num_beds">
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="text" class="form-control" placeholder="Image URL" name="image">
            </div>
            <div class="form-group">
                <label>Cost</label>
                <input type="number" class="form-control" placeholder="Cost" name="cost">
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Room Name" name="name">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" placeholder="Room Description" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>