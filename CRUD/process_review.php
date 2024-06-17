<?php
// Include your database connection file
include "config/connect.php";

if (isset($_POST['submit'])) {
    // Assuming you get userId, roomId, rating, and comment from your form
    $userId = $_POST['userId'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // Insert the review into the database
    $sql = "INSERT INTO `review` (userId, rating, comment) VALUES ('$userId', '$rating', '$comment')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Redirect to the page where you want to display reviews
        header('location: index.php');
        exit();  // Stop further execution
    } else {
        die(mysqli_error($con));
    }
} else {
    // Handle the case where the form was not submitted
    // You can redirect to an error page or display a message
    echo "Form not submitted";
}
?>