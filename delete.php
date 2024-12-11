<?php
session_start(); // Start the session

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'Lab_5b');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$matric = $_GET['matric'];

// Delete query
$conn->query("DELETE FROM users WHERE matric='$matric'");

// Check if the deletion was successful
if ($conn->affected_rows > 0) {
    $message = "User deleted successfully!";
    $color = "green";
} else {
    $message = "Error deleting user.";
    $color = "red";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
            text-align: center;
        }
        h2 {
            color: #333333;
            margin-bottom: 20px;
        }
        .message {
            font-family: Arial, sans-serif;
            color: <?php echo $color; ?>;
            font-size: 18px;
            margin-bottom: 20px;
        }
        a {
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
        }
        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Delete User</h2>
        <div class="message">
            <p><?php echo $message; ?></p>
        </div>
        <a href="users.php">Go back to User List</a>
    </div>
</body>
</html>
