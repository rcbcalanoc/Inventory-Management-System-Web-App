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
    <title>RESERVOIR - USERS PAGE</title>
    <link rel="stylesheet" type="text/css" href="css/user.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
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
                <li><a href="user.php">Users</a></li>
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
                    <h1>Users Page</h1>
                    <small>View and Manage the system's user accounts</small>
                    </div>
                </div>

                <!-- Tables -->
                <div class="tables-grid">
                    <!-- ACCESS CODE TABLE -->
                    <div class="card">
                        <h2>Access Code List</h2><br>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Access Code</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php include 'php/user_access.php'; ?>
                            </tbody>
                        </table>
                        <!-- add btn -->
                        <form method="post" action="php/test.php">
                            <div class="field">
                                <input type="hidden" name="Action" value="create">
                                <input type="submit" value="add access" class="add-btn-user">
                            </div>
                            
                        </form>  
                    </div>

                    <!-- USER LIST TABLE -->
                    <div class="card">
                        <h2>User List</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Access Code</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Contact No.</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Position</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php include 'php/user_read.php'; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </main>
            </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/main.js"></script>
</html>