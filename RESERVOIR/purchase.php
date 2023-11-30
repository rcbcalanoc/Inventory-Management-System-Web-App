<?php
   //session start
   session_start();
   if(!isset($_SESSION['first_name'])) header('location: login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>RESERVOIR - PURCHASE PAGE</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="css/purchase.css"> -->
    <link rel="stylesheet" type="text/css" href="css/items.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/purchase.css">
    <title>Purchase</title>
    
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
            <img src="images/user.png" alt="user" class="user-pic" onclick="menuToggle();">
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
                    <h1>Purchase</h1>
                    <small>Track and record your inventory purchases</small>
                </div>
                <a href="createorder.php" class="create-order-button">+ Create Order</a>
            </div>
                <?php include 'php/purchase_read.php'; ?>

            <div id="form-container-inventory" style="display: none;">
                <form id="upt-form-inventory" method="post" action="php/purchase_update.php">
                    <input type="hidden" name="ID" id="id" placeholder="ID">
                    <input type="text" id="Item_Name" name="Item_Name" placeholder="Item Name">
                    <input type="number" name="Qty" placeholder="Qty">
                    <input type="text" id="Supplier_Name" name="Supplier_Name" placeholder="Supplier Name">
                    <input type="text" id="Supplier_Contact" name="Supplier_Contact" placeholder="Supplier Contact">
                    <input type="text" id="Supplier_Address" name="Supplier_Address" placeholder="Supplier Address">
                    <input type="hidden" name="Action" value="update">
                    <button type="submit" name="submit">Update</button>
                    <div class="buttons">
                        <div style="margin-top: 10px;"></div>
                        <a href="purchase.php" class="cancel-button">Cancel</a>
                    </div>
                </form>
            </div>        
        </main>
    </div>


</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/main.js"></script>
</html>