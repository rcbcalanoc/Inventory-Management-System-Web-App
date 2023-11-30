

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
        echo "<td>" . $row["FirstName"] . "</td>";
        echo "<td>" . $row["LastName"] . "</td>";
        echo "<td>" . $row["Email"] . "</td>";
        echo "<td>" . $row["Number"] . "</td>";
        echo "<td>" . $row["Username"] . "</td>";
        echo "<td>" . $row["Password"] . "</td>";
        echo "<td>" . $row["Position"] . "</td>"; 

        echo "</tr>";
    }
} 
?>