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

// LOGIN
if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $remember = isset($_POST['remember']);

  $sql = "SELECT * FROM user WHERE Username = '$username' AND Password = '$password'";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) > 0) {
    // Valid Login
    $row = mysqli_fetch_assoc($result);
    $_SESSION['access'] = $row['access_code'];
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $row['ID'];
    $_SESSION['first_name'] = $row['FirstName'];
    $_SESSION['last_name'] = $row['LastName'];
    $_SESSION['email'] = $row['Email'];
    $_SESSION['position'] = $row['Position'];
    $_SESSION['number'] = $row['Number'];
    $_SESSION['password'] = $password;

    //store user session

    if(isset($_POST['remember_me'])){
            setcookie('username', $username, time() + (60*60*24), '/');
            setcookie('password', $password, time() + (60*60*24),'/');
         }
         else
         {
            setcookie('username','', time() - (60*60*24), '/');
            setcookie('password','', time() - (60*60*24), '/');
         }

    header('Location: ../login.php');

  } else {
    // Invalid Login
    $_SESSION['error'] = "Invalid username or password";
    header('Location: ../login.php?error=1');
    exit();
  }
}
?>