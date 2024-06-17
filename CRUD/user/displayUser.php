<?php
include('../admin.php');
?>
<?php
// Equivalent to @section('content')
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>CRUD Operations</title>
</head>

<body>
    <div class="container my-3">
        <h1>Users</h1>
        <!-- Filter Form -->
        <form method="get" action="">
            <div class="form-row align-items-center my-2">
                <div class="col-auto">
                    <select class="form-control" name="filterHeader">
                        <option value="firstName">First Name</option>
                        <option value="lastName">Last Name</option>
                        <option value="userName">Username</option>
                        <option value="email">Email</option>
                        <option value="password">Password</option>
                        <option value="phoneNumber">Phone Number</option>
                        <option value="address">Address</option>
                    </select>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" name="searchValue" placeholder="Search...">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
                <div class="col-auto">
                    <a href="displayUser.php" class="btn btn-danger">Remove Filter</a>
                </div>
            </div>
        </form>
        <!-- Add User Button -->
        <a href="createUser.php">
            <button class="btn btn-primary my-3">
                Add User
            </button>
        </a>

        <!-- User Table -->
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $filterHeader = isset($_GET['filterHeader']) ? $_GET['filterHeader'] : null;
                $searchValue = isset($_GET['searchValue']) ? $_GET['searchValue'] : null;

                $sql = 'SELECT * FROM user';

                // Add filter conditions to the SQL query if a filter is provided
                if ($filterHeader && $searchValue) {
                    $sql .= " WHERE $filterHeader LIKE '%$searchValue%'";
                }

                $result = mysqli_query($con, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $_id = $row["_id"];
                        $userName = $row["userName"];
                        $email = $row["email"];
                        $password = $row["password"];
                        $phoneNumber = $row["phoneNumber"];
                        $address = $row["address"];
                        $firstName = $row["firstName"];
                        $lastName = $row["lastName"];
                        echo '
                        <tr>
                            <td scope="row">' . $_id . '</td>
                            <td scope="row">' . $firstName . '</td>
                            <td scope="row">' . $lastName . '</td>
                            <td scope="row">' . $userName . '</td>
                            <td scope="row">' . $email . '</td>
                            <td scope="row">' . $password . '</td>
                            <td scope="row">' . $phoneNumber . '</td>
                            <td scope="row">' . $address . '</td>

                            <td>
                                <button class="btn btn-primary"><a class="text-light" href="updateUser.php?_id=' . $_id . '">Update</a></button>
                                <button class="btn btn-danger"><a class="text-light" href="deleteUser.php?_id=' . $_id . '">Delete</a></button>
                            </td>
                        </tr>
                        ';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
// Equivalent to @endsection
$content = ob_get_clean();
echo $content;
?>