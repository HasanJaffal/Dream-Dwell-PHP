<?php
include "..\config\connect.php";
if (isset($_GET['_id']) && !empty($_GET['_id'])) {
    $_id = $_GET['_id'];
    $sql = "DELETE FROM `serviceplan` WHERE _id = $_id";
    $result = mysqli_query($con, $sql);

    if ($result) {
        header("location:displayPlan.php");
    } else {
        echo "Error deleting plan: " . mysqli_error($con);
    }
} else {
    echo "Invalid serviceplan ID";
}
?>