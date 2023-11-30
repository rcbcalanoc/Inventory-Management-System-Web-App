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
    <link rel="stylesheet" type="text/css" href="css/report.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Report</title>

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
        <h1>Reports</h1>
        <small>View detailed inventory insights and reports</small>
        </div>
        <button class="add-button" id="add-btn-report">+ Add</button>
    </div>
      <!--TABLE-->
      <div class="table-container" style="display:flex; justify-content:center; align-items:center;">
        <table id="output-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date & Time Entry</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php include 'php/report_read.php'; ?>
                <!-- Row Automatically Generated per Form Submitted -->
            </tbody>
        </table>
    </div>
    
 
    <div id="form-container-report">
        <form id="add-form-report" method="post" Action="php/report_create.php" style="display:none;">
            <input type="text" name="name" placeholder="Name" required>           
            <textarea name="message" placeholder="Message" style="height: 150px;"></textarea>
            <input type="hidden" name="Action" value="create"> 
            <button type="submit" name="submit">Create</button>
            <div class="buttons">
                  <div style="margin-top: 10px;"></div>
                  <a href="report.php" class="cancel-button">Cancel</a>
            </div>
        </form>
    </div>
</main>
</div>

</body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</html>


