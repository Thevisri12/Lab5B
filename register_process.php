<?php
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$matric = $_POST['matric'];
$name = $_POST['name'];
$role = $_POST['role'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$password', '$role')";

if ($conn->query($sql) === TRUE) {
    echo "<div style='
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
            color: green;
        '>
            <p>Registration successful!</p>
            <a href='login.php' style='
                color: #007bff;
                text-decoration: none;
                font-size: 16px;
            '>Go to Login</a>
        </div>";
} else {
    echo "<div style='
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
            color: red;
        '>
            <p>Error: " . $conn->error . "</p>
            <a href='login.php' style='
                color: #007bff;
                text-decoration: none;
                font-size: 16px;
            '>Go to Login</a>
        </div>";
}

$conn->close();
?>
