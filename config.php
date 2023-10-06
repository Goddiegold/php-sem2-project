<?php
    // Database connection parameters
    $servername = "localhost:3307";
    $username = "godwin";
    $password = "12345";
    $database = "portal";

    // Create a connection to the database
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed");
    }
?>
