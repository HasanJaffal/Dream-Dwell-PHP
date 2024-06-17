<?php
    $con = new mysqli('localhost', 'root', '', 'php_hotel_database');
    
    if (!$con) {    
        die(mysqli_error($con));
    }
?>