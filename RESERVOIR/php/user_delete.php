<?php
// Configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "main";

// // Connect to Database
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if delete Action is requested
if (isset($_GET['Action']) && $_GET['Action'] == 'Delete') {
    $id = $_GET['id'];
    $sql = "DELETE FROM user WHERE access_code = '$id'";
    if (mysqli_query($conn, $sql)) {
        header('Location: ../user.php');
        exit();
    }
}

// Close database connection
mysqli_close($conn);
?>