<?php
include "..\config\connect.php";

$_id = $_GET['_id'];

$sql = "select * from user where _id = $_id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$userName = $row["userName"];
$email = $row["email"];
$password = $row["password"];
$phoneNumber = $row["phoneNumber"];

if (isset($_POST['submit'])) {
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phoneNumber = $_POST['phoneNumber'];

    // Add firstName, lastName, and address
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];

    $sql = "UPDATE `user`
    SET userName = '$userName',
        email = '$email',
        password = '$password',
        phoneNumber = '$phoneNumber',
        firstName = '$firstName',
        lastName = '$lastName',
        address = '$address'
    WHERE _id = $_id";

    $result = mysqli_query($con, $sql);
    if ($result) {
        header('location:displayUser.php');
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
                <label>Username</label>
                <input type="text" class="form-control" placeholder="Enter Your Name" name="userName"
                    value="<?php echo $userName ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Enter Your Email" name="email"
                    value="<?php echo $email ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Enter Your Password" name="password"
                    value="<?php echo $password ?>">
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" class="form-control" placeholder="Enter Your Phone Number" name="phoneNumber"
                    value="<?php echo $phoneNumber ?>">
            </div>
            <!-- Add firstName, lastName, and address fields -->
            <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" placeholder="Enter Your First Name" name="firstName"
                    value="<?php echo $row['firstName']; ?>">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" placeholder="Enter Your Last Name" name="lastName"
                    value="<?php echo $row['lastName']; ?>">
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" placeholder="Enter Your Address" name="address"
                    rows="4"><?php echo $row['address']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
</body>

</html>