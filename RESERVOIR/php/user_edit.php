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
         <a href="../home.php" id="logo">
         <img src="../images/logo.png">
         <h1 id="title-logo">RESERVOIR</h1>
         </a>
      </nav>
   </header>

    <?php
        // Configuration
        $dbHost     = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName     = "main";

        // Connect to Database
        $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if edit Action is requested
        if (isset($_GET['Action']) && $_GET['Action'] == 'Edit') {
            $id = $_GET['id'];
            $sql = "SELECT * FROM user WHERE id = '$id'";
            $result = mysqli_query($conn, $sql);

            // Check if there are any results
            if (mysqli_num_rows($result) == 1) {
                // Display the edit form with the row data
                $row = mysqli_fetch_assoc($result);
                ?>
                    <div class="wrapper">      
                    <div class="title">
                        Edit Form
                    </div>
                    <form method="post" action="user_edit.php">
                        <div class="field">
                            <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
                            <input type="text" name="Username" value="<?php echo $row['Username']; ?>" required>
                            <label>Username</label>
                        </div>
                        <div class="field">
                            <input type="text" name="Password" value="<?php echo $row['Password']; ?>" required>
                            <label>Password</label>
                            <input type="hidden" name="Action" value="update">
                        </div>
                        <div class="field">
                            <input type="submit" name="Update" value="Update">
                        </div>
                    </form>
                </div>
                <?php
            } else {
                echo "Error: Record not found.";
            }
        }

        // Check if update Action is requested
        if (isset($_POST['Action']) && $_POST['Action'] == 'update') {
            $id = $_POST['ID'];
            $username = $_POST['Username'];
            $password = $_POST['Password'];
            $sql = "UPDATE users SET username = '$username', password = '$password' WHERE id = '$id'";
            if (mysqli_query($conn, $sql)) {
                header('Location: ../user.php');
                exit();
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }

        // Close database connection
        mysqli_close($conn);
    ?>

</body>
   <script src="js/main.js"></script>
</html>
