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

$matric = $_POST['matric'];
$name = $_POST['name'];
$role = $_POST['role'];

// Update query
$sql = "UPDATE users SET matric='$matric', name='$name', role='$role' WHERE matric='$matric'";

if ($conn->query($sql) === TRUE) {
    echo "<div style='
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
            color: green;
        '>
            <p>User updated successfully!</p>
            <a href='users.php' style='
                color: #007bff;
                text-decoration: none;
                font-size: 16px;
            '>Go back to User List</a>
        </div>";
} else {
    echo "<div style='
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
            color: red;
        '>
            <p>Error updating user: " . $conn->error . "</p>
            <a href='users.php' style='
                color: #007bff;
                text-decoration: none;
                font-size: 16px;
            '>Go back to User List</a>
        </div>";
}

$conn->close();
?>
