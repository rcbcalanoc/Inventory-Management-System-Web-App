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
    $sql = "DELETE FROM item WHERE batchID = '$id'";
    if (mysqli_query($conn, $sql)) {
        header('Location: ../items.php');
        exit();
    }
}

// Close database connection
mysqli_close($conn);
?>

<input type="hidden" name="id" value="<?php echo $row['batchID']; ?>">
                <!-- <input type="text" name="itemno" placeholder="Item Number" value="<?php echo $row['itemno']; ?>"> -->
                <input type="text" name="itemname" placeholder="Item Name" value="<?php echo $row['itemname']; ?>">
                <!-- <input type="text" name="Quantity" placeholder="Quantity" value="<?php echo $row['Quantity']; ?>"> -->
                <input type="text" name="Price" placeholder="Price" value="<?php echo $row['Price']; ?>">
                <input type="text" name="description" placeholder="Sold Stock" value="<?php echo $row['description']; ?>">
                <input type="hidden" name="Action" value="update">
                <button type="submit" name="submit">Update</button>