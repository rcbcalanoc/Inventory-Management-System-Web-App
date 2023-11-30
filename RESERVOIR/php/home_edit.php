<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>RESERVOIR - LOGIN PAGE</title>
   <link rel="stylesheet" href="../css/editform.css"> </head>

<body>
   <header>
      <nav class="top">
         <a href="../home.php" id="logo">
         <img src="../images/logo.png">
         <h1 id="title-logo">RESERVOIR</h1>
         </a>
      </nav>
   </header>

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

// Check if edit Action is requested
if (isset($_GET['Action']) && $_GET['Action'] == 'Edit') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM inventory WHERE BatchID = '$id'";
    $result = mysqli_query($conn, $sql);

    // Check if there are any results
    if (mysqli_num_rows($result) == 1) {
        // Display the edit form with the row data
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="wrapper">      
            <div class="title">
             Edit Inventory
            </div>
            <form method="post" action="home_edit.php">
                <input type="hidden" name="id" value="<?php echo $row['BatchID']; ?>">
            <div class="field">
                <input type="text" name="ProductName" value="<?php echo $row['ProductName']; ?>" required>
                <label>Product Name</label>
            </div>

            <div class="field">
                <input type="date" name="ExpirationDate" value="<?php echo $row['ExpirationDate']; ?>" required>
                <label>Expiration Date</label>
            </div>
            <div class="field">
                <input type="number" name="Price" value="<?php echo $row['Price']; ?>" required>
                <label>Price</label>
            </div>
            <div class="field">
                <input type="number" name="StockQuantity" value="<?php echo $row['StockQuantity']; ?>" required>
                <label>Stock Quantity</label>
            </div>
            <div class="field">
                <input type="number" name="SoldStock" value="<?php echo $row['SoldStock']; ?>" required>
                <label>Sold Stock</label>
            </div>
                <input type="hidden" name="CurrentInventory" value="<?php echo $row['StockQuantity'] - $row['SoldStock']; ?>" required>
            <div class="field">
                <input type="hidden" name="Action" value="update">  
            </div>  
            <div class="field">
            <div class="buttons">
            <div style="margin-top: -80px;"></div>
                  <button type="submit" class="profile-button">Save</button>
                  <div style="margin-top: 10px;"></div>
                  <a href="../home.php" class="cancel-button">Cancel</a>
              </div>
            </div>              
            </form>
        </div>
        <?php
    } else {
        echo "Error: Record not found.";
    }
}

// Check if update Action is requested
if (isset($_POST['Action']) && $_POST['Action'] == 'update') {
    $id = $_POST['id'];
    $ProductName = $_POST['ProductName'];
    $ExpirationDate = $_POST['ExpirationDate'];
    $Price = $_POST['Price'];
    $StockQuantity = $_POST['StockQuantity'];
    $SoldStock = $_POST['SoldStock'];
    $CurrentInventory =  $StockQuantity - $SoldStock;
    $Status = $_POST['Status'];
    $Action = $_POST['Action'];
    $sql = "UPDATE inventory SET ProductName = '$ProductName',ExpirationDate ='$ExpirationDate',
    Price='$Price',StockQuantity='$StockQuantity',SoldStock ='$SoldStock',CurrentInventory='$CurrentInventory'
    ,Status ='$Status' WHERE BatchID = '$id'";
    if (mysqli_query($conn, $sql)) {
        header('Location: ../home.php');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>

</body>
   <script src="js/main.js"></script>
</html>
