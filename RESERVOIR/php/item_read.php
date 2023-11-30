<?php
// Configuration
$dbHost     = "localhost";
$dbusername = "root";
$dbPassword = "";
$dbName     = "main";

// Connect to Database
$conn = mysqli_connect($dbHost, $dbusername, $dbPassword, $dbName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/// Read operation
$sql = "SELECT * FROM item";
$result = mysqli_query($conn, $sql);

// DISPLAY item
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $class = "opacity-class";
        echo "<td>" . $row["batchID"] . "</td>";
        // echo "<td>" . $row["itemno"] . "</td>";
        echo "<td>" . $row["itemname"] . "</td>";
        // echo "<td>" . $row["Quantity"] . "</td>";
        echo "<td>" . $row["Price"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>
                <form action='php/item_edit.php' method='get' style='display: inline-block; margin-right: 10px;'>
                    <input type='hidden' name='Action' value='Edit'>
                    <input type='hidden' name='id' value='" . $row["batchID"] . "'>
                    <button type='submit' style='background-color: #4c4c20; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer; width: 80px;'>Edit</button>
                </form>
                <form action='php/item_delete.php' method='get' style='display: inline-block;'>
                    <input type='hidden' name='Action' value='Delete'>
                    <input type='hidden' name='id' value='" . $row["batchID"] . "'>
                    <button type='submit' style='background-color: #f44336; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer; width: 80px;'>Delete</button>
                </form>
            </td>";
        echo "</tr>";
    }
} 
?>