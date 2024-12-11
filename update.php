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
$result = $conn->query("SELECT * FROM users WHERE matric='$matric'");

if ($result->num_rows === 0) {
    echo "<div style='
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
            color: red;
        '>
        <p>No user found with the specified matric number.</p>
        <a href='users.php' style='
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
        '>Go back to User List</a>
    </div>";
    $conn->close();
    exit();
}

$user = $result->fetch_assoc();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update User</title>
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
        form label {
            display: block;
            margin-bottom: 5px;
            color: #555555;
            text-align: left;
        }
        form input, form select, form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        form button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update User</h2>
        <form action="update_process.php" method="POST">
            <label for="matric">Matric:</label>
            <input type="text" id="matric" name="matric" value="<?= $user['matric'] ?>" required><br>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= $user['name'] ?>" required><br>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="Lecturer" <?= $user['role'] == 'Lecturer' ? 'selected' : '' ?>>Lecturer</option>
                <option value="Student" <?= $user['role'] == 'Student' ? 'selected' : '' ?>>Student</option>
            </select><br>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>

