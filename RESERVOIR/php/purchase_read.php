<?php
    // Database connection
    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "main";

    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Read operation
    $sql = "SELECT DISTINCT `Batch ID` FROM purchase ORDER BY ID DESC";
    $result = mysqli_query($conn, $sql);

    // Check if query execution was successful
    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }

    // Display tables for each batch
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $batchID = $row["Batch ID"];
            echo "<h2 class='batch-title'>Batch #" . $batchID . "</h2>";
            echo "<div class='purchase-table-container'>";
            
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Item Name</th>";
            echo "<th>Quantity</th>";
            echo "<th>Supplier Name</th>";
            echo "<th>Supplier Contact</th>";
            echo "<th>Supplier Address</th>";
            echo "<th>Actions</th>"; // New column for actions
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
            // Fetch records for the current batch
            $batchSql = "SELECT * FROM purchase WHERE `Batch ID` = '$batchID' ORDER BY ID DESC";
            $batchResult = mysqli_query($conn, $batchSql);

            // Display table rows with data
            if (mysqli_num_rows($batchResult) > 0) {
                while ($batchRow = mysqli_fetch_assoc($batchResult)) {
                    echo "<tr>";
                    echo "<td>" . $batchRow["ID"] . "</td>";
                    echo "<td>" . $batchRow["Item Name"] . "</td>";
                    echo "<td>" . $batchRow["Qty"] . "</td>";
                    echo "<td>" . $batchRow["Supplier Name"] . "</td>";
                    echo "<td>" . $batchRow["Supplier Contact"] . "</td>";
                    echo "<td>" . $batchRow["Supplier Address"] . "</td>";
                    echo "<td><button class='update-button' data-id='" . $batchRow["ID"] . "'>Update</button></td>"; // Update button
                    echo "</tr>";
                }
            } else {
                echo '<div class="no-purchase-record">You currently have no Purchase Order record. Click "Create Order" to record a purchase record.</div>';
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        }
    } else {
        echo '<div class="no-purchase-record">You currently have no Purchase Order record. Click "Create Order" to record a purchase record.</div>';
    }

    // Close the database connection
    mysqli_close($conn);
?>
