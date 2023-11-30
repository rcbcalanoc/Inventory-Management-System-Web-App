<?php
   //session start
   session_start();
   if(!isset($_SESSION['first_name'])) header('location: login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>RESERVOIR - CREATE ORDER PAGE</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/order.css">
    <title>Create Order</title>

    <style>
    .order-form input[type="text"],    .order-form input[type="number"],
    .order-form select {
        width: 100%;
        padding: 8px;
        background-color: #d6d6d687;
        border: 1px solid #d6d6d687;
        border-color: darkgray;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .order-form .form-row input[type="text"],    .order-form .form-row input[type="number"],
    .order-form .form-row select {
        flex: 1 1 50%;
        margin-right: 10px;
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
                <h1>Create Order</h1>
            </div>
            <a href="#" class="add-order-button">+ Add Another Order</a>
        </div>

       
            <form action="php/order_create.php" method="post">
            <div id="order-container">
                <div class="order-form">
                    <h3>Order 1</h3>
                    <div class="form-row">
                        <label for="item-name-1">Item Name:</label>
                        <select id="item-name-1" name="item-name-1" required>
                            <?php include 'php/order_read.php'; ?>
                        </select>
                    </div>
                    <div class="form-row">
                        <label for="qty-1">Qty:</label>
                        <input type="number" id="qty-1" name="qty-1" required>
                    </div>
                    <div class="form-row">
                        <label for="supplier-name-1">Supplier Name:</label>
                        <input type="text" id="supplier-name-1" name="supplier-name-1" required>
                    </div>
                    <div class="form-row">
                        <label for="supplier-contact-1">Supplier Contact:</label>
                        <input type="number" id="supplier-contact-1" name="supplier-contact-1" pattern="[0-9]+"  required>
                    </div>
                    <div class="form-row">
                        <label for="supplier-address-1">Supplier Address:</label>
                        <input type="text" id="supplier-address-1" name="supplier-address-1" required>
                    </div>
                    <button class="remove-button" onclick="removeOrderForm(1)">Remove</button>
                    </div>
                <input type="hidden" id="order-count" name="order-count" value="1">
                <button type="submit" class="order-add-button">Submit</button>
                </div>
            </form>
        </main>
    </div>
</body>
<script>
    var orderCount = 1;

    function createOrderForm() {
        orderCount++;
        var container = document.getElementById('order-container');
        var form = document.createElement('div');
        form.classList.add('order-form');
        form.id = `order-form-${orderCount}`;
        form.innerHTML = `
            <h3>Order ${orderCount}</h3>
            <div class="form-row">
                <label for="item-name-${orderCount}">Item Name:</label>
                <select id="item-name-${orderCount}" name="item-name-${orderCount}" required>
                    <?php include 'php/order_read.php'; ?>
                </select>
            </div>
            <div class="form-row">
                <label for="qty-${orderCount}">Qty:</label>
                <input type="number" id="qty-${orderCount}" name="qty-${orderCount}" required>
            </div>
            <div class="form-row">
                <label for="supplier-name-${orderCount}">Supplier Name:</label>
                <input type="text" id="supplier-name-${orderCount}" name="supplier-name-${orderCount}" required>
            </div>
            <div class="form-row">
                <label for="supplier-contact-${orderCount}">Supplier Contact:</label>
                <input type="number" id="supplier-contact-${orderCount}" name="supplier-contact-${orderCount}" pattern="[0-9]+" title="Only numbers allowed" required>
            </div>
            <div class="form-row">
                <label for="supplier-address-${orderCount}">Supplier Address:</label>
                <input type="text" id="supplier-address-${orderCount}" name="supplier-address-${orderCount}" required>
            </div>
            <button class="remove-button" onclick="removeOrderForm(${orderCount})">Remove</button>
        `;

        container.appendChild(form);
        container.insertBefore(form, container.lastElementChild.previousElementSibling);

        document.getElementById('order-count').value = orderCount;
    }

    function removeOrderForm(orderId) {
                    var form = document.getElementById(`order-form-${orderId}`);
                    form.parentNode.removeChild(form);

                    orderCount--;
                    // Update the hidden input value after removing an order
                    document.getElementById('order-count').value = orderCount;
                }

                var addOrderButton = document.querySelector('.add-order-button');
                addOrderButton.addEventListener('click', createOrderForm);
</script>
</html>