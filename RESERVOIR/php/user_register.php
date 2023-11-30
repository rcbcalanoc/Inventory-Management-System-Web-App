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

$query = $conn->query("SELECT access_code FROM user");
$array = Array();
while($result = $query->fetch_assoc()){
    $array[] = $result['access_code'];
}

$qResult = $conn->query("SELECT Number FROM user WHERE access_code='" . $_POST['access_code'] . "'");


// Create or retrieve operation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form was submitted
    if ($_POST['Action'] == 'create') {

        $access = $_POST['access_code'];

        if(in_array($access,$array)){

            while ($qValues=mysqli_fetch_assoc($qResult))
            if ($qValues["Number"] == "0")
            {
                // Unique username check
                    $username = $_POST['Username'];
                    if (!preg_match('/^(?=.*[a-zA-Z]{4,})(?=.*\d).+$/', $username)) {
                        $error_message = "Username must be at least 4 characters long and contain at least one number.";
                        echo "<script>
                            alert('$error_message');
                            window.location.href='../register.php';
                            </script>";
                        exit;
                    }
                    
                mysqli_query($conn,"UPDATE user SET Username='" . $_POST['Username'] . "', Password='" . $_POST['Password'] . "', FirstName='" . $_POST['First_Name'] . "', LastName='" . $_POST['Last_Name'] . "' ,Email='" . $_POST['Email'] . "',Number='" . $_POST['Number'] . "',Position='" . $_POST['Position'] . "' WHERE access_code='" . $_POST['access_code'] . "'");
                $message = "Record Modified Successfully";
                $result = mysqli_query($conn,"SELECT * FROM user WHERE access_code='" . $_POST['access_code'] . "'");
                $row= mysqli_fetch_array($result);
                echo "<script>
                alert('Account Created Successfully');
                window.location.href='../login.php';
                </script>";
            }
            else
            {
                echo "<script>
                alert('Access Code Already Used!');
                window.location.href='../register.html';
                </script>";
            }  
        }
        else
        {
            echo "<script>
            alert('Incorrect Access Code!');
            window.location.href='../register.html';
            </script>";       
        }
    }
}

// Retrieve user by username and password
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $username = $_GET['Username'];
    $password = $_GET['Password'];
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
}
?>