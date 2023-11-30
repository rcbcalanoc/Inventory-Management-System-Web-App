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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Generate the Batch ID
    $batchID = generateBatchID();

    // Get the form data for each order
    for ($i = 1; $i <= $_POST["order-count"]; $i++) {
        // Check if the order form is disabled (removed)
        $orderFormId = "order-form-$i";
        $disabledFieldName = $orderFormId . "-disabled";
        if (!isset($_POST[$disabledFieldName])) {
            $itemName = $_POST["item-name-$i"];
            $qty = $_POST["qty-$i"];
            $supplierName = $_POST["supplier-name-$i"];
            $supplierContact = $_POST["supplier-contact-$i"];
            $supplierAddress = $_POST["supplier-address-$i"];

            // Prepare the SQL statement
            $sql = "INSERT INTO purchase (`Item Name`, `Qty`, `Supplier Name`, `Supplier Contact`, `Supplier Address`, `Batch ID`) 
                    VALUES ('$itemName', '$qty', '$supplierName', '$supplierContact', '$supplierAddress', '$batchID')";

            // Execute the SQL statement
            if (!mysqli_query($conn, $sql)) {
                echo "Error: " . mysqli_error($conn);
                exit(); // Terminate the script if an error occurs
            }
        }
    }

    // Redirect back to createorder.php with success status
    header("Location: ../purchase.php");
    exit(); // Terminate the script after redirection
}


// Close the database connection
mysqli_close($conn);

/**
 * Generate a random Batch ID.
 * This function generates a random 6-digit number as the Batch ID.
 */
function generateBatchID()
{
    return rand(100000, 999999);
}
?>
