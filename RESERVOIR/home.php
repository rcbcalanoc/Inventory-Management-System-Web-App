<?php
   //session start
   session_start();
   if(!isset($_SESSION['first_name'])) header('location: login.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <title>RESERVOIR - HOME PAGE</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="images/logo.png">
        <link rel="stylesheet" href="css/home.css">
        <link rel="stylesheet" href="css/main.css">
        <title>Home</title>

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
                <?php if (strcasecmp($_SESSION['position'], "admin") == 0 || strcasecmp($_SESSION['position'], "Owner") == 0) { ?>
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
                    <h1>Dashboard</h1>
                    <small>Monitor key metrics. Check reporting and review insights</small>
                    </div>
                </div>

                <!-- Cards -->
                <div class="cards">
                    <!-- 1 -->
                    <div class="card-single">
                        <div class="card-flex">
                            <div class="card-info">
                                <div class="card-head">
                                    <span>Products</span>
                                    <small>Number of Products</small>
                                </div>
                                <?php
                                    require 'php\number_of.php';

                                    $query = "SELECT BatchID FROM inventory ORDER BY BatchID";
                                    $query_run = mysqli_query($connection, $query);

                                    $row = mysqli_num_rows($query_run);

                                    echo '<h2> '.$row.' </h2>';
                                ?>

                            </div>
                        </div>
                    </div>

                    <!-- 2 -->
                    <div class="card-single">
                        <div class="card-flex">
                            <div class="card-info">
                                <div class="card-head">
                                    <span>Stock Quantity</span>
                                    <small>Number of Current Stocks</small>
                                </div>
                                <?php
                                require 'php\number_of.php';

                                $query = "SELECT CurrentInventory FROM inventory";
                                $query_run = mysqli_query($connection, $query);

                                $qty= 0;
                                while ($num = mysqli_fetch_assoc($query_run)) {
                                    $qty += $num['CurrentInventory'];
                                }
                                echo '<h2>'.$qty.'</h2>';
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- 3 -->
                    <div class="card-single">
                        <div class="card-flex">
                            <div class="card-info">
                                <div class="card-head">
                                    <span>Sold Stocks</span>
                                    <small>Number of Sold Inventory Items</small>
                                </div>
                                <?php
                                require 'php\number_of.php';

                                $query = "SELECT SoldStock FROM inventory";
                                $query_run = mysqli_query($connection, $query);

                                $qty= 0;
                                while ($num = mysqli_fetch_assoc($query_run)) {
                                    $qty += $num['SoldStock'];
                                }
                                echo '<h2>'.$qty.'</h2>';
                                ?>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Notifs? -->
                <div class="notifs-grid">
                    <div class="analytics-card">
                    <!-- Product status -->

                <!-- start -->   
                <?php
                // connection

                //Fetch products ordered by Expiration Date in ascending order
                $query = "SELECT * FROM inventory ORDER BY ExpirationDate";
                $query_run = mysqli_query($connection, $query);

                // Create an array to store the products
                $products = array();
                while ($row = mysqli_fetch_assoc($query_run)) {
                    $products[] = $row;
                }

                // Function to determine the highlight class based on expiration status
                function getHighlightClass($expirationDate) {
                    $currentDate = date('Y-m-d');
                    $expirationDate = date('Y-m-d', strtotime($expirationDate));
                    $daysDifference = (strtotime($expirationDate) - strtotime($currentDate)) / (60 * 60 * 24);

                    if ($daysDifference < 0) {
                        // Expired products will have a red highlight
                        return "highlight-red";
                    } elseif ($daysDifference <= 30) {
                        // Near-expiration products will have a yellow highlight
                        return "highlight-yellow";
                    } else {
                        // Products with more than 30 days remaining will have a green highlight
                        return "highlight-green";
                    }
                }

                //Rank products based on expiration date
                usort($products, function ($a, $b) {
                    $aIsNearExpired = (strtotime($a['ExpirationDate']) - time()) <= (30 * 24 * 60 * 60);
                    $bIsNearExpired = (strtotime($b['ExpirationDate']) - time()) <= (30 * 24 * 60 * 60);

                    if ($aIsNearExpired && !$bIsNearExpired) {
                        return -1;
                    } elseif (!$aIsNearExpired && $bIsNearExpired) {
                        return 1;
                    } else {
                        return 0;
                    }
                });
                ?>

                <!-- Rank of Near Expired Products -->
                <head>
                    <link rel="stylesheet" href="css\home.css">
                </head>

                    <div>
                        <h2>Inventory Status</h2>
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Expiration Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Display products with appropriate highlight color
                                foreach ($products as $product) {
                                    $highlightClass = getHighlightClass($product['ExpirationDate']);
                                    echo '<tr class="' . $highlightClass . '">';
                                    echo '<td>' . $product['ProductName'] . '</td>';
                                    echo '<td>' . $product['ExpirationDate'] . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <!-- end -->
                    </div>

                    <!-- Product sales -->
                    <!--start-->
                    <?php
                    // connection
                    $link = mysqli_connect("localhost", "root", "");
                    mysqli_select_db($link, "main");

                    $test = array();
                    $count = 0;
                   
                    $res = mysqli_query($link, "SELECT * FROM inventory ORDER BY SoldStock ASC"); 

                    while ($row = mysqli_fetch_array($res)) {
                        $test[$count]["label"] = $row["ProductName"];
                        $test[$count]["y"] = $row["SoldStock"];
                        $count = $count + 1;
                    }
                    ?>
                    <!DOCTYPE HTML>
                    <html>

                    <head>
                        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                        <script>
                            window.onload = function() {

                                var chart = new CanvasJS.Chart("chartContainer", {
                                    animationEnabled: true,
                                    theme: "light2",
                                    title: {
                                        text: "Product Sales Report"
                                    },
                                    axisX: { 
                                        title: "Product Name"
                                    },
                                    axisY: {
                                        title: "Number of Sold Stocks"
                                    },
                                    data: [{
                                        type: "line", 
                                        yValueFormatString: "#,##0.## sold",
                                        dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
                                    }]
                                });
                                chart.render();
                            }
                        </script>
                    </head>

                    <body>
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    </body>

                    </html>



                    <!--end-->
                </div>
            </main>
        </div>

        



        <!-- Content End -->

        <!-- Script -->

    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</html>