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
    $ProductName = $_POST['ProductName'];
    $ExpirationDate = $_POST['ExpirationDate'];
    $Price = $_POST['Price'];
    $StockQuantity = $_POST['StockQuantity'];
    $SoldStock = $_POST['SoldStock'];
    $CurrentInventory = $StockQuantity - $SoldStock; // Calculate current inventory
    $Status = $_POST['Status'];

    $sql = "INSERT INTO inventory (ProductName, ExpirationDate, Price, StockQuantity, SoldStock, CurrentInventory, Status) VALUES ('$ProductName', '$ExpirationDate', '$Price', '$StockQuantity', '$SoldStock', '$CurrentInventory', '$Status')";
    if (mysqli_query($conn, $sql)) {
        header('Location: ../inventory.php');
        exit();
    } else {
        echo "Error creating record: " . mysqli_error($conn);
    }
}
?>
