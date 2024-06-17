<?php
include "..\config\connect.php";

$_id = $_GET['_id'];

$sql = "select * from servicePlan where _id = $_id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row["name"];
$description = $row["description"];
$cost = $row["cost"];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];

    $sql = "UPDATE `servicePlan`
    SET name = '$name',
        description = '$description',
        cost = '$cost'
    WHERE _id = $_id";

    $result = mysqli_query($con, $sql);
    if ($result) {
        header('location:displayPlan.php');
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
                <label>Plan Name</label>
                <input type="text" class="form-control" placeholder="Plan Name" name="name" value="<?php echo $name ?>">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control" placeholder="Description" name="description"
                    value="<?php echo $description ?>">
            </div>
            <div class="form-group">
                <label>Cost</label>
                <input type="text" class="form-control" placeholder="Cost" name="cost" value="<?php echo $cost ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
</body>

</html>