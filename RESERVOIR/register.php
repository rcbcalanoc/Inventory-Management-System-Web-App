<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>RESERVOIR - LOGIN PAGE</title>
   <link rel="stylesheet" href="css/login.css"> 
   <link rel="stylesheet" href="css/main.css"> 
</head>
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
   <div id="override">
        <div class="wrapper">
            <div class="title">
                Register Form
            </div>
        <form method="post" action="php/user_register.php">
                <div class="field">
                    <input type="text" name="access_code" required>
                    <label>Access Code</label>
                </div>
                <div class="field">
                    <input type="text" name="First_Name" required>
                    <label>First Name</label>
                </div>
                <div class="field">
                    <input type="text" name="Last_Name" required>
                    <label>Last Name</label>
                </div>
                <div class="field">
                    <input type="text" name="Email" required>
                    <label>Email</label>
                </div>
                <div class="field">
                    <input type="text" name="Number" onkeypress="return isNumberKey(event)" required>
                    <label>Number</label>
                </div>
                <div class="field">
                    <input type="text" name="Username" required>
                    <label>Username</label>
                </div>
                <div class="field">
                    <input type="password" name="Password" required>
                    <label>Password</label>
                </div>
                <div class="field">
                    <input type="text" name="Position" required>
                    <label>Position</label>
                </div>
                <div class="field">
                    <input type="hidden" name="Action" value="create">
                    <input type="submit" value="Register">
                    <a href="login.php" class="cancel-button">Cancel</a>
                </div>
            </form>            
        </div>
    </div>
</body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="js/main.js"></script>
</html>