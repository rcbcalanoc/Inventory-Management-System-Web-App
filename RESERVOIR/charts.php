<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/inventory.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Inventory</title>
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
        <li><a href="report.php">Reports</a></li>
        <li><a href="user.php" id="admin-only">Users</a></li>
    </ul>

        <!-- user-->
        <img src="images/user.png" alt="user" class = "user-pic" onclick="menuToggle();">
        <div class="action">
            <div class="menu">
                <h3>
                    <?php session_start(); echo $_SESSION['first_name'].' '.$_SESSION['last_name']; ?><br>
                    <span><?php echo $_SESSION['position'];?></span>
                </h3>
                <ul>
                    <li><a href="#">My Profile</a></li>
                    <li><a href="login.php">Log Out</a></li>
                </ul>
            </div>
        </div>
        <!--user end-->
    </nav>
  </header>

  <main>
        <?php
        $link=mysqli_connect("localhost","root","");
        mysqli_select_db($link,"main");

        $test=array();

        $count=0;
        $res=mysqli_query($link, "select * from inventory");
        while($row=mysqli_fetch_array($res))
        {
          $test[$count]["ProductName"]=$row["ProductName"];
          $test[$count]["y"]=$row["SoldStock"];
          $count=$count+1;

        }

          
        ?>
        <!DOCTYPE HTML>
        <html>
        <head>
        <script>
        window.onload = function() {
          
          
        var chart = new CanvasJS.Chart("chartContainer", {
          animationEnabled: true,
          title: {
            text: "Product Sales Chart"
          },
          subtitles: [{
            text: "Number of Sales Per Product"
          }],
          data: [{
            type: "pie",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
          }]
        });
        chart.render();
          
        }
        </script>
        </head>
        <body>
        <div id="chartContainer" style="height: 750px; width: 100%;"></div>
        <script src="js\canvasjs.min.js"></script>
        </body>
        </html> 

  </main>
</body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</html>