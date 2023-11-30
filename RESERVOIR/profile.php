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
   <title>My Profile</title>
   <link rel="stylesheet" href="css/profile.css">
   <link rel="stylesheet" href="css/main.css"> </head>

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

        <!-----------PROFILE---------------->
        <div id="override">
            <div class="wrapper">
                <div class="title">My Profile</div>
                <div class="form-wrapper">
                   <div class="field">
                        <label>Access Code:</label>
                        <div class="display-info"><?php echo $_SESSION['access']; ?></div>
                    </div>
                    <div class="field">
                        <label>First Name:</label>
                        <div class="display-info"><?php echo $_SESSION['first_name']; ?></div>
                    </div>
                    <div class="field">
                        <label>Last Name:</label>
                        <div class="display-info"><?php echo $_SESSION['last_name']; ?></div>
                    </div>
                    <div class="field">
                        <label>Email:</label>
                        <div class="display-info"><?php echo $_SESSION['email']; ?></div>
                    </div>
                    <div class="field">
                        <label>Number:</label>
                        <div class="display-info"><?php echo $_SESSION['number']; ?></div>
                    </div>
                    <div class="field">
                        <label>Username:</label>
                        <div class="display-info"><?php echo $_SESSION['username']; ?></div>
                    </div>
                    <div class="field">
                        <label>Password:</label>
                        <div class="display-info"><?php echo $_SESSION['password']; ?></div>
                    </div>
                </div>
                <div class="field">
                    <div class="image-wrapper">
                        <img src="images/user.png" alt="Profile Picture" style="width:200px; height:200px;">
                        <div class="text"><?php echo $_SESSION['position']; ?></div>
                        <div class="buttons">
                            <button class="profile-button" onclick="window.location.href='php/profile_edit.php'">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="js/main.js"></script>
</html>