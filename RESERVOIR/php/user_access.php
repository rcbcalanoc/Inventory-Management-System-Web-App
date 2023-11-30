

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

/// Read operation
$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);

// DISPLAY USERS
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $class = "opacity-class";
        echo "<tr class='" . $class . "'>";
        echo "<td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["access_code"] . "</td>";    
        // Edit Delete Buttons
        echo "<td>
                <form action='php/user_delete.php' method='get' style='display: inline-block;'>
                    <input type='hidden' name='Action' value='Delete'>
                    <input type='hidden' name='id' value='" . $row["access_code"] . "'>
                    <button type='submit' style='background-color: #f44336; font-size: 10px; color: white; padding: 8px 8px; border: none; border-radius: 4px; cursor: pointer; width: 50px;'>Delete</button>
                </form>
            </td>";
        echo "</tr>";
    }
} 
?>