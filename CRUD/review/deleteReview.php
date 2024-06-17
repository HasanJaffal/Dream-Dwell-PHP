<?php
include "..\config\connect.php";
if (isset($_GET['_id']) && !empty($_GET['_id'])) {
    $_id = $_GET['_id'];
    $sql = "DELETE FROM `review` WHERE _id = '$_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        header("location:displayReview.php");
    } else {
        echo "Error deleting review: " . mysqli_error($con);
    }
} else {
    echo "Invalid review ID";
}
?>