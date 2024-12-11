<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'Lab_5b');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$matric = $_POST['matric'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE matric='$matric'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];
        header("Location: users.php");
        exit();
    }
}

// Styled error message
echo "<div style='
    font-family: Arial, sans-serif; 
    text-align: center; 
    margin-top: 50px; 
    color: red;
'>
    <p>Invalid credentials. Please try again.</p>
    <a href='login.php' style='
        color: #007bff; 
        text-decoration: none;
        font-size: 16px; 
    '>Go back to Login</a>
</div>";
?>
