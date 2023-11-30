<?php
// Set database credentials
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "main";

// Create database connection
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Check database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create operation
    if ($_POST['Action'] == 'create') {
        // $itemno = $_POST['itemno'];
        $itemname = $_POST['itemname'];
        // $Quantity = $_POST['Quantity'];
        $Price = $_POST['Price'];
        $description = $_POST['description'];
        $Actions = $_POST['Actions'];
        
        // Check if the item already exists
        $itemCheckQuery = "SELECT * FROM item WHERE itemname = '$itemname'";
        $itemCheckResult = mysqli_query($conn, $itemCheckQuery);
        if (mysqli_num_rows($itemCheckResult) > 0) {
        // Item already exists, set a session variable to indicate this
        session_start();
        $_SESSION['item_already_exists'] = true;
        header('Location: ../items.php');
        exit();
        }
        $sql = "INSERT INTO item (itemname,Price,description) VALUES ('$itemname', '$Price','$description')";
        if (mysqli_query($conn, $sql)) {
            header('Location: ../items.php');
            exit();
        } else {
            echo "Error creating record: " . mysqli_error($conn);
        }
    }
?>
