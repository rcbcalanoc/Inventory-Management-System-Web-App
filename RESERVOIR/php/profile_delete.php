<?php

session_start();

// check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// connect to database
$host = "localhost";
$user = "root";
$password = "";
$database = "main";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// get user ID from session
$user_id = $_SESSION['id'];

// delete user record from database
$sql = "DELETE FROM user WHERE `ID`='$user_id'";

if (mysqli_query($conn, $sql)) {
    // delete successful, destroy session and redirect to login page
    session_destroy();
    header("Location: ../login.php");
    exit();
} else {
    // delete failed, display error message
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);

?>