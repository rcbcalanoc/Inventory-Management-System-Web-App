<?php
session_start();

// Configuration
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "main";

// Connect to Database
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user ID
    $user_id = $_SESSION['id'];

    // Get form values
    $first_name = $_POST['First_Name'];
    $last_name = $_POST['Last_Name'];
    $email = $_POST['Email'];
    $number = $_POST['Number'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $position = $_POST['Position'];

    // Update user information
    $sql = "UPDATE user SET `FirstName`='$first_name', `LastName`='$last_name', Email='$email', Number='$number', Username='$username', Password='$password' WHERE ID=$user_id";
    if (mysqli_query($conn, $sql)) {
        // Update session variables
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['email'] = $email;
        $_SESSION['number'] = $number;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['position'] = $position;
        
        header('Location: ../profile.php');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Display form with current user information
?>



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
         <a href="login.php" id="logo">
         <img src="../images/logo.png">
         <h1 id="title-logo">RESERVOIR</h1>
         </a>
      </nav>
   </header>
   <!-----------LOGIN---------------->
   <div style="margin-top: -80px;">
      <div class="wrapper">
          <div class="title">
            Edit Profile
          </div>   
          <form method="post" action="">
              <div class="field">
                  <input type="text" name="First_Name" value="<?php echo $_SESSION['first_name']; ?>" required>
                  <label>First Name:</label>
              </div>
              <div class="field">
                  <input type="text" name="Last_Name" value="<?php echo $_SESSION['last_name']; ?>" required>
                  <label>Last Name:</label>
                </div>
              <div class="field">
                  <input type="text" name="Email" value="<?php echo $_SESSION['email']; ?>" required>
                  <label>Email:</label>
                </div>
              <div class="field">  
                  <input type="number" name="Number" value="<?php echo $_SESSION['number']; ?>" required>
                  <label>Number:</label>
              </div>
              <div class="field">
                  <input type="text" name="Username" value="<?php echo $_SESSION['username']; ?>" required>
                  <label>Username:</label>
              </div>
              <div class="field">
                  <input type="text" name="Password" value="<?php echo $_SESSION['password']; ?>" required>
                  <label>Password:</label>
                </div>
              <div class="field">
                <input type="text" name="Position" value="<?php echo $_SESSION['position']; ?>" required>
                <label>Position:</label>
              </div>
              <div class="field">
              <div class="buttons">
                  <button type="submit" class="profile-button">Save</button>
                  <div style="margin-top: 10px;"></div>
                  <a href="../profile.php" class="cancel-button">Cancel</a>
              </div>
              </div>
          </form>
      </div>
   </div>
</body>
   <script src="../js/main.js"></script>
</html>






















