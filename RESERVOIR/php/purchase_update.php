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
    if (isset($_POST['submit'])) {
        // Retrieve the form data
        $id = $_POST['ID'];
        $itemName = $_POST['Item_Name'];
        $qty = $_POST['Qty'];
        $supplierName = $_POST['Supplier_Name'];
        $supplierContact = $_POST['Supplier_Contact'];
        $supplierAddress = $_POST['Supplier_Address'];

        // Update the record in the database
        $updateSql = "UPDATE purchase SET `Item Name`='$itemName', `Qty`='$qty', `Supplier Name`='$supplierName', `Supplier Contact`='$supplierContact', `Supplier Address`='$supplierAddress' WHERE `ID`='$id'";
        $updateResult = mysqli_query($conn, $updateSql);
    // Redirect back to createorder.php with success status
    header("Location: ../purchase.php");
    exit(); // Terminate the script after redirection
    }

    // Close the database connection
    mysqli_close($conn);
?>
