<?php
// Set database credentials
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "main";

// Create database connection
$conn = mysqli_connect($dbHost,  $dbUsername, $dbPassword, $dbName);

// Check database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create operation
    if ($_POST['Action'] == 'create') {
        $name = $_POST['name'];
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        $message = $_POST['message'];
        $Actions = $_POST['Actions'];

        $sql = "INSERT INTO report (name,Date,message) VALUES ('$name', '$date', 
        '$message')";
        if (mysqli_query($conn, $sql)) {
            header('Location: ../report.php');
            exit();
        } else {
            echo "Error creating record: " . mysqli_error($conn);
        }
    }
?>

