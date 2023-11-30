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

$sql = "SELECT * FROM inventory ORDER BY BatchID DESC LIMIT 4";
$result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr class='table-row'>";
    echo "<td>" . $row["BatchID"] . "</td>";
    echo "<td>" . $row["ProductName"] . "</td>";
    echo "<td>" . date('d-m-Y', strtotime($row["ExpirationDate"])) . "</td>";
    echo "<td>" . $row["StockQuantity"] . "</td>";
    echo "<td>" . $row["SoldStock"] . "</td>";
    echo "<td>" . $row["CurrentInventory"] . "</td>";

    $remaining_stock = $row["StockQuantity"] - $row["SoldStock"];

    if (strtotime($row["ExpirationDate"]) < time()) {
    echo "<td>Expired</td>";
    } elseif ($row["CurrentInventory"] <= 0) {
    echo "<td>Out of Stock</td>";
    } elseif ($remaining_stock <= 0) {
    echo "<td>No Stock Available</td>";
    } else {
    echo "<td>In Stock</td>";
    }
    echo "<td>";
    echo "<div class='card-button'>
            <form action='php/home_edit.php' method='get'>
            <input type='hidden' name='Action' value='Edit'>
            <input type='hidden' name='id' value='" . $row["BatchID"] . "'>
            <button type='submit'>Edit</button>
            </form>
          </div>";
    echo "</td>";
    echo "</tr>";
    }
?>