<?php
require "..\config\config.php";
if (isset($_POST['submit'])) {
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phoneNumber = $_POST['phoneNumber'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $duplicate = mysqli_query($con, "select * from user where userName = '$userName' OR email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "
            <script>
                alert('Username Or Email Already Exist!');
            </script>
        ";
    } else {
        $query = "insert into `user` (userName, email, password, phoneNumber, firstName, lastName, address)
        values ('$userName', '$email', '$password', '$phoneNumber', '$firstName', '$lastName', '$address')";
        mysqli_query($con, $query);
        header("location: displayUser.php");
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Registation</title>
</head>

<body>
    <div class="container my-5">
        <h2>Registration</h2>
        <form class="" action="" method="post">
            <div class="form-group">
                <div class="form-group">
                    <label for="userName">Username: </label>
                    <input type="text" class="form-control" name="userName" id="userName" required value="">
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" class="form-control" name="email" id="email" required value="">
                </div>
                <div class="form-group">
                    <label for="firstName">First Name: </label>
                    <input type="text" class="form-control" name="firstName" id="firstName" required value="">
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name: </label>
                    <input type="text" class="form-control" name="lastName" id="lastName" required value="">
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Phone Number: </label>
                    <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" required value="">
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" class="form-control" name="password" id="password" required value="">
                </div>
                <div class="form-group">
                    <label for="address">Address: </label>
                    <input type="text" class="form-control" name="address" id="address" required value="">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>
</body>

</html>