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
$sql = "SELECT * FROM inventory";
$result = mysqli_query($conn, $sql);

// DISPLAY inventory
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $class = "opacity-class";
        echo "<tr>";
        echo "<td>" . $row["BatchID"] . "</td>";
        echo "<td>" . $row["ProductName"] . "</td>";
        echo "<td>" . date('d-m-Y', strtotime($row["ExpirationDate"])) . "</td>";
        echo "<td>" . $row["Price"] . "</td>";
        echo "<td>" . $row["StockQuantity"] . "</td>";
        echo "<td>" . $row["SoldStock"] . "</td>";
        echo "<td>" . $row["CurrentInventory"] . "</td>";
        
        $remaining_stock = $row["StockQuantity"] - $row["SoldStock"];
        
        if (strtotime($row["ExpirationDate"]) < time()) {
            echo "<td>Expired</td>";
        } elseif ($row["CurrentInventory"] <= 0) {
            echo "<td>Out of Stock</td>";
        } elseif ($remaining_stock <= 0) {
            echo "<td>Out of Stock</td>";
        } elseif (($remaining_stock/$row["StockQuantity"]) <= 0.2) {
            echo "<td>Low Stock</td>";
        } else {
            echo "<td>In Stock</td>";
        }
        
        echo "<td>
                <form action='php/inventory_edit.php' method='get' style='display: inline-block; margin-right: 10px;'>
                    <input type='hidden' name='Action' value='Edit'>
                    <input type='hidden' name='id' value='" . $row["BatchID"] . "'>
                    <button type='submit' style='background-color: #4c4c20; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer; width: 80px;'>Edit</button>
                </form>
                <form action='php/inventory_delete.php' method='get' style='display: inline-block;'>
                    <input type='hidden' name='Action' value='Delete'>
                    <input type='hidden' name='id' value='" . $row["BatchID"] . "'>
                    <button type='submit' style='background-color: #f44336; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer; width: 80px;'>Delete</button>
                </form>
            </td>";
        echo "</tr>";
    }
}
?>
