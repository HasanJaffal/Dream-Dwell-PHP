<?php
include "..\config\connect.php";
if (isset($_GET['_id']) && !empty($_GET['_id'])) {
    $_id = $_GET['_id'];
    $sql = "DELETE FROM `room` WHERE _id = $_id";
    $result = mysqli_query($con, $sql);

    if ($result) {
        header("location:displayRoom.php");
    } else {
        echo "Error deleting room: " . mysqli_error($con);
    }
} else {
    echo "Invalid room ID";
}
?>