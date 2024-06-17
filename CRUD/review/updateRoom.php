<?php
include('../admin.php');

$_id = $_GET['_id'];

$sql = "SELECT * FROM room WHERE _id = $_id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    // Update input values based on form submission
    $userId = $row["userId"];
    $rating = $row["rating"];
    $comment = $row["comment"];

    $sql = "UPDATE room
            SET userId = ?,
                rating = ?,
                num_beds = ?,
                comment = ?,

            WHERE _id = ?";

    // Use prepared statement
    $stmt = mysqli_prepare($con, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'ssisdsi', $userId, $rating, $comment);

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
                <label>User ID</label>
                <input type="number" class="form-control" placeholder="Room Name" name="userId"
                    value="<?php echo $userId ?>">
            </div>
            <div class="form-group">
                <label>rating</label>
                <input type="number" class="form-control" placeholder="rating" name="rating"
                    value="<?php echo $rating ?>">
            </div>
            <div class="form-group">
                <label>Comment</label>
                <textarea type="number" class="form-control" placeholder="Comment..." name="num_beds"
                    value="<?php echo $comment ?>"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
</body>

</html>