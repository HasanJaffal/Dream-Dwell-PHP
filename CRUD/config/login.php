<?php
include "config.php";

if (isset($_POST['submit'])) {
  $userNameOrEmail = $_POST['userNameOrEmail'];
  $password = $_POST['password'];

  $query = "SELECT * FROM user WHERE (userName = '$userNameOrEmail' OR email = '$userNameOrEmail') AND password = '$password'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  if (!$result) {
      die("Query failed: " . mysqli_error($con));
  }

    if ($row) {
        
        $_SESSION["login"] = true;
        $_SESSION["_id"] = $row["_id"];

        if ($userNameOrEmail == "admin" && $password == "admin") {
            header("location:../admin_home.php");
            exit();
        } else {
            header("location:../index.php");
            exit();
        }
    } else {
        echo "<script>alert('Invalid username or password!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-500">
    <div class="container my-5 bg-white shadow mx-auto flex flex-col border justify-center item-center max-w-max p-4 rounded mt-28">
        <form class="px-4 py-2" action="" method="post">
            <h2 class="text-5xl mb-4">Login</h2>
            <div class="mb-4">
                <label for="userNameOrEmail" class="block text-lg font-medium text-gray-600 mb-3">Username</label>
                <input type="text" name="userNameOrEmail" class="rounded px-3 border  text-xl pb-1" id="userNameOrEmail" placeholder="username"  required value="">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-lg font-medium text-gray-600 mb-3">Password</label>
                <input type="password" name="password" class="rounded px-3 border pb-1 text-xl " id="password" placeholder="Password"  required value="">
            </div>
            <div class="flex flex-col">
            <input type="submit" name="submit"class="rounded border bg-blue-500 px-3 py-1 text-white cursor-pointer hover:bg-blue-400" value="Login">
            <hr class="mt-4 ">
            <span>Don't have an account? <a class="text-blue-800 hover:underline" href="./registration.php">Sign up</a></span>
            </div>
          </form>
    </div>
</body>

</html>
