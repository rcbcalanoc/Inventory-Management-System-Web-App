<?php
   //session start
   session_start();
   if(!isset($_SESSION['first_name'])) header('location: login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/inventory.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Inventory</title>

    <style>
        .main-content {
        margin-left: 3rem;
        margin-right: 3rem;
        padding-top: 10px;}

        main{
        padding: 1.5rem;
        min-height: calc(100vh - 70px);}

        .page-header{
        display: flex;
        justify-content: space-between;
        margin-bottom: -1.5rem;}

        .page-header h1{font-size: 3.5rem;}
        .page-header small{font-size: 1.2rem;}

        table{
            width: 100vw;
        }

        .add-button {
        display: inline-block;
        background-color: #4c4c20;
        color: white;
        border: none;
        padding: 7px 30px 7px 30px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.4s ease-in-out;
        font-size: 1rem;
        text-decoration: none;
        margin-left: auto;
        height: fit-content;
        margin-top: 2rem;
        width: 10rem;
        }

        .add-button:hover {
            background-color: #353511;
        }
    </style>

</head>
<body>

  <!--NAVBAR-->
  <header>
        <nav>
            <a href="home.php" id="logo"><img src="images/logo.png" class="logo-icon"></a>
            <i class="fas fa-bars" id="ham-menu"><img src="images/menu.png" class="nav-menu-icon" alt="Menu"></i>
            <ul id="nav-bar">
                <li><a href="home.php">Home</a></li>
                <li><a href="inventory.php">Inventory</a></li>
                <li><a href="items.php">Items</a></li>
                <li><a href="purchase.php">Purchase</a></li>
                <li><a href="report.php">Reports</a></li>
                <?php if (strcasecmp($_SESSION['position'], "Admin") == 0 || strcasecmp($_SESSION['position'], "Owner") == 0) { ?>
                <li><a href="user.php" id="admin-only">Users</a></li>
                <?php } ?>
            </ul>

            <!-- user-->
            <img src="images/user.png" alt="user" class = "user-pic" onclick="menuToggle();">
            <div class="action">
                <div class="menu">
                    <h3>
                        <?php echo $_SESSION['first_name'].' '.$_SESSION['last_name']; ?><br>
                        <span><?php echo $_SESSION['position'];?></span>
                    </h3>
                    <ul>
                        <li><a href="profile.php">My Profile</a></li>
                        <li><a href="php/logout.php">Log Out</a></li>
                    </ul>
                </div>
            </div>
            <!--user end-->
        </nav>
  </header>

    <!-- Content Start -->
    <div class="main-content">
    <main>
        <div class="page-header">
            <div>
            <h1>Inventory</h1>
            <small>List of inventory items such as ingredients and preparation materials</small>
            </div>
            <button class="add-button" id="add-btn-inventory">+ Add</button>
        </div>
      <!--TABLE-->
      <div class="table-container" style="display:flex; justify-content:center; align-items:center;">
        <table id="output-table">
            <thead>
                <tr>
                    <th>Batch ID</th>
                    <th>Product Name</th>
                    <th>Expiration Date</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                    <th>Sold Stock</th>
                    <th>Current Inventory</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php include 'php/inventory_read.php'; ?>
            </tbody>
        </table>
    </div>
    <div id="form-container-inventory">
        <form id="add-form-inventory" method="post" Action="php/inventory_create.php" style="display:none;">
            <input type="text" name="ProductName" placeholder="Product Name" required>
            <input type="date" name="ExpirationDate" placeholder="Expiration Date"required>
            <input type="number" name="Price" placeholder="Price" required>
            <input type="number" name="StockQuantity" placeholder="Stock Quantity" required>
            <input type="number" name="SoldStock" placeholder="Sold Stock" required>
            <input type="hidden" name="Action" value="create" >
            <button type="submit" name="submit">Create</button>
            <div class="buttons">
                  <div style="margin-top: 10px;"></div>
                  <a href="inventory.php" class="cancel-button">Cancel</a>
            </div>
            </form>
    </div>
  </main>
    </div>
    <script>
        window.onload = function() {
            // Add event listener to the form submit button
            document.getElementById('add-form-inventory').addEventListener('submit', function(event) {
                var stockQuantityInput = document.getElementsByName('StockQuantity')[0];
                var soldStockInput = document.getElementsByName('SoldStock')[0];

                // Check if Sold Stock is greater than Stock Quantity
                if (parseInt(soldStockInput.value) > parseInt(stockQuantityInput.value)) {
                    alert("Sold Stock cannot be greater than Stock Quantity.");
                    event.preventDefault(); // Prevent the form from submitting
                }
            });
        }
    </script>

</body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</html>