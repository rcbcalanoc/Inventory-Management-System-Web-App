<?php
    session_start();

   if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
      $id = $_COOKIE['username'];  
      $pass = $_COOKIE['password'];
   }
   else{
      $id = "";
      $pass = "";
   }

    if(isset($_SESSION['first_name'])) header('location: home.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>RESERVOIR - LOGIN PAGE</title>
   <link rel="stylesheet" href="css/login.css"> </head>

<body>
   <header>
      <nav class="top">
         <a href="login.php" id="logo">
         <img src="images/logo.png">
         <h1 id="title-logo">RESERVOIR</h1>
         </a>
      </nav>
   </header>
   <!-----------LOGIN---------------->
   <div class="wrapper">
      <div class="title">
         Login Form
      </div>   
      <form method="post" action="php/login_check.php">
         <div class="field">
             <input type="text" value="<?php echo $id ?>" name="username" required>
             <label>Username</label>
         </div>
         <div class="field">
             <input type="password" value="<?php echo $pass ?>" name="password" required>
             <label>Password</label>
         </div>
         <?php
         if(isset($_GET['error']) && $_GET['error'] == 1) {
            if(isset($_SESSION['error'])) {
               echo '<div id="error-message">' . $_SESSION['error'] . '</div>';
               unset($_SESSION['error']);
            }
         }
      ?>
         <div class="content">
             <div class="checkbox">
                 <input type="checkbox" id="remember-me" name="remember_me">
                 <label for="remember-me">Remember me</label>
             </div>
         </div>
         <div class="field">
             <input type="submit" name="login" value="Login">
         </div>
         <div id="register">
             Don't have account? <a href="register.php">Create Account</a>
         </div>
     </form>
   </div>
</body>
   <script src="js/main.js"></script>
</html>