<?php
include "..\config\connect.php";
if (isset($_GET['_id']) && !empty($_GET['_id'])) {
    $_id = $_GET['_id'];
    $sql = "DELETE FROM `user` WHERE _id = $_id";
    $result = mysqli_query($con, $sql);

    if ($result) {
        header("location:displayUser.php");
    } else {
        echo "Error deleting user: " . mysqli_error($con);
    }
} else {
    echo "Invalid user ID";
}
?>