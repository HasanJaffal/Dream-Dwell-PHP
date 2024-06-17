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
        <h1>Reviews</h1>
        <!-- Filter Form -->
        <form method="get" action="">
            <div class="form-row align-items-center my-2">
                <div class="col-auto">
                    <select class="form-control" name="filterHeader">
                        <option value="_id">ID</option>
                        <option value="userId">User ID</option>
                        <option value="rating">Rating</option>
                        <option value="comment">Comment</option>

                    </select>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" name="searchValue" placeholder="Search...">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
                <div class="col-auto">
                    <a href="displayReview.php" class="btn btn-danger">Remove Filter</a>
                </div>
            </div>
        </form>
        <!-- Add Plan Button -->


        <!-- Plan Table -->
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $filterHeader = isset($_GET['filterHeader']) ? $_GET['filterHeader'] : null;
                $searchValue = isset($_GET['searchValue']) ? $_GET['searchValue'] : null;

                $sql = 'SELECT * FROM review';

                // Add filter conditions to the SQL query if a filter is provided
                if ($filterHeader && $searchValue) {
                    $sql .= " WHERE $filterHeader LIKE '%$searchValue%'";
                }

                $result = mysqli_query($con, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $_id = $row["_id"];
                        $userId = $row["userId"];
                        $rating = $row["rating"];
                        $comment = $row["comment"];

                        echo '
                        <tr>
                            <td scope="row">' . $_id . '</td>
                            <td scope="row">' . $userId . '</td>                   
                            <td scope="row">' . $rating . '</td>
                            <td scope="row">' . $comment . '</td>

                            <td>
                                <button class="btn btn-danger"><a class="text-light" href="deleteReview.php?_id=' . $_id . '">Delete</a></button>
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