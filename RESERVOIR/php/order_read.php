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

// Read operation
$sql = "SELECT * FROM inventory";
$result = mysqli_query($conn, $sql);

// Check if query execution was successful
if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Display item names in dropdown
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $itemName = $row["ProductName"];
        echo "<option value='$itemName'>$itemName</option>";
    }
}

// Close the database connection
mysqli_close($conn);
?>
