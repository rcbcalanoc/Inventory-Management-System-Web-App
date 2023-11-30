<?php
// Configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "main";

// Connect to Database
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$str = rand(); 
$id = md5($str); 
print($id);

// Create or retrieve operation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form was submitted
    if ($_POST['Action'] == 'create') {
        // Create new user
        $sql = "INSERT INTO user (access_code, Number)
        VALUES ('$id', '0')";
        if (mysqli_query($conn, $sql)) {
            header('Location: ../user.php');
            exit();
        } else {
            echo "Error creating record: " . mysqli_error($conn);
        }
    }
}
?>
