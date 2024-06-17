<?php
require "config.php";
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
        header("location: login.php");
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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Registation</title>
</head>

<body class="bg-blue-500">
    <div class="container my-5 bg-white shadow mx-auto flex flex-col border justify-center item-center max-w-max p-4 rounded mt-32">
        <h2 class="text-5xl mb-4 ">Registration</h2>

        <form class="" action="" method="post">
            <div class="form-group">
                <div class=" flex gap-8">
                    <div class="block">
                    <label for="userName" class="text-xl mt-1">Userame: </label>
                    <input type="text" class="form-control text-xl" placeholder="username" name="userName" id="userName" required value="">
                    </div>
                    <div class="block ">
                    <label for="email" class="text-xl mt-1">Email: </label>
                    <input type="email" class="form-control text-xl" placeholder="email" name="email" id="email" required value="">
                    </div>
                </div>
                <div class=" flex gap-8">
                    <div class="block">
                    <label for="firstName" class="text-xl mt-1">First Name: </label>
                    <input type="text" class="form-control text-xl" placeholder="firstname" name="firstName" id="firstName" required value="">
                    </div>
                    <div class="block">
                    <label for="lastName" class="text-xl mt-1">Last Name: </label>
                    <input type="text" class="form-control text-xl" placeholder="lastname" name="lastName" id="lastName" required value="">
                    </div>
                </div>
                <div class=" flex gap-8">
                    <div class="block" >
                    <label for="phoneNumber" class="text-xl mt-1">Phone Number: </label>
                    <input type="text" class="form-control text-xl" placeholder="phone number" name="phoneNumber" id="phoneNumber" required value="">
                </div>
                <div class="block">
                    <label for="password" class="text-xl mt-1">Password: </label>
                    <input type="password" class="form-control text-xl" placeholder="password" name="password" id="password" required value="">
                </div>
                </div>
                <div class=" flex gap-8">
                    <div class="block">
                    <label for="address" class="text-xl mt-1">Address: </label>
                    <input type="text" class="form-control text-xl" placeholder="address" name="address" id="address" required value="">
                </div>
                </div>
                <br>
                <input type="submit" name="submit" class="bg-blue-500 py-1 px-3 rounded text-white cursor-pointer hover:bg-blue-400 " value="Register">
                <br>
            </form>

            <hr class="mb-3 mt-4">
            <span>already have an account?<a href="login.php" class="text-blue-800 hover:underline"> login</a></span>
    </div>
</body>

</html>